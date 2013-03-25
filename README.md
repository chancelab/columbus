Columbus - ChanceLab Idea Manager
======================
It is CMS which the [ChanceLab. Corp.](http://www.chancelab.jp/)  developed using [CakePHP2.x](http://cakephp.org/). 

Browser Enabled
--------
Internet Explorer 9+  
Google Chrome 24+   
FireFox 17+  
Safari 5+  

Demo Site
----------
[Demo1 - Idea Manager(User Role)](http://columbus1.chanceapp.net/ "Demo1 - Idea Manager(User)")    
User ID(PW): user01(user01), user02(user02), user03(user03)  

[Demo2 - Idea Manager(Admin Role)](http://columbus2.chanceapp.net/ "Demo2 - Idea Manager(Admin)")   
Administrator ID(PW): admin(admin)  
User ID(PW): user(user)

How To Install
------
### 1. Download columbus. ###
	$ git clone git://github.com/chancelab/columbus.git

### 2. Get submodule ###
	$ git submodule update --init
 
### 3. DataBase Setting ###
Postgresql Sample  
```php

class DATABASE_CONFIG {
	public $default = array(
		'datasource' => 'Database/Postgres',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'columbus',
		'password' => 'columbus',
		'database' => 'columbus'
	);

```

Mysql Sample   
```php

class DATABASE_CONFIG {
	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'columbus',
		'password' => 'columbus',
		'unix_socket' => '/tmp/mysql.sock',
		'database' => 'columbus',
		'prefix' => ''
	);

```

### 4. CakePHP 2.x Setting
Plz Read CakePHP Document an Setting.  
[CakePHP 2.x Book](http://book.cakephp.org/2.0/en/installation.html)

plz, exec command.  

	$ cd columbus/app 
	$ chmod -R 777 tmp
	$ Console/cake Migrations.migration run all -p  

### After Install, ACL Plugin Database Synchronize and permission setting.
1. action sync is "http://servername/admin/acl/acos/synchronize/run" to execute.
2. role permission is "http://servername/admin/acl/aros/ajax_role_permissions" to setting.

### Init Access, Account
ID: admin
PW: admin

 
Use Plugin
--------
1. [Plugin for CakePHP2 Bootstrap](https://github.com/slywalker/TwitterBootstrap "Plugin for CakePHP2 Bootstrap")  
2. [bootstrap](http://twitter.github.com/bootstrap/ "bootstrap")  
3. [ACL Plugin for CakePHP 2.0](http://www.alaxos.ch/blaxos/pages/view/plugin_acl_2.0 "ACL Plugin for CakePHP 2.0")  
4. [Search](https://github.com/CakeDC/search "Search")  
5. [Migrations](https://github.com/CakeDC/migrations "Migrations")   
6. [DebugKit](https://github.com/cakephp/debug_kit "DebugKit")  
7. [Upload Plugin](https://github.com/josegonzalez/upload "Upload Plugin")

TODO
--------
### WebAPIs ###
Contents CRUD  
Comments CRUD  

### Functions ###
Custom Thema, and Custom Thema Plugin.
Original PlugIn Installer  

UPDATED
---------
22/03/2013 Version 0.1.0 Released.  

 
Licence
----------
Copyright &copy; 2013 [ChanceLab. Corp.](http://www.chancelab.jp/)   
Licensed under the [Apache License, Version 2.0][Apache]
Distributed under the [MIT License][mit].   
Dual licensed under the [MIT license][MIT] and [GPL license][GPL].
 
[Apache]: http://www.apache.org/licenses/LICENSE-2.0
[MIT]: http://www.opensource.org/licenses/mit-license.php
[GPL]: http://www.gnu.org/licenses/gpl.html

