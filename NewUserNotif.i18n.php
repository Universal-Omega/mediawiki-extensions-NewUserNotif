<?php

/**
 * Internationalisation file for the New User Email Notification extension
 *
 * @addtogroup Extensions
 * @author Rob Church <robchur@gmail.com>
 */

function efNewUserNotifMessages() {
	$messages = array(
	
'en' => array(
	'newusernotifsubj' => 'New User Notification for $1',
	'newusernotifbody' => "Hello $1,\n\nA new user account, $2, has been created on $3 at $4.",
),

'ar' => array(
'newusernotifsubj' => 'إخطار مستخدم جديد ل$1',
'newusernotifbody' => 'مرحبا يا $1،

حساب مستخدم جديد، $2، تم إنشاؤه على $3 في $4.',
),

'de' => array(
	'newusernotifsubj' => 'Benachrichtung für $1 über die Einrichtung eines neuen Benutzerskontos',
	'newusernotifbody' => "Hallo $1,\n\nEin neues Benutzerkonto, $2, wurde am $4 auf $3 angelegt.",
),

'fr' => array(
	'newusernotifsubj' => 'Notification d’un nouvel utilisateur pour $1',
	'newusernotifbody' => "Bonjour $1,\n\nUn nouveau compte utilisateur, $2, a été créé sur $3 le $4.",
),

'hsb' => array(
'newusernotifsubj' => 'Zdźělenka za noweho wužiwarja $1',
'newusernotifbody' => 'Witaj $1,

Nowe wužiwarske konto, $2, bu dnja $4 na $3 wutworjene.',
),

'hy' => array(
'newusernotifsubj' => 'Նոր Մասնակցի Տեղեկացում $1 մասնակցի համար',
'newusernotifbody' => 'Ողջո՜ւյն, $1։

$3 կայքում ստեղծվել է նոր մասնակցային հաշիվ՝ $2, $4-ին։',
),

'nl' => array(
	'newusernotifsubj' => 'Notificatie nieuwe gebruiker voor  $1',
	'newusernotifbody' => "Hallo $1.\n\nEr is een nieuwe gebruiker $2 aangemaakt om $3 op $4.",
),

'no' => array(
'newusernotifsubj' => 'Beskjed om ny bruker for $1',
'newusernotifbody' => 'Hei, $1. En ny brukerkonto, $2, ble opprettet på $3 $4.',
),

'pl' => array(
'newusernotifsubj' => 'Powiadamianie użytkownika $1 o nowych użytkownikach',
),

'pms' => array(
'newusernotifsubj' => 'Notìfica d\'utent neuv për $1',
'newusernotifbody' => 'Bondì $1, un neuv utent, $2, a l\'é stait creà ansima a $3 dël $4.',
),

'tet' => array(
'newusernotifsubj' => 'Mensajen kona-ba uza-na\'in foun ba $1',
'newusernotifbody' => 'Olá $1,\n\nuza-na\'in foun, $2, registrar tiha iha $3 iha loron $4.',
),

'yue' => array(
	'newusernotifsubj' => '$1嘅新用戶通知',
	'newusernotifbody' => "你好 $1，\n\n一個新嘅用戶戶口$2，已經響$4喺$3度開咗。",
),

'zh-hans' => array(
	'newusernotifsubj' => '$1的新用户通知',
	'newusernotifbody' => "你好 $1，\n\n一个新的用户账号$2，已经在$4于$3创建。",
),

'zh-hant' => array(
	'newusernotifsubj' => '$1的新用戶通知',
	'newusernotifbody' => "你好 $1，\n\n一個新的用戶帳號$2，已經在$4於$3創建。",
),
	
	);

	/* Chinese defaults, fallback to zh-hans or zh-hant */
	$messages['zh'] = $messages['zh-hans'];
	$messages['zh-cn'] = $messages['zh-hans'];
	$messages['zh-hk'] = $messages['zh-hant'];
	$messages['zh-sg'] = $messages['zh-hans'];
	$messages['zh-tw'] = $messages['zh-hant'];
	/* Cantonese default, fallback to yue */
	$messages['zh-yue'] = $messages['yue'];

	return $messages;
}
