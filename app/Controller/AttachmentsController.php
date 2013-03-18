<?php
App::uses('AppController', 'Controller');
/**
 * Attachments Controller
 *
 * @property Attachment $Attachment
 */
class AttachmentsController extends AppController {

	public $helper = array('Attachment');
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Attachment->recursive = 0;
		$this->set('attachments', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Attachment->id = $id;
		if (!$this->Attachment->exists()) {
			throw new NotFoundException(__('Invalid %s', __('attachment')));
		}
		$this->set('attachment', $this->Attachment->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Attachment->create();
			if ($this->Attachment->save($this->request->data)) {
				$this->Session->flashSuccess(__('The %s has been saved', __('attachment')));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->flashError(__('The %s could not be saved. Please, try again.', __('attachment')));
			}
		}
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Attachment->id = $id;
		if (!$this->Attachment->exists()) {
			throw new NotFoundException(__('Invalid %s', __('attachment')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Attachment->save($this->request->data)) {
				$this->Session->flashSuccess(__('The %s has been saved', __('attachment')));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->flashError(__('The %s could not be saved. Please, try again.', __('attachment')));
			}
		} else {
			$this->request->data = $this->Attachment->read(null, $id);
		}
	}

/**
 * admin_delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Attachment->id = $id;
		if (!$this->Attachment->exists()) {
			throw new NotFoundException(__('Invalid %s', __('attachment')));
		}
		if ($this->Attachment->delete()) {
			$this->Session->flashSuccess(__('The %s deleted', __('attachment')));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->flashError(__('The %s was not deleted', __('attachment')));
		$this->redirect(array('action' => 'index'));
	}
}
