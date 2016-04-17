<?php
//Version
define('SG_VERSION', '1.1.1');

//Paths
define('SG_APP_PATH', realpath(dirname(__FILE__).'/../').'/');
define('SG_CONFIG_PATH', SG_APP_PATH.'config/');
define('SG_CORE_PATH', SG_APP_PATH.'core/');
define('SG_DATABASE_PATH', SG_CORE_PATH.'database/');
define('SG_LOG_PATH', SG_CORE_PATH.'log/');
define('SG_STORAGE_PATH', SG_CORE_PATH.'storage/');
define('SG_EXCEPTION_PATH', SG_CORE_PATH.'exception/');
define('SG_BACKUP_PATH', SG_CORE_PATH.'backup/');
define('SG_LIB_PATH', SG_APP_PATH.'lib/');
define('SG_MAIL_PATH', SG_CORE_PATH.'mail/');
define('SG_SCHEDULE_PATH', SG_CORE_PATH.'schedule/');

//Log
define('SG_LOG_LEVEL_ALL', 0);
define('SG_LOG_LEVEL_HIGH', 1);
define('SG_LOG_LEVEL_MEDIUM', 2);
define('SG_LOG_LEVEL_LOW', 4);
define('SG_BACKUP_LOG_POS_START', 1);
define('SG_BACKUP_LOG_POS_END', 2);

define('SG_DB_PREFIX_REPLACEMENT', '%%sg_db_prefix%%');

//Backup timeout in seconds
define('SG_BACKUP_TIMEOUT', 180);

//Ping data update frequency
define('SG_PING_DATE_UPDATE_FREQUENCY', 3);

//Backup file extension
define('SGBP_EXT', 'sgbp');

define('SG_NOTICE_EXECUTION_TIMEOUT', 'timeoutError');

define('SG_WORDPRESS_CORE_TABLE', SG_ENV_DB_PREFIX.'options');
define('SG_MAGENTO_CORE_TABLE', SG_ENV_DB_PREFIX.'core_config_data');

//Backup
define('SG_ACTION_STATUS_CREATED', 0);
define('SG_ACTION_STATUS_IN_PROGRESS_DB', 1);
define('SG_ACTION_STATUS_IN_PROGRESS_FILES', 2);
define('SG_ACTION_STATUS_FINISHED', 3);
define('SG_ACTION_STATUS_FINISHED_WARNINGS', 4);
define('SG_ACTION_STATUS_CANCELLING', 5);
define('SG_ACTION_STATUS_CANCELLED', 6);
define('SG_ACTION_STATUS_ERROR', 7);
define('SG_ACTION_TYPE_BACKUP', 1);
define('SG_ACTION_TYPE_RESTORE', 2);
define('SG_ACTION_TYPE_UPLOAD', 3);
define('SG_ACTION_PROGRESS_UPDATE_INTERVAL', 3); //in %
define('SG_BACKUP_DATABASE_INSERT_LIMIT', 10000);
define('SG_BACKUP_DOWNLOAD_TYPE_SGBP', 1);
define('SG_BACKUP_DOWNLOAD_TYPE_BACKUP_LOG', 2);
define('SG_BACKUP_DOWNLOAD_TYPE_RESTORE_LOG', 3);

//The following constants can be modified at run-time
define('SG_ACTION_BACKUP_FILES_AVAILABLE', 1);
define('SG_ACTION_BACKUP_DATABASE_AVAILABLE', 1);
define('SG_BACKUP_IN_BACKGROUND_MODE', 0);
define('SG_BACKUP_UPLOAD_TO_STORAGES', ''); //list of storage ids separated by commas

//Database tables
define('SG_ACTION_TABLE_NAME', SG_ENV_DB_PREFIX.'sg_action');
define('SG_CONFIG_TABLE_NAME', SG_ENV_DB_PREFIX.'sg_config');
