<?php
App::uses('AppModel', 'Model');
/**
 * IdeaResponse Model
 *
 * @property Idea $Idea
 * @property User $User
 * @property IdeaResponseRating $IdeaResponseRating
 */
class IdeaResponse extends AppModel {

	public $actsAs = array('Search.Searchable');
	public $filterArgs = array(
		'id' => array('type' => 'value'),
		'title' => array('type' => 'like', 'field' => 'Idea.title'),
		'name' => array('type' => 'query', 'method' => 'findByUserName'),
		'body' => array('type' => 'like'),
	);

	public function findByUserName($data = array()) {
		$name = $data['name'];
		$cond = array(
			"User.last_name || User.first_name like '%$name%'"
		);
		return $cond;
	}

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'idea_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Idea' => array(
			'className' => 'Idea',
			'foreignKey' => 'idea_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
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
		'IdeaResponseRating' => array(
			'className' => 'IdeaResponseRating',
			'foreignKey' => 'idea_response_id',
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

}
