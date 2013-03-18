<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 * @property Role $Role
 * @property Idea $Idea
 * @property IdeaRating $IdeaRating
 * @property IdeaResponse $IdeaResponse
 * @property IdeaResponseRating $IdeaResponseRating
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'username';

	public $actsAs = array('Acl' => array('type' => 'requester', 'enabled' => false));

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'alphanumeric' => array(
				'rule' => array('custom', '/^[\w\.-]+$/i'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'alphaNumeric' => array(
				'rule' => array('custom', '/^[\w\.-]+$/i'),
				'message' => 'Please type using half-width characters.'
			),
			'maxLength' => array(
				'rule' => array('maxLength', 40),
				'message' => 'Please input 40 characters or less.'
			),
			'checkPassword' => array(
				'rule' => array('checkPassword'),
				'message' => 'password doesn\'t exist.',
			),

		),
		'tmp_password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'alphaNumeric' => array(
				'rule' => array('custom', '/^[\w\.-]+$/i'),
				'message' => 'Please type using half-width characters.'
			),
			'maxLength' => array(
				'rule' => array('maxLength', 40),
				'message' => 'Please input 40 characters or less.'
			)
		),
		'role_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'last_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'first_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email_address' => array(
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'already exists.',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'role_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Idea' => array(
			'className' => 'Idea',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'IdeaRating' => array(
			'className' => 'IdeaRating',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'IdeaResponse' => array(
			'className' => 'IdeaResponse',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'IdeaResponseRating' => array(
			'className' => 'IdeaResponseRating',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public function beforeSave($options=Array()) {
		if (!isset($this->data['User']['password'])) return false;
		// 保存前にパスワードのハッシュ化を行う
		$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		return true;
	}

	public function parentNode() {
		if (!$this->id && empty($this->data)) {
			return null;
		}
		if (isset($this->data['User']['role_id'])) {
			$groupId = $this->data['User']['role_id'];
		} else {
			$groupId = $this->field('group_id');
		}
		if (!$groupId) {
			return null;
		} else {
			return array('Role' => array('id' => $groupId));
		}
	}

	function bindNode($user) {
		return array('model' => 'Role', 'foreign_key' => $user['User']['role_id']);
	}

	public function checkPassword($data) {
		return $this->data['User']['password'] == $this->data['User']['tmp_password'];
	}


}
