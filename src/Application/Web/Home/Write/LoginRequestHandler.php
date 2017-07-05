<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\CCOne\Application\Web\Home\Write;

use hollodotme\CCOne\Application\Responses\Redirect;
use hollodotme\CCOne\Traits\EnvInjecting;
use IceHawk\Forms\Feedback;
use IceHawk\Forms\FormId;
use IceHawk\IceHawk\Interfaces\HandlesPostRequest;
use IceHawk\IceHawk\Interfaces\ProvidesWriteRequestData;

/**
 * Class LoginRequestHandler
 * @package hollodotme\CCOne\Application\Web\Home\Write
 */
final class LoginRequestHandler implements HandlesPostRequest
{
	use EnvInjecting;

	public function handle( ProvidesWriteRequestData $request ) : void
	{
		$input   = $request->getInput();
		$config  = require __DIR__ . '/../../../../../config/auth.php';
		$session = $this->getEnv()->getSession();
		$form    = $session->getForm( new FormId( 'loginForm' ) );

		$form->resetFeedbacks();

		if ( $input->get( 'username' ) !== $config['username'] || $input->get( 'password' ) !== $config['password'] )
		{
			$form->addFeedback( 'login', new Feedback( 'Benutzer oder Passwort nicht korrekt.' ) );

			(new Redirect())->respond( '/login' );

			return;
		}

		$session->setAuthenticated();

		(new Redirect())->respond( '/' );
	}
}
