<?php
App::uses('AppModel', 'Model');
/**
 * InputItem Model
 *
 * @property IdeaAddInput $IdeaAddInput
 */
class InputItem extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'IdeaAddInput' => array(
			'className' => 'IdeaAddInput',
			'foreignKey' => 'input_item_id',
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
