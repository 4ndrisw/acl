<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['acl_table_users'] = 'staff';
$config['acl_users_fields'] = 'staffid';
$config['acl_table_access'] = 'access';
$config['acl_table_member_access'] = 'member_access';

$config['acl_user_session_key'] = 'staffid';

$config['acl_restricted'] = array(

	'controller/method' => array(
		'allow_members' => array(1),
		'allow_users' => array(1),
		'error_msg' => 'You do not have access to visit this page!'
	),

	'welcome/*' => array(
		'allow_members' => array(1),
		'allow_users' => array(1),
		'error_msg' => 'You do not have access to visit this page!'
	)

);