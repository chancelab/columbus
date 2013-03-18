<?php
App::uses('AppController', 'Controller');
/**
 * Statuses Controller
 *
 * @property Status $Status
 * @property StatusWorkflow $StatusWorkflow
 */
class StatusesController extends AppController {

	public $uses = array('Status', 'StatusWorkflow', 'Role');

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this->paginate = array(
						'conditions' => array('Status.delete_flg !=' => true),
						'order' => 'Status.order');
		$this->Status->recursive = 0;
		$this->set('statuses', $this->paginate());
	}

	/**
	 * admin_workflow method
	 *
	 * @return void
	 */
	public function admin_workflow() {
		$statuses = $this->Status->find('all', array('conditions' => array('delete_flg != ' => true), 'order' => 'Status.order'));
		$roles = $this->Role->find('list', array('order' => 'Role.id'));
		$this->set(compact('statuses', 'roles'));
	}

	/**
	 * admin_ajax_workflow method
	 *
	 * @return void
	 */
	public function admin_ajax_workflow() {
		$this->autoRender = false;
		$this->StatusWorkflow->unbindModelAll();
		if ($this->request->is('post') || $this->request->is('put')) {
			$data = $this->StatusWorkflow->find('all', array('conditions' => array('role_id' => $this->request->data['StatusWorkflow']['role_id'])));
			echo json_encode(array(JSON_KEY_RESULT => JSON_VALUE_RESULT_SUCCESS, 'data' => $data));
		} else {
			echo json_encode(array(JSON_KEY_RESULT => JSON_VALUE_RESULT_FAILED));
		}
	}

	/**
	 * admin_ajax_workflow_save method
	 *
	 * @return void
	 */
	public function admin_ajax_workflow_save() {
		$result = false;
		$this->autoRender = false;
		$this->StatusWorkflow->unbindModelAll();
		if ($this->request->is('post') || $this->request->is('put')) {
			$isAdd = $this->request->data['StatusWorkflow']['is_add'];
			$data = $this->request->data;
			unset($data['StatusWorkflow']['is_add']);
			if (strtolower($isAdd) == 'true') {
				// Add Data
				$existCount = $this->StatusWorkflow->find('count', array('conditions' => $data['StatusWorkflow']));
				if ($existCount == 0) {
					$result = $this->StatusWorkflow->save($data);
				} else {
					$result = true;
				}
			} else {
				// Remove Data
				$result = $this->StatusWorkflow->deleteAll($data['StatusWorkflow'], false);
			}
		}

		if ($result) {
			echo json_encode(array(JSON_KEY_RESULT => JSON_VALUE_RESULT_SUCCESS));
		} else {
			echo json_encode(array(JSON_KEY_RESULT => JSON_VALUE_RESULT_FAILED));
		}
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Status->create();
			$maxOrder = $this->Status->find('first', array('fields' => 'COALESCE(MAX(Status.order), 1) as max_order', 'conditions' => array('Status.delete_flg !=' => true)));
			if ($maxOrder != null) {
				$this->request->data['Status']['order'] = $maxOrder[0]['max_order'] + 1;
			}
			if ($this->Status->save($this->request->data)) {
				$this->Session->flashSuccess(__('The status has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->flashError(__('The status could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Status->exists($id)) {
			throw new NotFoundException(__('Invalid status'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Status->save($this->request->data)) {
				$this->Session->flashSuccess(__('The status has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->flashError(__('The status could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Status.' . $this->Status->primaryKey => $id));
			$this->request->data = $this->Status->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param integer $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Status->unbindModel(array('hasMany' => array('Idea')));
		$this->Status->id = $id;
		if (!$this->Status->exists()) {
			throw new NotFoundException(__('Invalid status'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Status->saveField('delete_flg', true)) {
			$data = $this->Status->find('all', array('conditions' => array('delete_flg !=' => true), 'order' => 'Status.order'));
			for ($i = 0; $i < count($data); $i++) {
				$data[$i]['Status']['order'] = $i + 1;
			}
			if ($this->Status->saveAll($data)) {
				$this->Session->flashSuccess(__('Status deleted'));
				$this->redirect(array('action' => 'index'));
			}
		}
		$this->Session->flashError(__('Status was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * admin_default_status method
	 * @param integer $id
	 * @throws NotFoundException
	 */
	public function admin_default_status($id = null) {
		$this->Status->id = $id;
		if (!$this->Status->exists()) {
			throw new NotFoundException(__('Invalid status'));
		}
		$this->request->onlyAllow('post', 'delete');
		$result = $this->Status->updateAll(array('default' => false), array('default' => true));
		if ($result && $this->Status->saveField('default', true)) {
			$this->Session->flashSuccess(__('The status has been saved'));
		} else {
			$this->Session->flashError(__('The status could not be saved. Please, try again.'));
		}
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * admin_close_status method
	 * @param integer $id
	 * @throws NotFoundException
	 */
	public function admin_close_status($id = null) {
		$this->Status->id = $id;
		if (!$this->Status->exists()) {
			throw new NotFoundException(__('Invalid status'));
		}
		$this->request->onlyAllow('post', 'delete');
		$data = $this->Status->read('close_flg', $id);
		$flag = $data['Status']['close_flg'] ? true : false;
		if ($this->Status->saveField('close_flg', !$flag)) {
			$this->Session->flashSuccess(__('The status has been saved'));
		} else {
			$this->Session->flashError(__('The status could not be saved. Please, try again.'));
		}
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * admin_up_order method
	 * @param integer $id
	 * @throws NotFoundException
	 */
	public function admin_up_order($id = null) {
		$this->Status->id = $id;
		if (!$this->Status->exists()) {
			throw new NotFoundException(__('Invalid status'));
		}
		$this->request->onlyAllow('post', 'delete');
		$data = $this->Status->read('order', $id);
		$order = $data['Status']['order'];
		if ($order > 1) {
			if ($this->Status->updateAll(array('order' => $order), array('order' => ($order-1))) && $this->Status->saveField('order', ($order-1))) {
				$this->Session->flashSuccess(__('The status has been saved'));
			} else {
				$this->Session->flashError(__('The status could not be saved. Please, try again.'));
			}
		}
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * admin_down_order method
	 * @param integer $id
	 * @throws NotFoundException
	 */
	public function admin_down_order($id = null) {
		$this->Status->id = $id;
		if (!$this->Status->exists()) {
			throw new NotFoundException(__('Invalid status'));
		}
		$this->request->onlyAllow('post', 'delete');
		$data = $this->Status->read('order', $id);
		$order = $data['Status']['order'];
		$maxOrder = $this->Status->find('first', array('fields' => 'MAX(Status.order) as max_order', 'conditions' => array('Status.delete_flg !=' => true)));
		if ($maxOrder != null && $order < $maxOrder[0]['max_order']) {
			if ($this->Status->updateAll(array('order' => $order), array('order' => ($order+1))) && $this->Status->saveField('order', ($order+1))) {
				$this->Session->flashSuccess(__('The status has been saved'));
			} else {
				$this->Session->flashError(__('The status could not be saved. Please, try again.'));
			}
		}
		$this->redirect(array('action' => 'index'));
	}
}
