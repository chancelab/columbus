<?php
App::uses('AppController', 'Controller');
/**
 * IdeaTags Controller
 *
 * @property IdeaTag $IdeaTag
 * @property Tag $Tag
 */
class IdeaTagsController extends AppController {

	public $uses = array('IdeaTag', 'Tag');

	/**
	 * アイデアにタグをつける
	 */
	public function addTag() {
		$this->autoRender = false;
		$auth = $this->Auth->user();
		if ($this->request->is('post') || $this->request->is('put')) {
			// タグ情報の確認(新規 or 既存判定)
			$tagName = '';
			if (!is_numeric($this->request->data['IdeaTag']['tag_id']) && trim($this->request->data['eComboBox']['IdeaTagTagId']) != '') {
				$tagData = $this->Tag->create();
				$tagName = trim($this->request->data['eComboBox']['IdeaTagTagId']);
				$tagData['Tag']['name'] = $tagName;
				if (!$this->Tag->save($tagData)) {
					$error = $this->validateErrors($this->Tag);
					$error[JSON_KEY_RESULT] = JSON_VALUE_RESULT_FAILED;
					echo json_encode($error);
					return;
				}
				$this->request->data['IdeaTag']['tag_id'] = $this->Tag->getLastInsertID();
			} else {
				$tagData = $this->Tag->find('first', array('conditions' => array('id' => $this->request->data['IdeaTag']['tag_id'])));
				if ($tagData) {
					$tagName = $tagData['Tag']['name'];
				}
			}

			// アイデアにタグを付与
			$this->request->data['IdeaTag']['user_id'] = $auth['id'];
			if (!$this->IdeaTag->save($this->request->data)) {
				$error = $this->validateErrors($this->IdeaTag);
				$error[JSON_KEY_RESULT] = JSON_VALUE_RESULT_FAILED;
				echo json_encode($error);
				return;
			} else {
				$result = array(JSON_KEY_RESULT => JSON_VALUE_RESULT_SUCCESS,
								'tag_id' => $this->request->data['IdeaTag']['tag_id'],
								'tag_name' => $tagName);
				echo json_encode($result);
				return;
			}
		}
	}

	/**
	 * アイデアからタグを外す
	 */
	public function removeTag() {
		$this->autoRender = false;
		$auth = $this->Auth->user();
		if ($this->request->is('post') || $this->request->is('put')) {
			$data = $this->IdeaTag->find('first', array('conditions' => array(
							'idea_id' => $this->request->data['IdeaTag']['idea_id'],
							'tag_id' => $this->request->data['IdeaTag']['tag_id'],)));
			if ($data) {
				if ($this->IdeaTag->delete($data['IdeaTag']['id'])) {
					echo json_encode(array(JSON_KEY_RESULT => JSON_VALUE_RESULT_SUCCESS));
				} else {
					echo json_encode(array(JSON_KEY_RESULT => JSON_VALUE_RESULT_FAILED));
				}
			}
		}
	}

}
