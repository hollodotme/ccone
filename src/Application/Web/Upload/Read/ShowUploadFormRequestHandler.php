<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\CCOne\Application\Web\Upload\Read;

use hollodotme\CCOne\Application\Responses\Page;
use hollodotme\CCOne\Application\Traits\AuthChecking;
use hollodotme\CCOne\Traits\EnvInjecting;
use IceHawk\IceHawk\Interfaces\HandlesGetRequest;
use IceHawk\IceHawk\Interfaces\ProvidesReadRequestData;

/**
 * Class ShowUploadFormRequestHandler
 * @package hollodotme\CCOne\Application\Web\Upload\Read
 */
final class ShowUploadFormRequestHandler implements HandlesGetRequest
{
	use EnvInjecting;
	use AuthChecking;

	public function handle( ProvidesReadRequestData $request ) : void
	{
		$this->checkAuth( $this->getEnv()->getSession() );

		$data = [

		];

		(new Page( $this->getEnv() ))->respond( 'Upload/Read/Pages/ShowUploadForm.twig', $data );
	}
}
