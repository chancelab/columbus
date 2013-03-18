<?php
// アプリケーション独自の定数

/** 管理者の権限テーブルのID */
define('ADMIN_ROLE_INDEX', 1);

/** 一般ユーザーの権限テーブルのID */
define('USER_ROLE_INDEX', 2);

/** 追加入力項目タイプ（１行文字列） */
define('INPUT_TYPE_STRING', 1);

/** 追加入力項目タイプ（複数行文字列） */
define('INPUT_TYPE_TEXT', 2);

/** 追加入力項目タイプ（ファイル） */
define('INPUT_TYPE_FILES', 3);

/** 新着判定時間 */
define('NEW_THRESHOLD_HOUR', 72);

/** 任意ユーザー登録設定(無効) */
define('ANY_USERADD_DISABLE', 0);

/** 任意ユーザー登録設定(任意登録化) */
define('ANY_USERADD_ENABLE', 1);

/** 任意ユーザー登録設定(メールアカウント確認制) */
define('ANY_USERADD_EMAIL', 2);

/** 任意ユーザー登録設定(管理者承認制) */
define('ANY_USERADD_ADMIN', 3);

/** Cookieのキー名(アイデア一覧のデフォルト表示) */
define('COOKIE_KEY_DEFAULT_VIEW', 'DEFAULT_VIEW_HOME');

/** Cookieの値(アイデア一覧のリスト表示) */
define('COOKIE_VALUE_VIEW_LIST', '1');

/** Cookieの値(アイデア一覧のボード表示) */
define('COOKIE_VALUE_VIEW_BOARD', '2');

/** jsonのキー名 */
define('JSON_KEY_RESULT', 'result');

/** jsonキー'JSON_KEY_RESULT'の値(成功) */
define('JSON_VALUE_RESULT_SUCCESS', 'success');

/** jsonキー'JSON_KEY_RESULT'の値(失敗) */
define('JSON_VALUE_RESULT_FAILED', 'failed');
