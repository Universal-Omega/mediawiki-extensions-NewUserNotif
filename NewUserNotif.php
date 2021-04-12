<?php
if ( ! defined( 'MEDIAWIKI' ) ) {
    die();
}

/**
 * Extension to provide customisable email notification of new user creation
 *
 * @file
 * @author Rob Church <robchur@gmail.com>
 * @ingroup Extensions
 * @copyright © 2006 Rob Church
 * @license GNU General Public Licence 2.0 or later
 */

$wgExtensionCredits['other'][] = [
	'path' => __FILE__,
	'name'           => 'New User Email Notification',
	'version'        => '1.6.0',
	'author'         => 'Rob Church',
	'url'            => 'https://www.mediawiki.org/wiki/Extension:New_User_Email_Notification',
	'descriptionmsg' => 'newusernotif-desc',
];

$dir = dirname(__FILE__) . '/';
$wgMessagesDirs['NewUserNotif'] = __DIR__ . '/i18n';
$wgAutoloadClasses['NewUserNotifier'] = $dir . 'NewUserNotif.class.php';

$wgHooks['LocalUserCreated'][] = 'NewUserNotifier::onLocalUserCreated';

/**
 * Email address to use as the sender
 */
$wgNewUserNotifSender = $wgPasswordSender;

/**
 * Users who should receive notification mails
 */
$wgNewUserNotifTargets[] = 1;

/**
 * Additional email addresses to send mails to
 */
$wgNewUserNotifEmailTargets = [];
