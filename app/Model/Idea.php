<?php
App::uses('AppModel', 'Model');
App::uses('Sanitize', 'Utility');
/**
 * Idea Model
 *
 * @property User $User
 * @property Status $Status
 * @property IdeaAddInput $IdeaAddInput
 * @property IdeaRating $IdeaRating
 * @property IdeaResponse $IdeaResponse
 */
class Idea extends AppModel {

	public $actsAs = array('Search.Searchable');

	public $filterArgs = array(
		'id' => array('type' => 'value'),
		'status_id' => array('type' => 'subquery', 'method' => 'findByStatuses', 'field' => 'Idea.status_id'),
		'tag_id' => array('type' => 'query', 'method' => 'findByTags'),
		'title' => array('type' => 'like'),
		'body' => array('type' => 'like'),
	);

	public function findByStatuses($data = array(), $field = array()) {
		$this->Status->Behaviors->attach('Search.Searchable');
		$query = $this->Status->getQuery('all', array(
			'conditions' => array('Status.id'  => explode('|', $data[$field['name']])),
			'fields' => array('Status.id'),
		));
		return $query;
	}

	public function findByTags($data = array()) {
		$tagIds = explode('|', $data['tag_id']);
		$strTagIds = join(',', $tagIds);
		$cond = array(
			"EXISTS(SELECT * FROM idea_tags WHERE idea_tags.idea_id = Idea.id AND idea_tags.tag_id IN ($strTagIds))"
		);
		return $cond;
	}

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'status_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'image' => array(
			'allowExtention' => array(
				'rule' => array('checkExtension', array('jpg')),
				'allowEmpty' => true),
				'illegalCode' => array('rule' => array('funcCheckFile', 'checkIllegalCode'),
				'allowEmpty' => true
			),
		),
	);

	public function setVirtualFields($authId) {
		$newThresholdDate = date('Y/m/d H:i:s', strtotime('-'.NEW_THRESHOLD_HOUR .' hour'));
		$this->virtualFields = array(
			'ratings' => "SELECT SUM(rating) FROM idea_ratings WHERE Idea.id = idea_ratings.idea_id AND idea_ratings.user_id = $authId",
			'total_ratings' => 'SELECT COALESCE(SUM(rating), 0) FROM idea_ratings WHERE Idea.id = idea_ratings.idea_id',
			'ratings_count' => 'SELECT COUNT(rating) FROM idea_ratings WHERE Idea.id = idea_ratings.idea_id',
			'idea_responses_count' => 'SELECT COUNT(id) FROM idea_responses WHERE Idea.id = idea_responses.idea_id',
			'new_comment' => "EXISTS(SELECT * FROM idea_responses WHERE Idea.id = idea_responses.idea_id AND idea_responses.modified > '$newThresholdDate')",
			'last_modified' => 'CASE WHEN Idea.modified >= COALESCE((select max(modified) from idea_responses WHERE Idea.id = idea_responses.idea_id), \'1990-01-01\') THEN Idea.modified ELSE (select max(modified) from idea_responses WHERE Idea.id = idea_responses.idea_id) END'
		);
	}

	public function beforeSave($options=Array()) {
		parent::beforeSave($options);
		$this->data['Idea']['body'] = Sanitize::stripScripts($this->data['Idea']['body']);
		$this->data['Idea']['body'] = Sanitize::stripTagAttributes($this->data['Idea']['body'], 'onclick');
		return true;
	}

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Status' => array(
			'className' => 'Status',
			'foreignKey' => 'status_id',
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
		'IdeaAddInput' => array(
			'className' => 'IdeaAddInput',
			'foreignKey' => 'idea_id',
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
			'foreignKey' => 'idea_id',
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
			'foreignKey' => 'idea_id',
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
		'IdeaTag' => array(
			'className' => 'IdeaTag',
			'foreignKey' => 'idea_id',
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
		'Attachment' => array(
			'className' => 'Attachment',
			'foreignKey' => 'foreign_key',
			'conditions' => array(
				'Attachment.model' => 'Idea',
			)
		)
	);

}
