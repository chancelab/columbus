<?php
App::uses('AppController', 'Controller');
/**
 * Ajax Controller
 *
 * @property Notice $Notice
 */
class AjaxController extends AppController {

	public $layout = "plain";
	public $autoRender = false;

	/**
	 * Action for session keep alive
	 */
	public function heartBeat() {
		echo json_encode(array(JSON_KEY_RESULT => JSON_VALUE_RESULT_SUCCESS));
	}

	/**
	 * Read Notice Message
	 */
	public function read_notice_message() {
		if ($this->Auth->isAuthorized() &&
			($this->request->is('post') || $this->request->is('put')) &&
			$this->Notice->exists($this->request->data['Notice']['id'])) {

			$notice = $this->Notice->read(null, $this->request->data['Notice']['id']);
			if ($notice['Notice']['user_id'] == $this->Auth->user('id') && $this->Notice->delete($this->request->data['Notice']['id'])) {
				echo json_encode(array(JSON_KEY_RESULT => JSON_VALUE_RESULT_SUCCESS));
				return;
			}
		}

		echo json_encode(array(JSON_KEY_RESULT => JSON_VALUE_RESULT_FAILED));
	}

}