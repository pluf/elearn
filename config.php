<?php 
return array(
	
	'general_domain' => 'eee.loc',
	'general_admin_email' => array('info@eee.loc'),
	
	'installed_apps' => array('Pluf','User','Group','Role','Tenant','CMS','Bank','Config','Setting','Spa','Calendar','Monitor','Message','Book','Backup','EEE'),
	
	'middleware_classes' => array(
        
        'Pluf_Middleware_Session',
        'Pluf_Middleware_Translation',
        
        'Seo_Middleware_Spa'
	),
	'debug' => true,
	
	'mimetypes_db' => SRC_BASE . '/etc/mime.types',
	'languages' => array( 'fa', 'en'),
	'tmp_folder' => SRC_BASE . '/var/tmp',
	'template_folders' => array(
	        SRC_BASE . '/templates',
	        PLUF_BASE . '/Seo/templates',
	),
	'template_tags' => array(
	        'SaaSConfig' => 'Template_Configuration',
	        'now' => 'Pluf_Template_Tag_Now',
	        'cfg' => 'Pluf_Template_Tag_Cfg',
	        'spaView' => 'Template_SapMainView'
	),
	'upload_path' => SRC_BASE . '/tenant',
	'time_zone' => 'Europe/Berlin',
	'encoding' => 'UTF-8',
	
	'secret_key' => '65979170321ba65ca52a8b9702166a96',
	'user_signup_active' => true,
	'user_avatar_default' => SRC_BASE . '/var/avatar.svg',
	'user_avatra_max_size' => 2097152,
	'auth_backends' => array(
	        'Pluf_Auth_ModelBackend'
	),
	'pluf_use_rowpermission' => true,
	'log_delayed' => true,
	'log_handler' => 'Pluf_Log_File',
	'log_level' => Pluf_Log::ERROR,
	'pluf_log_file' => SRC_BASE . '/var/logs/pluf.log',
	
	'db_engine' => 'MySQL',
	
		'db_version' => '5.5.33',
		'db_login' => 'root',
		'db_password' => '',
		'db_server' => 'localhost',
		'db_database' => 'eee',
		'db_table_prefix' => '',
	
	
	'mail_backend' => 'mail',
	
	 'bank_debug' => true,
	 'migrate_allow_web' => true,
);

