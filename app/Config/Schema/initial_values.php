<?php
App::uses('ClassRegistry', 'Utility');
/**
 * schema作成時の初期データ登録クラス
 * @author MasayukiEda
 */
class InitialValues extends Object {

	// 各モデルの初期値
	// !! CAUTION !! あらかじめModel配下に対応するModelが作成済である必要があります
	var $values = array(
		'AppSetting' => array(array(
			'title' => '<span class="brandMain">Columbus </span>-<span class="brandSub"> ChanceLab\'s Idea Manager</span>',
		)),
		'Role' => array(
			array('name' => 'Administrators'),    // システム全体のスーパーユーザー
			array('name' => 'Users'),             // 一般ユーザー
		),
		'Status' => array(
			array('name' => 'たまご', 'comment' => '※揉んで欲しいアイデアはココにいれましょう', 'default' => true, 'order' => 1),
			array('name' => 'アイデア', 'order' => 2),
			array('name' => '採用', 'order' => 3),
			array('name' => 'ボツ', 'order' => 4, 'close_flg' => true),
		),
		'User' => array(
			array('username' => 'admin', 'password' => 'admin','tmp_password' => 'admin', 'role_id' => 1, 'last_name' => 'システム', 'first_name' => '管理者', 'email_address' => ''),
		),
		'Tag' => array(
			array('name' => 'Columbus'),
			array('name' => 'Web向け'),
			array('name' => 'スマホ向け'),
			array('name' => 'ビジネス'),
			array('name' => 'エンタメ'),
		),
	);

	// 初期化処理
	function startup($schema = null){
		if($schema === null){
			return false;
		}
	}

	// セット関数
	function set($modelname){
		if(!empty($this->values[$modelname])){
		    echo $modelname . "に初期データを投入します...\n";
			$this->{$modelname} = ClassRegistry::init($modelname);
		    $this->{$modelname}->saveAll($this->values[$modelname]);
		}
	}
}
