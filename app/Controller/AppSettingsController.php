<?php
App::uses('AppController', 'Controller');
/**
 * AppSettings Controller
 *
 * @property AppSetting $AppSetting
 */
class AppSettingsController extends AppController {

	private function getInputTypeList() {
		return array(
			ANY_USERADD_DISABLE => __('DISABLE'),
			ANY_USERADD_ENABLE => __('ENABLE'),
// TODO: 将来的に実装予定なので、今はコメントアウトしておく
//			ANY_USERADD_EMAIL => __('APPD EMAIL'),
			ANY_USERADD_ADMIN => __('APPD ADMIN'),
		);
	}

	/**
	 * admin_edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit() {
		$data = $this->AppSetting->find('first', array('order' => 'AppSetting.id'));
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AppSetting->save($this->request->data)) {
				$this->Session->flashSuccess(__('The %s has been saved', __('app setting')));
				$this->redirect(array('action' => 'edit'));
			} else {
				$this->Session->flashError(__('The %s could not be saved. Please, try again.', __('app setting')));
			}
		} else if ($data != null) {
			$this->request->data = $data;
		}
		$any_useradds = $this->getInputTypeList();
		$this->set(compact('any_useradds'));
	}

}
