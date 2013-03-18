<?php
App::uses('AppController', 'Controller');
/**
 * InputItems Controller
 *
 * @property InputItem $InputItem
 */
class InputItemsController extends AppController {

	private function getInputTypeList() {
		return array(
					INPUT_TYPE_STRING => '1行文字列',
					INPUT_TYPE_TEXT => '複数行文字列',
					INPUT_TYPE_FILES => 'ファイルアップロード',
		);
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->paginate = array(
						'conditions'=> array('InputItem.delete_flg' => false ),
						'order' => 'InputItem.id DESC'
		);

		$this->InputItem->recursive = 0;
		$this->set('inputItems', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->InputItem->exists($id)) {
			throw new NotFoundException(__('Invalid input item'));
		}
		$options = array('conditions' => array('InputItem.' . $this->InputItem->primaryKey => $id));
		$this->set('inputItem', $this->InputItem->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->InputItem->create();
			if ($this->InputItem->save($this->request->data)) {
				$this->Session->setFlash(__('The input item has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The input item could not be saved. Please, try again.'));
			}
		}
		$types = $this->getInputTypeList();
		$this->set(compact('types'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->InputItem->exists($id)) {
			throw new NotFoundException(__('Invalid input item'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->InputItem->save($this->request->data)) {
				$this->Session->setFlash(__('The input item has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The input item could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('InputItem.' . $this->InputItem->primaryKey => $id));
			$this->request->data = $this->InputItem->find('first', $options);
		}
		$types = $this->getInputTypeList();
		$this->set(compact('types'));
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
		$this->InputItem->id = $id;
		if (!$this->InputItem->exists()) {
			throw new NotFoundException(__('Invalid input item'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->InputItem->saveField('delete_flg', true)) {
			$this->Session->setFlash(__('Input item deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Input item was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
