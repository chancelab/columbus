<?php
App::uses('AppController', 'Controller');
/**
 * IdeaResponses Controller
 *
 * @property IdeaResponse $IdeaResponse
 * @property Idea $Idea
 */
class IdeaResponsesController extends AppController {

	public $uses = array('IdeaResponse', 'Idea');
	public $presetVars = array(
		'id' => array('type' => 'value', 'empty' => true, 'encode' => true),
		'title' => array('type' => 'like', 'empty' => true, 'encode' => true),
		'name' => array('type' => 'like', 'empty' => true, 'encode' => true),
		'body' => array('type' => 'like', 'empty' => true, 'encode' => true),
	);

	/**
	 * index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this->Prg->commonProcess();
		$this->paginate = array('conditions' => $this->IdeaResponse->parseCriteria($this->passedArgs));
		$this->IdeaResponse->recursive = 0;
		$this->set('ideaResponses', $this->paginate());
	}

	/**
	 * delete method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->IdeaResponse->id = $id;
		if (!$this->IdeaResponse->exists()) {
			throw new NotFoundException(__('Invalid %s', __('idea response')));
		}
		if ($this->IdeaResponse->delete()) {
			$this->Session->flashSuccess(__('The %s deleted', __('idea response')));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->flashError(__('The %s was not deleted', __('idea response')));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add($ideaId = null) {
		$auth = $this->Auth->user();
		if ($this->request->is('post')) {
			$this->request->data['IdeaResponse']['user_id'] = $auth['id'];
			$this->IdeaResponse->create();
			if ($this->IdeaResponse->save($this->request->data)) {
				$this->Session->flashSuccess(__('The %s has been saved', __('idea response')));

				$idea = $this->Idea->read(null, $this->request->data['IdeaResponse']['idea_id']);
				if ($idea['Idea']['user_id'] != $this->Auth->user('id')) {
					$link = Router::url('/ideas/view/'.$idea['Idea']['id'].'#comment', false);
					$messageData = array('Notice' => array(
									'user_id' => $idea['Idea']['user_id'],
									'message' => "<a href='$link'>" . __('\'%s\' has a new-arrival comment.', $idea['Idea']['title']) . "</a>",
									));
					$noticeCount = $this->Notice->find('count', array('conditions' => $messageData['Notice']));
					if ($noticeCount == 0) {
						// Add Notice Message
						if (!$this->Notice->save($messageData)) {
							$this->log("Save Failed Notice Message", LOG_WARNING);
						}
					}
				}

				if ($this->referer() != null) {
					$this->redirect($this->referer());
				} else if ($ideaId != null) {
					$this->redirect(array('controller' => 'ideas', 'action' => 'index'));
				} else {
					$this->redirect(array('action' => 'index'));
				}
			} else {
				$this->Session->flashError(__('The %s could not be saved. Please, try again.', __('idea response')));
			}
		} else if ($ideaId != null) {
			if (!$this->Idea->exists($ideaId)) {
				throw new NotFoundException(__('Invalid idea'));
			}
		}
		$ideas = $this->IdeaResponse->Idea->find('list');
		$this->set(compact('ideas', 'users', 'ideaId'));
	}

	/**
	 * ajax_response method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @return exit
	 */
	public function ajax_response() {
		$this->layout = "plain";
		if($this->request->is('ajax')) {
			$idea_id = ($this->request->data('idea_id'))? $this->request->data('idea_id'):0;
			$this->autoRender = false;
			$this->layout = "ajax";
			$this->IdeaResponse->recursive = 1;
			$list = $this->IdeaResponse->find('all',array(
					'conditions' => array('IdeaResponse.idea_id'=>$idea_id),
					'fields' => array('User.first_name','User.last_name','IdeaResponse.body','IdeaResponse.modified' ),
					'order' => array('IdeaResponse.id' => 'desc'),
					'limit' => 1
			));
			echo json_encode(compact('list'));
		}
		exit;
	}
}
