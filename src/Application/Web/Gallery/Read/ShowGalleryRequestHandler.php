<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\CCOne\Application\Web\Gallery\Read;

use hollodotme\CCOne\Application\Responses\Page;
use hollodotme\CCOne\Traits\EnvInjecting;
use IceHawk\IceHawk\Interfaces\HandlesGetRequest;
use IceHawk\IceHawk\Interfaces\ProvidesReadRequestData;

/**
 * Class ShowGalleryRequestHandler
 * @package hollodotme\CCOne\Application\Web\Gallery\Read
 */
final class ShowGalleryRequestHandler implements HandlesGetRequest
{
	use EnvInjecting;

	public function handle( ProvidesReadRequestData $request ) : void
	{
		$data = [

		];

		(new Page( $this->getEnv() ))->respond( 'Gallery/Read/Pages/ShowGallery.twig', $data );
	}
}
