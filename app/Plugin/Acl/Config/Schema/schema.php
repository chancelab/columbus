<?php
class AclSchema extends CakeSchema {

    public function before($event = array()) {
        return true;
    }

    public function after($event = array()) {
    }

    // 下記はACLプラグインにとって必要最低限のテーブルとカラム
    // ユーザー
    var $users = array(
            'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
            'username' => array('type' => 'string', 'length' => 255, 'null' => false, 'default' => NULL),
            'password' => array('type' => 'string', 'length' => 40, 'null' => false, 'default' => NULL),
            'role_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
            'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
            'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
            'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
            'tableParameters' => array()
    );

    // ロール
    var $roles = array(
            'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
            'name' => array('type' => 'string', 'length' => 100, 'null' => false, 'default' => NULL),
            'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
            'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
            'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
            'tableParameters' => array()
    );

    // ???
    var $blogs = array(
            'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
            'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
            'title' => array('type' => 'string', 'length' => 255, 'null' => false, 'default' => NULL),
            'body' => array('type' => 'string', 'length' => 255, 'null' => false, 'default' => NULL),
            'status' => array('type' => 'integer', 'null' => false, 'default' => NULL),
            'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
            'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
            'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
            'tableParameters' => array()
    );

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
}
