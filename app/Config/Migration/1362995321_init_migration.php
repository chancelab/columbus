<?php
class InitMigration extends CakeMigration {

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
				'acos' => array(
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
				),
				// アプリケーション(基本)設定
				'app_settings' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'title' => array('type' => 'string', 'length' => 255, 'null' => false),                             // アプリケーションタイトル
					'enable_smtp' => array('type' => 'boolean', 'null' => true, 'default' => false),                    // メール通知用に送信サーバー設定をするかどうか
					'smtp_from' => array('type' => 'text', 'null' => true, 'default' => NULL),                          // メール通知時のfromメールアドレス
					'smtp_host' => array('type' => 'string', 'length' => 255,  'null' => true, 'default' => NULL),      // 送信メールサーバーのホスト
					'smtp_port' => array('type' => 'integer', 'null' => true, 'default' => 465),                        // 送信メールサーバーのポート
					'smtp_username' => array('type' => 'string', 'length' => 255,  'null' => true, 'default' => NULL),  // 送信メールサーバーの認証ユーザー名
					'smtp_password' => array('type' => 'string', 'length' => 255,  'null' => true, 'default' => NULL),  // 送信メールサーバーの認証パスワード
					'allow_anonymous' => array('type' => 'boolean', 'null' => true, 'default' => false),                // 匿名ユーザーに閲覧を許可するか(true:許可 / false:拒否)
					'any_useradd' => array('type' => 'integer', 'null' => true, 'default' => 0),                        // 任意ユーザー登録設定(0:無効 / 1:任意登録可 / 2:メールアカウント確認制 / 3:管理者承認制)
					'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
					'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
					'indexes' => array(
									'PRIMARY' => array('column' => 'id', 'unique' => true),
					),
					'tableParameters' => array()
				),
				'aros' => array(
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
				),
				'aros_acos' => array(
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
				),
				// ファイルアップロード
				'attachments' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'model' => array('type' => 'string', 'length' => 11, 'null' => false),
					'foreign_key' => array('type' => 'integer', 'null' => false),
					'name' => array('type' => 'string', 'length' => 255, 'null' => false),
					'dir' => array('type' => 'string', 'length' => 255, 'default' => NULL),
					'type' => array('type' => 'string', 'length' => 255, 'default' => NULL),
					'size' => array('type' => 'integer', 'default' => 0),
					'active' => array('type' => 'integer', 'default' => 1),
					'indexes' => array(
									'PRIMARY' => array('column' => 'id', 'unique' => true),
					),
					'tableParameters' => array()
				),
				// アイデア追加入力
				'idea_add_inputs' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'idea_id' => array('type' => 'integer', 'null' => false),											// アイデアID
					'input_item_id' => array('type' => 'integer', 'null' => false),										// 入力アイテムID
					'body' => array('type' => 'text', 'null' => true, 'default' => NULL),								// 入力内容本文
					'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
					'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
					'indexes' => array(
									'PRIMARY' => array('column' => 'id', 'unique' => true),
					),
					'tableParameters' => array()
				),
				// アイデアに対する評価
				'idea_ratings' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'idea_id' => array('type' => 'integer', 'null' => false),											// アイデアID
					'user_id' => array('type' => 'integer', 'null' => true),											// ユーザーID
					'rating' => array('type' => 'integer', 'null' => false),											// 評価値(1〜3)
					'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
					'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
					'indexes' => array(
									'PRIMARY' => array('column' => 'id', 'unique' => true),
									'uix_idea_ratings' => array('column' => array('idea_id', 'user_id'), 'unique' => true),
					),
					'tableParameters' => array()
				),
				// アイデアのレスポンスに対する評価
				'idea_response_ratings' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'idea_response_id' => array('type' => 'integer', 'null' => false),									// アイデアレスポンスID
					'user_id' => array('type' => 'integer', 'null' => true),											// ユーザーID
					'rating' => array('type' => 'integer', 'null' => false),											// 評価値(1〜3)
					'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
					'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
					'indexes' => array(
									'PRIMARY' => array('column' => 'id', 'unique' => true),
									'uix_idea_response_ratings' => array('column' => array('idea_response_id', 'user_id'), 'unique' => true),
					),
					'tableParameters' => array()
				),
				// アイデアに対するレスポンス
				'idea_responses' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'idea_id' => array('type' => 'integer', 'null' => false),											// アイデアID
					'user_id' => array('type' => 'integer', 'null' => true),											// ユーザーID
					'body' => array('type' => 'text', 'null' => true, 'default' => NULL),								// 入力内容本文
					'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
					'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
					'indexes' => array(
									'PRIMARY' => array('column' => 'id', 'unique' => true),
					),
					'tableParameters' => array()
				),
				// アイデアについているタグ
				'idea_tags' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'idea_id' => array('type' => 'integer', 'null' => false),											// アイデアID
					'tag_id' => array('type' => 'integer', 'null' => true),												// タグID
					'user_id' => array('type' => 'integer', 'null' => true),											// タグをつけたユーザーID
					'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
					'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
					'indexes' => array(
									'PRIMARY' => array('column' => 'id', 'unique' => true),
									'uix_idea_tags' => array('column' => array('idea_id', 'tag_id'), 'unique' => true),
					),
					'tableParameters' => array()
				),
				'ideas' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'user_id' => array('type' => 'integer', 'null' => true),											// ユーザーID
					'status_id' => array('type' => 'integer', 'null' => false),											// ステータスID
					'title' => array('type' => 'string', 'length' => 255,  'null' => true, 'default' => NULL),			// タイトル
					'body' => array('type' => 'text', 'null' => true, 'default' => NULL),								// 本文
					'delete_flg' => array('type' => 'boolean', 'null' => true, 'default' => false),						// 削除フラグ (true: 生存データ, false: 削除データ)
					'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
					'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
					'indexes' => array(
									'PRIMARY' => array('column' => 'id', 'unique' => true),
					),
					'tableParameters' => array()
				),
				// 入力アイテムマスタ
				'input_items' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'name' => array('type' => 'string', 'length' => 255, 'null' => false),								// 項目名
					'type' => array('type' => 'integer', 'null' => false, 'default' => NULL),							// 入力タイプ(1:一行文字列、2:複数行文字列、3:択一選択肢、4:複数選択肢)
					'option' => array('type' => 'text', 'null' => true, 'default' => NULL),								// 入力タイプが選択肢の時に選択し内容をカンマ区切り等でいれる
					'comment' => array('type' => 'text', 'null' => true, 'default' => NULL),							// コメント
					'delete_flg' => array('type' => 'boolean', 'null' => true, 'default' => false),						// 削除フラグ (true: 生存データ, false: 削除データ)
					'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
					'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
					'indexes' => array(
									'PRIMARY' => array('column' => 'id', 'unique' => true),
					),
					'tableParameters' => array()
				),
				'roles' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
					'name' => array('type' => 'string', 'null' => false, 'length' => 100),
					'created' => array('type' => 'datetime', 'null' => true),
					'modified' => array('type' => 'datetime', 'null' => true),
					'indexes' => array(
						'PRIMARY' => array('unique' => true, 'column' => 'id'),
					),
					'tableParameters' => array(),
				),
				// ステータスマスタ
				'statuses' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'name' => array('type' => 'string', 'length' => 255,  'null' => true, 'default' => NULL),			// ステータス名
					'comment' => array('type' => 'text', 'null' => true, 'default' => NULL),							// コメント
					'order' => array('type' => 'integer', 'null' => true, 'default' => NULL),							// 表示順番
					'default' => array('type' => 'boolean', 'null' => true, 'default' => false),						// デフォルト値フラグ (true: デフォルトステータス, false: 非デフォルト値)
					'close_flg' => array('type' => 'boolean', 'null' => true, 'default' => false),						// 完了フラグ (true: 完了)
					'delete_flg' => array('type' => 'boolean', 'null' => true, 'default' => false),						// 削除フラグ (true: 生存データ, false: 削除データ)
					'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
					'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
					'indexes' => array(
									'PRIMARY' => array('column' => 'id', 'unique' => true),
					),
					'tableParameters' => array()
				),
				'tags' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'name' => array('type' => 'string', 'length' => 100,  'null' => true, 'default' => NULL),			// タグ名
					'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
					'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
					'indexes' => array(
									'PRIMARY' => array('column' => 'id', 'unique' => true),
									'uix_tags_name' => array('column' => 'name', 'unique' => true),
					),
					'tableParameters' => array()
				),
				'users' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'username' => array('type' => 'string', 'length' => 255, 'null' => false, 'default' => NULL),      // ログインID
					'password' => array('type' => 'string', 'length' => 40, 'null' => false, 'default' => NULL),       // パスワード
					'role_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),                       // ロールID
					'last_name' => array('type' => 'string', 'length' => 100, 'null' => false, 'default' => NULL),     // 姓名（姓）
					'first_name' => array('type' => 'string', 'length' => 100, 'null' => false, 'default' => NULL),    // 姓名（名）
					'email_address' => array('type' => 'text', 'null' => true, 'default' => NULL),                     // メールアドレス
					'comment' => array('type' => 'text', 'null' => true, 'default' => NULL),                           // コメント
					'appd_flg' => array('type' => 'boolean', 'null' => true, 'default' => true),                       // 承認フラグ (true: 承認データ, null: 承認待ちデータ, false:承認　拒否データ)
					'delete_flg' => array('type' => 'boolean', 'null' => true, 'default' => false),                    // 削除フラグ (true: 生存データ, false: 削除データ)
					'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
					'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
					'indexes' => array(
									'PRIMARY' => array('column' => 'id', 'unique' => true),
									'uid_users_username' => array('column' => 'username', 'unique' => true),
					),
					'tableParameters' => array()
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'acos', 'app_settings', 'aros', 'aros_acos', 'attachments', 'idea_add_inputs', 'idea_ratings', 'idea_response_ratings', 'idea_responses', 'idea_tags', 'ideas', 'input_items', 'roles', 'statuses', 'tags', 'users'
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
			if(!isset($this->InitialValues)){
				require_once(APP.'Config/Schema/initial_values.php');
				$this->InitialValues = new InitialValues();
			}

			foreach (array_keys($this->migration['up']['create_table']) as $tableName) {
				$modelname = Inflector::classify($tableName);
				$this->InitialValues->set($modelname);
			}
		}
		return true;
	}
}
