<?php
    require_once(dirname(__FILE__) . '/../boot.php');
    require_once(SG_BACKUP_PATH . 'SGBackup.php');

    try {
        $success = array('success' => 1);
        if (isAjax() && count($_POST)) {
            $options = $_POST;
            $error = array();
            setManualBackupOptions($options);
        }
        else {
            $options = json_decode(SGConfig::get('SG_ACTIVE_BACKUP_OPTIONS'), true);
            setManualBackupOptions($options);
        }

        $b = new SGBackup();
        $b->backup();

        die(json_encode($success));

    }
    catch (SGException $exception)
    {
        array_push($error, $exception->getMessage());
        die(json_encode($error));
    }

    function setManualBackupOptions($options)
    {
        $activeOptions = array('backupDatabase' => 0, 'backupFiles' => 0, 'ftp' => 0, 'gdrive' => 0, 'dropbox' => 0, 'amazon' => 0, 'background' => 0);

        //If background mode
        $isBackgroundMode = !empty($options['backgroundMode']) ? 1 : 0;
        SGConfig::set('SG_BACKUP_IN_BACKGROUND_MODE', $isBackgroundMode, false);
        $activeOptions['background'] = $isBackgroundMode;

        //If cloud backup
        if (!empty($options['backupCloud']) && count($options['backupStorages'])) {
            $clouds = $activeOptions['backupStorages'] = $options['backupStorages'];

            SGConfig::set('SG_BACKUP_UPLOAD_TO_STORAGES', implode(',', $clouds), false);

            $activeOptions['backupCloud'] = $options['backupCloud'];
            $activeOptions['gdrive'] = in_array(SG_STORAGE_GOOGLE_DRIVE, $options['backupStorages']) ? 1 : 0;
            $activeOptions['ftp'] = in_array(SG_STORAGE_FTP, $options['backupStorages']) ? 1 : 0;
            $activeOptions['dropbox'] = in_array(SG_STORAGE_DROPBOX, $options['backupStorages']) ? 1 : 0;
            $activeOptions['amazon'] = in_array(SG_STORAGE_AMAZON, $options['backupStorages']) ? 1 : 0;
        }

        $activeOptions['backupType'] = $options['backupType'];
        if ($options['backupType'] == SG_BACKUP_TYPE_FULL) {
            SGConfig::set('SG_ACTION_BACKUP_DATABASE_AVAILABLE', 1, false);
            SGConfig::set('SG_ACTION_BACKUP_FILES_AVAILABLE', 1, false);
            $activeOptions['backupDatabase'] = 1;
            $activeOptions['backupFiles'] = 1;
        }
        else if ($options['backupType'] == SG_BACKUP_TYPE_CUSTOM) {
            //If database backup
            $isDatabaseBackup = !empty($options['backupDatabase']) ? 1 : 0;
            SGConfig::set('SG_ACTION_BACKUP_DATABASE_AVAILABLE', $isDatabaseBackup, false);
            $activeOptions['backupDatabase'] = $isDatabaseBackup;

            //If files backup
            if (!empty($options['backupFiles']) && count($options['directory'])) {
                $directories = $options['directory'];
                SGConfig::set('SG_ACTION_BACKUP_FILES_AVAILABLE', 1, false);
                SGConfig::set('SG_BACKUP_FILE_PATHS', implode(',', $directories), false);
                $activeOptions['backupFiles'] = 1;
                $activeOptions['directory'] = implode(',', $directories);
            }
            else {
                SGConfig::set('SG_ACTION_BACKUP_FILES_AVAILABLE', 0, false);
                SGConfig::set('SG_BACKUP_FILE_PATHS', 0, false);
            }
        }
        SGConfig::set('SG_ACTIVE_BACKUP_OPTIONS', json_encode($activeOptions));
    }
