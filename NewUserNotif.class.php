<?php

/**
 * Extension to provide customisable email notification of new user creation
 *
 * @file
 * @ingroup Extensions
 * @author Rob Church <robchur@gmail.com>
 */

class NewUserNotifier {
	private $sender;
	private $user;

	public function __construct() {
		global $wgNewUserNotifSender;
		$this->sender = $wgNewUserNotifSender;
	}

	/**
	 * Send all email notifications
	 *
	 * @param User $user User that was created
	 */
	public function execute( $user ) {
		$this->user = $user;
		$this->sendExternalMails();
		$this->sendInternalMails();
	}

	/**
	 * Send email to external addresses
	 */
	private function sendExternalMails() {
		global $wgNewUserNotifEmailTargets, $wgSitename;

		foreach( $wgNewUserNotifEmailTargets as $target ) {
			UserMailer::send(
				new MailAddress( $target ),
				new MailAddress( $this->sender ),
				$this->makeSubject( $target, $this->user ),
				$this->makeMessage( $target, $this->user )
			);
		}
	}

	/**
	 * Send email to users
	 */
	private function sendInternalMails() {
		global $wgNewUserNotifTargets, $wgSitename;

		foreach( $wgNewUserNotifTargets as $userSpec ) {
			$user = $this->makeUser( $userSpec );

			if( $user instanceof User && $user->isEmailConfirmed() ) {
				$user->sendMail(
					$this->makeSubject( $user->getName(), $this->user ),
					$this->makeMessage( $user->getName(), $this->user ),
					$this->sender
				);
			}
		}
	}

	/**
	 * Initialise a user from an identifier or a username
	 *
	 * @param mixed $spec User identifier or name
	 * @return User
	 */
	private function makeUser( $spec ) {
		$name = is_integer( $spec ) ? User::whoIs( $spec ) : $spec;
		$user = User::newFromName( $name );

		if( $user instanceof User && $user->getId() > 0 ) {
			return $user;
		}

		return null;
	}

	/**
	 * Build a notification email subject line
	 *
	 * @param string $recipient Name of the recipient
	 * @param User $user User that was created
	 */
	private function makeSubject( $recipient, $user ) {
		global $wgSitename;
		$subjectLine = '';

		// Avoid PHP 7.1 warning of passing $this by reference
		$userNotif = $this;
		Hooks::run( 'NewUserNotifSubject', [ &$userNotif, &$subjectLine, $wgSitename, $recipient, $user ] );

		if ( !strlen( $subjectLine ) ) {
			return wfMessage( 'newusernotifsubj', $wgSitename )->inContentLanguage()->text();
		}

		return $subjectLine;
	}

	/**
	 * Build a notification email message body
	 *
	 * @param string $recipient Name of the recipient
	 * @param User $user User that was created
	 */
	private function makeMessage( $recipient, $user ) {
		global $wgSitename, $wgContLang;
		$messageBody = '';

		// Avoid PHP 7.1 warning of passing $this by reference
		$userNotif = $this;
		Hooks::run( 'NewUserNotifBody', [ &$userNotif, &$messageBody, $wgSitename, $recipient, $user ] );

		if ( !strlen( $messageBody ) )
			return wfMessage(
				'newusernotifbody',
				$recipient,
				$user->getName(),
				$wgSitename,
				$wgContLang->timeAndDate( wfTimestampNow() ),
				$wgContLang->date( wfTimestampNow() ),
				$wgContLang->time( wfTimestampNow() )
			)->inContentLanguage()->text();

		return $messageBody;
	}

	public static function onRegistration() {
		global $wgNewUserNotifSender, $wgNewUserNotifTargets, $wgNewUserNotifEmailTargets, $wgPasswordSender;

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
	}

	/**
	 * Hook account creation
	 *
	 * @param User $user User that was created
	 * @return bool
	 */
	public static function onLocalUserCreated( $user ) {
		$notifier = new self();
		$notifier->execute( $user );

		return true;
	}
}
