<?php
App::uses('AppModel', 'Model');
App::uses('Sanitize', 'Utility');
/**
 * AppSetting Model
 *
 */
class AppSetting extends AppModel {

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
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength', 255),
				'message' => 'Please input 255 characters or less.'
			),
		),
	);

	public function beforeSave($options=Array()) {
		parent::beforeSave($options);
		$this->data['AppSetting']['title'] = Sanitize::stripScripts($this->data['AppSetting']['title']);
		$this->data['AppSetting']['title'] = Sanitize::stripTagAttributes($this->data['AppSetting']['title'], 'onclick');
		return true;
	}

}
