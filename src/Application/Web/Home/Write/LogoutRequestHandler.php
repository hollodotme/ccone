<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\CCOne\Application\Web\Home\Write;

use hollodotme\CCOne\Application\Responses\Redirect;
use hollodotme\CCOne\Application\Traits\AuthChecking;
use hollodotme\CCOne\Traits\EnvInjecting;
use IceHawk\IceHawk\Interfaces\HandlesPostRequest;
use IceHawk\IceHawk\Interfaces\ProvidesWriteRequestData;

/**
 * Class LogoutRequestHandler
 * @package hollodotme\CCOne\Application\Web\Home\Write
 */
final class LogoutRequestHandler implements HandlesPostRequest
{
	use EnvInjecting;
	use AuthChecking;

	public function handle( ProvidesWriteRequestData $request )
	{
		$session = $this->getEnv()->getSession();
		$this->checkAuth( $session );

		$session->setUnauthenticated();

		(new Redirect())->respond( '/login' );
	}
}
