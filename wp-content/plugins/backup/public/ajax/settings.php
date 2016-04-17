<?php
require_once(dirname(__FILE__).'/../boot.php');
$error = array();
$success = array('success'=>1);

if(isAjax() && isset($_POST['cancel']))
{
    SGConfig::set('SG_NOTIFICATIONS_ENABLED', '0');
    SGConfig::set('SG_NOTIFICATIONS_EMAIL_ADDRESS', '');
    SGConfig::set('SG_DELETE_BACKUP_AFTER_UPLOAD', '0');
    die(json_encode($success));
}

if(isAjax() && count($_POST))
{
    SGConfig::set('SG_NOTIFICATIONS_ENABLED', '0');
    if(isset($_POST['sgIsEmailNotification']))
    {
        $email = '';
        $email = @$_POST['sgUserEmail'];
        if (empty($email)) {
            array_push($error, _t('Email is required.', true));
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($error, _t('Invalid email address.', true));
        }

        SGConfig::set('SG_NOTIFICATIONS_ENABLED', '1');
    }
    $ajaxInterval = (int)$_POST['ajaxInterval'];

    if(count($error))
    {
        die(json_decode($error));
    }

    SGConfig::set('SG_SEND_ANONYMOUS_STATISTICS', '0');
    if(isset($_POST['sgAnonymousStatistics']))
    {
        SGConfig::set('SG_SEND_ANONYMOUS_STATISTICS', '1');
    }

    SGConfig::set('SG_DELETE_BACKUP_AFTER_UPLOAD', '0');
    if (isset($_POST['delete-backup-after-upload'])) {
        SGConfig::set('SG_DELETE_BACKUP_AFTER_UPLOAD', '1');
    }

    SGConfig::set('SG_AJAX_REQUEST_FREQUENCY', $ajaxInterval);
    SGConfig::set('SG_NOTIFICATIONS_EMAIL_ADDRESS', $email);
    die(json_encode($success));
}
