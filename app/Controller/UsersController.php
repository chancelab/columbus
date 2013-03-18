<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property AppSetting $AppSetting
 */
class UsersController extends AppController {

	public $uses = array('User','AppSetting');

	/**
	 * Default Login
	 */
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect(array('controller'=>'ideas','action' => 'index'));
			} else {
				$this->Session->setFlash('Your username or password was incorrect.');
			}
		}
		$this->set('setting', $this->_AppSetting);
	}

	/**
	 * Default Logout
	 */
	public function logout() {
		$this->redirect($this->Auth->logout());
	}

	/**
	 * Register New User
	 */
	public function signup() {
		switch ($this->_AppSetting['AppSetting']['any_useradd']) {
			case ANY_USERADD_DISABLE:
				if ($this->referer() != null) {
					$this->redirect($this->referer());
				} else {
					$this->redirect('/');
				}
				return;
			case ANY_USERADD_EMAIL:
				// TODO: Confirm E-mail Send
			case ANY_USERADD_ADMIN:
				$this->request->data['User']['appd_flg'] = null;
				break;
		}
		if ($this->request->is('post')) {
			$this->User->create();
			$this->request->data['User']['role_id'] = USER_ROLE_INDEX;
			if ($this->User->save($this->request->data)) {
				if ($this->_AppSetting['AppSetting']['any_useradd'] == ANY_USERADD_ENABLE) {
					// Auto Login
					$data = array('User.username' => $this->request->data['User']['username'], 'User.password' => $this->request->data['User']['password']);
					if ($this->Auth->login($data)) {
						$auth = $this->Auth->user();
						$auth += $this->User->read(null, $this->User->getLastInsertID());
						$this->Session->write('Auth', $auth);
					}
				}
				$this->Session->setFlash(__('The user profile has been saved'));
				$this->redirect('/');
			} else {
				$this->Session->setFlash(__('The user profile could not be saved. Please, try again.'));
			}
		}
		$this->set('setting', $this->_AppSetting);
	}

	public function admin_appd_user($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$data = $this->User->read(null, $id);
			$data['User']['appd_flg'] = true;
			$this->User->save($data, array('fieldList' => array('appd_flg', 'modified')));
		}
		$this->redirect(array('action' => 'index'));
	}

	public function admin_reject_user($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$data = $this->User->read(null, $id);
			$data['User']['appd_flg'] = false;
			$this->User->save($data, array('fieldList' => array('appd_flg', 'modified')));
		}
		$this->redirect(array('action' => 'index'));
	}

	// 管理画面ログイン
	public function admin_login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				if($this->Session->read('Auth.User.role_id') == ADMIN_ROLE_INDEX){
					$this->redirect($this->Auth->redirect());
				} else {
					$this->redirect('../../');
				}
			} else {
				$this->Session->setFlash('Your username or password was incorrect.');
			}
		}
	}

	// 管理画面ログアウト
	public function admin_logout() {
		$this->redirect($this->Auth->logout());
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->paginate = array(
						'conditions'=> array('User.delete_flg' => false ),
						'order' => 'User.id DESC'
		);
		$this->User->recursive = 0;
		$users = $this->paginate();
		$setting = $this->_AppSetting;
		$this->set(compact('users', 'setting'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			// パスワードが空の時は、変更しない
			$whitelist = array('username','last_name','first_name', 'email_address', 'comment', 'modified','role_id','delete_flg');
			if ($this->request->data['User']['password']) {
				$whitelist []= 'password';
			}
			if ($this->User->save($this->request->data, array('fieldList' => $whitelist))) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');

		$data = $this->User->read(null, $id);
		$data['User']['delete_flg'] = true;
		if ($this->User->save($data, array('fieldList' => array('delete_flg', 'modified')))) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


}
