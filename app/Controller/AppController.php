<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');
App::uses('ClassRegistry', 'Utility');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array(
		'Acl',
		'Auth' => array(
			'authorize' => array(
				'Actions' => array('actionPath' => 'controllers')
			)
		),
		'Session',
		'Cookie',
		'RequestHandler',
		'Search.Prg',
		'DebugKit.Toolbar'
	);

	public $helpers = array(
		'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
		'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
		'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),
		'Session',
		'Js'
	);

	/** Application Setting Data */
	public $_AppSetting = null;

	public $Notice = null;

	/**
	 * (non-PHPdoc) Called before the controller action.
	 * @see Controller::beforeFilter()
	 */
	public function beforeFilter() {
		App::import('core', 'l10n');
		Configure::write('Config.language', 'ja');

		// Cookie Setting
		$this->Cookie->time = '365 Days';

		// Read Application Setting
		$AppSetting = ClassRegistry::init('AppSetting');
		$this->_AppSetting = $AppSetting->find('first');
		if ($this->_AppSetting != null) {
			$this->set('title_for_layout', $this->_AppSetting['AppSetting']['title']);
		}
		$this->set('app_settings', $this->_AppSetting);

		// Read Notices
		$notices = null;
		if ($this->Auth->user()) {
			$this->Notice = ClassRegistry::init('Notice');
			$notices = $this->Notice->find('all', array('conditions' => array('user_id' => $this->Auth->user('id')), 'order' => 'Notice.modified desc'));
		}
		$this->set('notices', $notices);

		// Judge Admin Routing
		if (strtolower($this->params['prefix']) == 'admin' || strtolower($this->name) == 'admin') {
			$this->layout = 'admin';
			$this->admin_auth();
		} else {
			$this->layout = 'twitter_bootstrap';
			$this->default_auth();
		}
	}

	/**
	 * For Admin Auth Setting
	 */
	protected function admin_auth() {
		$this->Auth->loginAction = '/admin/users/login';
		$this->Auth->logoutAction = '/admin/users/logout';
		$this->Auth->logoutRedirect = '/admin/users/login';
		$this->Auth->loginRedirect = '/admin/';
		$this->Auth->allow('login', 'logout');
		$this->Auth->authenticate[AuthComponent::ALL] = array(
			'scope' => array('User.delete_flg' => false, 'User.appd_flg' => true),
		);
	}

	/**
	 * For Default Auth Setting
	 */
	protected function default_auth() {
		$this->Auth->loginAction = '/users/login';
		$this->Auth->logoutAction = '/users/logout';
		$this->Auth->logoutRedirect = '/users/login';
		$this->Auth->loginRedirect = '/';
		if ($this->_AppSetting != null && $this->_AppSetting['AppSetting']['allow_anonymous'] == true) {
			$this->Auth->allow('login', 'logout', 'signup', 'index', 'view');
		} else {
			$this->Auth->allow('login', 'logout', 'signup');
		}
		$this->Auth->authenticate[AuthComponent::ALL] = array(
			'scope' => array('User.delete_flg' => false, 'User.appd_flg' => true),
		);
	}
}
