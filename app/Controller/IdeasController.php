<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
App::uses('CakeLog', 'Log');

/**
 * Ideas Controller
 *
 * @property Idea $Idea
 * @property InputItem $InputItem
 * @property IdeaAddInput $IdeaAddInput
 * @property User $User
 * @property IdeaResponse $IdeaResponse
 * @property Tag $Tag
 * @property Attachment $Attachment
 */
class IdeasController extends AppController {

	/* An array containing the class names of models this controller uses. */
	public $uses = array('Idea', 'InputItem', 'IdeaAddInput','User','IdeaResponse','Tag','Attachment');

	/* An array containing the names of helpers this controller uses. */
	public $helper = array('MbText', 'SmartPhone','Rss','Attachment');

	/* For Search Plugin Settings */
	public $presetVars = array(
		'id' => array('type' => 'value', 'empty' => true, 'encode' => true),
		'status_id' => array('type' => 'checkbox', 'empty' => true, 'encode' => true),
		'tag_id' => array('type' => 'checkbox', 'empty' => true, 'encode' => true),
		'title' => array('type' => 'like', 'empty' => true, 'encode' => true),
		'body' => array('type' => 'like', 'empty' => true, 'encode' => true),
	);

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		if($this->RequestHandler->isRss()){
			$this->layout = "default";
			$this->Idea->recursive = 0;
			$ideas = $this->Idea->find('all', array('limit'=>5, 'order'=>'Idea.created desc'));
			$this->set(compact('ideas'));
		}
		$authId = $this->Auth->user() != null ? $this->Auth->user('id') : 0;
		$this->Idea->setVirtualFields($authId);
		$paginateOption = array('conditions'=> array(), 'order' => '"Idea__last_modified" DESC');

		// タグのキーワード検索
		if ($this->request->is('post')) {
			$paginateOption = $this->setPaginateOption($paginateOption);
			if ($this->request->data('page') == 'idea') {
				$viewId = $this->request->data('layout') == 'board' ? COOKIE_VALUE_VIEW_BOARD : COOKIE_VALUE_VIEW_LIST;
				$this->Cookie->write(COOKIE_KEY_DEFAULT_VIEW, $viewId);
			}
		} else {
			$this->Prg->commonProcess();
			$paginateOption['conditions'] = $this->Idea->parseCriteria($this->passedArgs);
		}

		$paginateOption['conditions']['Idea.delete_flg'] = false;
		$this->paginate = $paginateOption;
		$this->Idea->recursive = 0;
		$ideas = $this->paginate();

		// 最新コメントのみを取得
		foreach ($ideas as $key => $value) {
			$this->IdeaResponse->recursive = 0;
			$ideas[$key]['Idea']['new_comment_body'] = $this->IdeaResponse->find('first',
				array(
					'conditions' => array('idea_id' => $value['Idea']['id']),
					'fields' => array('IdeaResponse.body','IdeaResponse.created','User.first_name','User.last_name'),
					'order' => array('IdeaResponse.id desc' )
					));
		}

		// Viewに渡す値の取得と設定
		$tags = $this->Tag->find('list', array('order' => 'Tag.id'));
		$statuses = $this->Idea->Status->find('list', array('conditions' => array('delete_flg' => false), 'order' => 'Status.order'));
		$addInputs = $this->InputItem->find('all', array('conditions' => array('delete_flg' => false), 'order' => 'InputItem.id'));
		$this->set(compact('ideas', 'tags', 'statuses', 'addInputs'));

		// Board表示判定
		if((strpos($_SERVER["REQUEST_URI"], 'board') != FALSE) ||
			($this->Cookie->check(COOKIE_KEY_DEFAULT_VIEW) && $this->Cookie->read(COOKIE_KEY_DEFAULT_VIEW) == COOKIE_VALUE_VIEW_BOARD) ) {
			$this->render('board');
		}
	}

	/**
	 * タグ検索
	 * search_tag method
	 * @return void
	 */
	protected function setPaginateOption($paginateOption = array()) {
		// タグのキーワード検索
		if ($this->request->is('post')) {
			if (isset($this->request->data['IdeaTag'])) {
				// 択一選択か自由入力かを判定
				if (!is_numeric($this->request->data['IdeaTag']['tag_id'])) {
					// 自由入力
					$conditions = array();
					$freeText = Sanitize::escape(trim($this->request->data['eComboBox']['IdeaTagTagId']));
					$keywords = preg_split("/[\s]+/i", mb_convert_kana($freeText, 's'));
					foreach ($keywords as $keyword) {
						$conditions['OR'][] = array('name LIKE' => "%$keyword%");
					}
					$keytags = $this->Tag->find('all', array('conditions' => $conditions));
					if ($keytags) {
						foreach ($keytags as $keytag) {
							$tagId = $keytag['Tag']['id'];
							$paginateOption['conditions']['OR'][] = "EXISTS(SELECT * FROM idea_tags WHERE idea_tags.idea_id = Idea.id AND idea_tags.tag_id = $tagId)";
						}
					} else if (trim($this->request->data['eComboBox']['IdeaTagTagId']) != '' && $this->request->data['eComboBox']['IdeaTagTagId'] != '(自由入力)') {
						$paginateOption['conditions'] = array('Idea.id' => 0);
					}
				} else {
					// 択一選択
					$tagId = Sanitize::escape($this->request->data['IdeaTag']['tag_id']);
					$paginateOption['conditions'][] = "EXISTS(SELECT * FROM idea_tags WHERE idea_tags.idea_id = Idea.id AND idea_tags.tag_id = $tagId)";
				}
			}
		}

		return $paginateOption;
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$auth = $this->Auth->user();
		if (!$this->Idea->exists($id)) {
			throw new NotFoundException(__('Invalid idea'));
		}
		$options = array('conditions' => array('Idea.' . $this->Idea->primaryKey => $id));
		$tags = $this->Tag->find('list', array('order' => 'Tag.id'));
		$idea = $this->Idea->find('first', $options);
		$addInputs = $this->InputItem->find('list', array('conditions' => array('delete_flg' => false), 'order' => 'InputItem.id'));
		$users = array();
		foreach( $this->User->find('all') as $user ) {
			$users[$user['User']['id']] = $user['User']['last_name'] . $user['User']['first_name'];
		}
		$this->paginate = array('conditions' => array('idea_id' => $id), 'order' => 'IdeaResponse.modified DESC');
		$comments = $this->paginate('IdeaResponse');

		$attachments = $this->get_attachment_files($id);

		$this->set(compact('idea', 'tags','addInputs','auth','users','comments','attachments'));
	}

	public function get_attachment_files($idea_id) {
		$result = array();

		$options = array('conditions' => array('foreign_key' => $idea_id, 'model' => 'Idea','active' => 1));
		$result = $this->Attachment->find('all', $options);

		return $result;
	}

	public function save_upload_file($request) {
		if(!array_key_exists('Attachment',$this->request->data)) return;

		// ファイル保存
		foreach (array_keys($request->data['Attachment']) as $fi) {
			$file = $request->data['Attachment'][$fi]['files'];
			if($file && $file['size'] > 1) {
				$request->data['Attachment'][$fi]['name'] = $file['name'];
				$request->data['Attachment'][$fi]['model'] = 'Idea';
				$request->data['Attachment'][$fi]['foreign_key'] = $request->data['Idea']['id'];
				$request->data['Attachment'][$fi]['dir'] = WWW_ROOT.'files'.DS;
				$request->data['Attachment'][$fi]['type'] = $file['type'];
				$request->data['Attachment'][$fi]['size'] = $file['size'];
				$ret = move_uploaded_file($file['tmp_name'], $request->data['Attachment'][$fi]['dir'].basename($request->data['Attachment'][$fi]['name']));
			} else {
				unset($request->data['Attachment'][$fi]);
			}
		}
		if(count($request->data['Attachment']) > 0) $this->Attachment->saveAll($request->data['Attachment']);
	}

	public function delete_upload_file($request) {
		if(!array_key_exists('DeletedFile',$this->request->data)) return;

		foreach (array_keys($request->data['DeletedFile']) as $fi) {
			$target = $request->data['DeletedFile'][$fi]['Delete'];
			if($target) {
				$file = $this->Attachment->findById($fi);
				if($file) {
					unlink(WWW_ROOT.'files'.DS.$file['Attachment']['name']);
					$this->Attachment->delete($fi);
				}
			}
		}
	}

	public function delete_idea_file($idea_id) {
		foreach($this->get_attachment_files($idea_id) as $file) {
			unlink(WWW_ROOT.'files'.DS.$file['Attachment']['name']);
			$this->Attachment->delete($file['Attachment']['id']);
		}
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		$auth = $this->Auth->user();
		$roleId = $auth['role_id'];
		if ($this->request->is('post')) {
			$this->Idea->create();
			$this->request->data['Idea']['user_id'] = $auth['id'];

			// ファイル保存
			$this->save_upload_file($this->request);

			$ret = $this->Idea->save($this->request->data);

			if ($ret) {
				// 追加入力項目
				if (isset($this->request->data['IdeaAddInput'])) {
					$ideaId = $this->Idea->getLastInsertID();
					foreach (array_keys($this->request->data['IdeaAddInput']) as $i) {
						$this->request->data['IdeaAddInput'][$i]['idea_id'] = $ideaId;
					}
					$this->IdeaAddInput->saveAll($this->request->data['IdeaAddInput']);
				}
				$this->Session->flashSuccess(__('The idea has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->flashError(__('The idea could not be saved. Please, try again.'));
			}
		}
		$statuses = $this->Idea->Status->find('list', array(
						'conditions' => array(
										'Status.delete_flg' => false,
										'OR' => array(
											"EXISTS(SELECT * FROM status_workflows WHERE Status.id = status_workflows.status_id AND status_workflows.role_id = $roleId)",
											"Status.default" => true
											)
										),
						'order' => 'Status.order'));
		$statusTmp = $this->Idea->Status->find('first', array('conditions' => array('delete_flg' => false, 'default' => true)));
		$defaultStatus = null;
		if ($statusTmp != null) {
			$defaultStatus = $statusTmp['Status']['id'];
		}
		$addInputs = $this->InputItem->find('all', array('conditions' => array('delete_flg' => false), 'order' => 'InputItem.id'));
		$this->set(compact('statuses', 'addInputs', 'defaultStatus'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$auth = $this->Auth->user();
		$roleId = $auth['role_id'];
		if (!$this->Idea->exists($id)) {
			throw new NotFoundException(__('Invalid idea'));
		}
		$attachments = $this->get_attachment_files($id);
		if ($this->request->is('post') || $this->request->is('put')) {
			// ファイル保存
			$this->save_upload_file($this->request);
			// ファイル削除
			$this->delete_upload_file($this->request);

			$ret = $this->Idea->save($this->request->data);

			if ($ret) {
				// 追加入力項目
				if (isset($this->request->data['IdeaAddInput'])) {
					$ideaId = $id;
					foreach (array_keys($this->request->data['IdeaAddInput']) as $i) {
						$this->request->data['IdeaAddInput'][$i]['idea_id'] = $ideaId;
					}
					$this->IdeaAddInput->saveAll($this->request->data['IdeaAddInput']);
				}
				$this->Session->flashSuccess(__('The idea has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->flashError(__('The idea could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Idea.' . $this->Idea->primaryKey => $id));
			$this->request->data = $this->Idea->find('first', $options);
		}
		$editStatus = $this->request->data['Idea']['status_id'];
		$statuses = $this->Idea->Status->find('list', array(
						'conditions' => array(
										'Status.delete_flg' => false,
										'OR' => array(
												"EXISTS(SELECT * FROM status_workflows WHERE Status.id = status_workflows.allow_shift_status_id AND status_workflows.status_id = $editStatus AND status_workflows.role_id = $roleId)",
												'Status.id' => $this->request->data['Idea']['id'],
												)
										),
						'order' => 'Status.order'));
		$addInputs = $this->InputItem->find('all', array('conditions' => array('delete_flg' => false), 'order' => 'InputItem.id'));
		$this->set(compact('statuses', 'addInputs', 'attachments'));
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @throws MethodNotAllowedException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		$this->Idea->id = $id;
		if (!$this->Idea->exists()) {
			throw new NotFoundException(__('Invalid idea'));
		}
		$this->request->onlyAllow('post', 'delete');
		$comment_count = $this->IdeaResponse->find('count',array('conditions'=>array('IdeaResponse.idea_id'=>$id)));
		if($this->Session->read('Auth.User.role_id') == ADMIN_ROLE_INDEX || $comment_count == 0){
			if ( $this->Idea->saveField('delete_flg', true)) {
				$this->delete_idea_file($id);
				$this->Session->flashSuccess(__('Idea deleted'));
				$this->redirect(array('action' => 'index'));
			}
		}
		$this->Session->flashError(__('Idea was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function useredit() {
		$id = $this->Session->read("Auth.User.id");
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			// パスワードが空の時は、変更しない
			$whitelist = array('last_name','first_name', 'email_address', 'comment', 'modified');
			if ($this->request->data['User']['password']) {
				$whitelist []= 'password';
			}
			if ($this->User->save($this->request->data, array('fieldList' => $whitelist))) {
				$this->Session->flashSuccess(__('The user has been saved'));
				$this->redirect('/');
			} else {
				$this->Session->flashError(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
	}

	/**
	 * responses method (rss)
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function responses() {
		if($this->RequestHandler->isRss()) {
			$this->IdeaResponse->recursive = 0;
			$ideaResponses = $this->IdeaResponse->find('all', array(
			'limit'=>5, 'order'=>'IdeaResponse.created desc'));
			$this->layout = "default";
			$this->set(compact('ideaResponses'));
		}
	}

}
