<?php

return [
	'' => [
		'controller' => 'task',
		'action' => 'index',
	],
	'page/{page:\d+}' => [
		'controller' => 'task',
		'action' => 'index',
	],
	'task/{id:\d+}' => [
		'controller' => 'task',
		'action' => 'read'
	],
	'add' => [
		'controller' => 'task',
		'action' => 'add',
	],
	'sort' => [
		'controller' => 'task',
		'action' => 'sort',
	],
	'admin/login' => [
		'controller' => 'admin',
		'action' => 'login',
	],
	'admin/logout' => [
		'controller' => 'admin',
		'action' => 'logout',
	],
	'edit/{id:\d+}' => [
		'controller' => 'task',
		'action' => 'edit',
	]
];