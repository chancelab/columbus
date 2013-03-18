<?php 
class AppSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $acos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => true),
		'model' => array('type' => 'string', 'null' => true, 'default' => null),
		'foreign_key' => array('type' => 'integer', 'null' => true),
		'alias' => array('type' => 'string', 'null' => true, 'default' => null),
		'lft' => array('type' => 'integer', 'null' => true),
		'rght' => array('type' => 'integer', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $app_settings = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false),
		'enable_smtp' => array('type' => 'boolean', 'null' => true),
		'smtp_from' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'smtp_host' => array('type' => 'string', 'null' => true, 'default' => null),
		'smtp_port' => array('type' => 'integer', 'null' => true, 'default' => '465'),
		'smtp_username' => array('type' => 'string', 'null' => true, 'default' => null),
		'smtp_password' => array('type' => 'string', 'null' => true, 'default' => null),
		'allow_anonymous' => array('type' => 'boolean', 'null' => true),
		'any_useradd' => array('type' => 'integer', 'null' => true, 'default' => '0'),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $aros = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => true),
		'model' => array('type' => 'string', 'null' => true, 'default' => null),
		'foreign_key' => array('type' => 'integer', 'null' => true),
		'alias' => array('type' => 'string', 'null' => true, 'default' => null),
		'lft' => array('type' => 'integer', 'null' => true),
		'rght' => array('type' => 'integer', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $aros_acos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'aro_id' => array('type' => 'integer', 'null' => false),
		'aco_id' => array('type' => 'integer', 'null' => false),
		'_create' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
		'_read' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
		'_update' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
		'_delete' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'aro_aco_key' => array('unique' => true, 'column' => array('aro_id', 'aco_id'))
		),
		'tableParameters' => array()
	);

	public $attachments = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'model' => array('type' => 'string', 'null' => false, 'length' => 11),
		'foreign_key' => array('type' => 'integer', 'null' => false),
		'name' => array('type' => 'string', 'null' => false),
		'dir' => array('type' => 'string', 'null' => true),
		'type' => array('type' => 'string', 'null' => true),
		'size' => array('type' => 'integer', 'null' => true, 'default' => '0'),
		'active' => array('type' => 'integer', 'null' => true, 'default' => '1'),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $idea_add_inputs = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'idea_id' => array('type' => 'integer', 'null' => false),
		'input_item_id' => array('type' => 'integer', 'null' => false),
		'body' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $idea_ratings = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'idea_id' => array('type' => 'integer', 'null' => false),
		'user_id' => array('type' => 'integer', 'null' => true),
		'rating' => array('type' => 'integer', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'uix_idea_ratings' => array('unique' => true, 'column' => array('idea_id', 'user_id'))
		),
		'tableParameters' => array()
	);

	public $idea_response_ratings = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'idea_response_id' => array('type' => 'integer', 'null' => false),
		'user_id' => array('type' => 'integer', 'null' => true),
		'rating' => array('type' => 'integer', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'uix_idea_response_ratings' => array('unique' => true, 'column' => array('idea_response_id', 'user_id'))
		),
		'tableParameters' => array()
	);

	public $idea_responses = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'idea_id' => array('type' => 'integer', 'null' => false),
		'user_id' => array('type' => 'integer', 'null' => true),
		'body' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $idea_tags = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'idea_id' => array('type' => 'integer', 'null' => false),
		'tag_id' => array('type' => 'integer', 'null' => true),
		'user_id' => array('type' => 'integer', 'null' => true),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'uix_idea_tags' => array('unique' => true, 'column' => array('idea_id', 'tag_id'))
		),
		'tableParameters' => array()
	);

	public $ideas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => true),
		'status_id' => array('type' => 'integer', 'null' => false),
		'title' => array('type' => 'string', 'null' => true, 'default' => null),
		'body' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'delete_flg' => array('type' => 'boolean', 'null' => true),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $input_items = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false),
		'type' => array('type' => 'integer', 'null' => false),
		'option' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'comment' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'delete_flg' => array('type' => 'boolean', 'null' => true),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $notices = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => true),
		'message' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $roles = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'length' => 100),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $schema_migrations = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'class' => array('type' => 'string', 'null' => false),
		'type' => array('type' => 'string', 'null' => false, 'length' => 50),
		'created' => array('type' => 'datetime', 'null' => false),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $status_workflows = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'role_id' => array('type' => 'integer', 'null' => false),
		'status_id' => array('type' => 'integer', 'null' => false),
		'allow_shift_status_id' => array('type' => 'integer', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $statuses = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null),
		'comment' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'order' => array('type' => 'integer', 'null' => true),
		'default' => array('type' => 'boolean', 'null' => true),
		'close_flg' => array('type' => 'boolean', 'null' => true),
		'delete_flg' => array('type' => 'boolean', 'null' => true),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $tags = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'uix_tags_name' => array('unique' => true, 'column' => 'name')
		),
		'tableParameters' => array()
	);

	public $users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'username' => array('type' => 'string', 'null' => false),
		'password' => array('type' => 'string', 'null' => false, 'length' => 40),
		'role_id' => array('type' => 'integer', 'null' => false),
		'last_name' => array('type' => 'string', 'null' => false, 'length' => 100),
		'first_name' => array('type' => 'string', 'null' => false, 'length' => 100),
		'email_address' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'comment' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'appd_flg' => array('type' => 'boolean', 'null' => true, 'default' => true),
		'delete_flg' => array('type' => 'boolean', 'null' => true),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'uid_users_username' => array('unique' => true, 'column' => 'username')
		),
		'tableParameters' => array()
	);

}
