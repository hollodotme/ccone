<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\CCOne\Application\Web\Home\Read;

use hollodotme\CCOne\Application\Responses\Page;
use hollodotme\CCOne\Application\Responses\Redirect;
use hollodotme\CCOne\Traits\EnvInjecting;
use IceHawk\Forms\FormId;
use IceHawk\IceHawk\Interfaces\HandlesGetRequest;
use IceHawk\IceHawk\Interfaces\ProvidesReadRequestData;

/**
 * Class ShowLoginFormRequestHandler
 * @package hollodotme\CCOne\Application\Web\Home\Read
 */
final class ShowLoginFormRequestHandler implements HandlesGetRequest
{
	use EnvInjecting;

	public function handle( ProvidesReadRequestData $request ) : void
	{
		$session = $this->getEnv()->getSession();

		if ( $session->isAuthenticated() )
		{
			(new Redirect())->respond( '/' );

			return;
		}

		$data = [
			'loginForm' => $session->getForm( new FormId( 'loginForm' ) ),
		];

		(new Page( $this->getEnv() ))->respond( 'Home/Read/Pages/ShowLoginForm.twig', $data );
	}
}
