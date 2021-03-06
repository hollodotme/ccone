<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\CCOne\Application\Web\Home\Read;

use hollodotme\CCOne\Application\Responses\Page;
use hollodotme\CCOne\Application\Traits\AuthChecking;
use hollodotme\CCOne\Traits\EnvInjecting;
use IceHawk\IceHawk\Interfaces\HandlesGetRequest;
use IceHawk\IceHawk\Interfaces\ProvidesReadRequestData;

/**
 * Class ShowHomeRequestHandler
 * @package hollodotme\CCOne\Application\Web\Home\Read
 */
final class ShowHomeRequestHandler implements HandlesGetRequest
{
	use EnvInjecting;
	use AuthChecking;

	public function handle( ProvidesReadRequestData $request ) : void
	{
		$this->checkAuth( $this->getEnv()->getSession() );

		$data = [

		];

		(new Page( $this->getEnv() ))->respond( 'Home/Read/Pages/ShowHome.twig', $data );
	}
}
