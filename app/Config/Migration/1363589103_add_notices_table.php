<?php
class AddNoticesTable extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 * @access public
 */
	public $description = '';

/**
 * Actions to be performed
 *
 * @var array $migration
 * @access public
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'notices' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
					'user_id' => array('type' => 'integer', 'null' => true, 'after' => 'id'),
					'message' => array('type' => 'text', 'null' => true, 'length' => 1073741824, 'after' => 'user_id'),
					'created' => array('type' => 'datetime', 'null' => true, 'after' => 'message'),
					'modified' => array('type' => 'datetime', 'null' => true, 'after' => 'created'),
					'indexes' => array(
						'PRIMARY' => array('unique' => true, 'column' => 'id'),
					),
					'tableParameters' => array(),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'notices'
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function after($direction) {
		return true;
	}
}
