<?php
App::uses('AppController', 'Controller');
/**
 * IdeaResponseRatings Controller
 *
 * @property IdeaResponseRating $IdeaResponseRating
 */
class IdeaResponseRatingsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->IdeaResponseRating->recursive = 0;
		$this->set('ideaResponseRatings', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->IdeaResponseRating->id = $id;
		if (!$this->IdeaResponseRating->exists()) {
			throw new NotFoundException(__('Invalid %s', __('idea response rating')));
		}
		$this->set('ideaResponseRating', $this->IdeaResponseRating->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->IdeaResponseRating->create();
			if ($this->IdeaResponseRating->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('idea response rating')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('idea response rating')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		}
		$ideaResponses = $this->IdeaResponseRating->IdeaResponse->find('list');
		$users = $this->IdeaResponseRating->User->find('list');
		$this->set(compact('ideaResponses', 'users'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->IdeaResponseRating->id = $id;
		if (!$this->IdeaResponseRating->exists()) {
			throw new NotFoundException(__('Invalid %s', __('idea response rating')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->IdeaResponseRating->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('idea response rating')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('idea response rating')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		} else {
			$this->request->data = $this->IdeaResponseRating->read(null, $id);
		}
		$ideaResponses = $this->IdeaResponseRating->IdeaResponse->find('list');
		$users = $this->IdeaResponseRating->User->find('list');
		$this->set(compact('ideaResponses', 'users'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->IdeaResponseRating->id = $id;
		if (!$this->IdeaResponseRating->exists()) {
			throw new NotFoundException(__('Invalid %s', __('idea response rating')));
		}
		if ($this->IdeaResponseRating->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('idea response rating')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('idea response rating')),
			'alert',
			array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			)
		);
		$this->redirect(array('action' => 'index'));
	}
}
