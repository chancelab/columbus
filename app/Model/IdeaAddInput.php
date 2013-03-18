<?php
App::uses('AppModel', 'Model');
/**
 * IdeaAddInput Model
 *
 * @property Idea $Idea
 * @property InputItem $InputItem
 */
class IdeaAddInput extends AppModel {

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
		'input_item_id' => array(
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
		'InputItem' => array(
			'className' => 'InputItem',
			'foreignKey' => 'input_item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
