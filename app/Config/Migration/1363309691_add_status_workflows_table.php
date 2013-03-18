<?php
App::uses('ClassRegistry', 'Utility');
class AddStatusWorkflowsTable extends CakeMigration {

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
				'status_workflows' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
					'role_id' => array('type' => 'integer', 'null' => false, 'after' => 'id'),
					'status_id' => array('type' => 'integer', 'null' => false, 'after' => 'role_id'),
					'allow_shift_status_id' => array('type' => 'integer', 'null' => false, 'after' => 'status_id'),
					'created' => array('type' => 'datetime', 'null' => true, 'after' => 'allow_shift_status_id'),
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
				'status_workflows'
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
		if ($direction == 'up') {
			// StatusWorkflowの初期データ登録
			// Modelクラスの取得
			$this->Status = ClassRegistry::init('Status');
			$this->StatusWorkflow = ClassRegistry::init('StatusWorkflow');

			// 全ステータスの取得
			$data = array();
			$statuses = $this->Status->find('all', array('order' => 'id'));
			for ($i = 0; $i < count($statuses); $i++) {
				for ($j = 0; $j < count($statuses); $j++) {
					// For Admin Role
					$data[] = array('role_id' => 1, 'status_id' => $statuses[$i]['Status']['id'], 'allow_shift_status_id' => $statuses[$j]['Status']['id']);
					// For User Role
					if ($statuses[$i]['Status']['id'] < 3 && $statuses[$j]['Status']['id'] < 3) {
						$data[] = array('role_id' => 2, 'status_id' => $statuses[$i]['Status']['id'], 'allow_shift_status_id' => $statuses[$j]['Status']['id']);
					}
				}
			}

			// データの保存
			$this->StatusWorkflow->saveAll($data);
		}
		return true;
	}
}
