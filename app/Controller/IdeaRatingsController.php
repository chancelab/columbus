<?php
App::uses('AppController', 'Controller');
/**
 * IdeaRatings Controller
 *
 * @property IdeaRating $IdeaRating
 */
class IdeaRatingsController extends AppController {

	/**
	 * Vote(評価)
	 * @param Integer $ideaId
	 */
	public function vote($ideaId = null) {
		$this->autoRender = false;
		$auth = $this->Auth->user();

		if ($ideaId != null && $this->IdeaRating->Idea->exists($ideaId)) {
			// 評価値算出
			$p_rates = $this->request->query['rates'];
			$rating = floor($p_rates / 33);

			// 既存データのチェック
			$exist = $this->IdeaRating->find('first', array('conditions' => array('IdeaRating.idea_id' => $ideaId, 'IdeaRating.user_id' => $auth['id'])));
			if ($exist == null) {
				$data = $this->IdeaRating->create();
				$data['IdeaRating']['idea_id'] = $ideaId;
				$data['IdeaRating']['user_id'] = $auth['id'];
				$data['IdeaRating']['rating'] = $rating;
				$this->IdeaRating->save($data);
			} else if ($exist['IdeaRating']['rating'] == $rating) {
				// 評価の取り消し
				$this->IdeaRating->delete($exist['IdeaRating']['id']);
				$p_rates = 0;
			} else {
				$data = $exist;
				$data['IdeaRating']['idea_id'] = $ideaId;
				$data['IdeaRating']['user_id'] = $auth['id'];
				$data['IdeaRating']['rating'] = $rating;
				$this->IdeaRating->save($data);
			}
			$totalRating = $this->IdeaRating->find('first', array('fields' => '(SUM(rating)) As "IdeaRating__totalRatings"', 'conditions' => array('idea_id' => $ideaId)));
			$total = $totalRating['IdeaRating']['totalRatings'];
			$users = $this->IdeaRating->find('count', array('conditions' => array('idea_id' => $ideaId)));
			$result = array(JSON_KEY_RESULT => JSON_VALUE_RESULT_SUCCESS, 'rates' => $p_rates, 'users' => $users, 'total' => $total);
			echo json_encode($result);
		} else {
			$result = array(JSON_KEY_RESULT => JSON_VALUE_RESULT_FAILED, 'reason' => 'Invalid Parameter');
			echo json_encode($result);
		}
	}

}
