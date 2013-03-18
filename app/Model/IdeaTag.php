<?php
App::uses('AppModel', 'Model');
/**
 * IdeaTag Model
 *
 * @property Idea $Idea
 * @property Tag $Tag
 * @property User $User
 */
class IdeaTag extends AppModel {

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'idea_id' => array(
			'numeric' => array(
				'rule' => array('isUniqueWith', 'tag_id'),
				'message' => 'already exists.',
				'allowEmpty' => false,
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
		'Tag' => array(
			'className' => 'Tag',
			'foreignKey' => 'tag_id',
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
}
