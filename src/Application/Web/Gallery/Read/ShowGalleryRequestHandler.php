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
			'thumbs' => $this->getThumbnails(),
		];

		(new Page( $this->getEnv() ))->respond( 'Gallery/Read/Pages/ShowGallery.twig', $data );
	}

	private function getThumbnails() : \Generator
	{
		$iterator = new \DirectoryIterator( dirname( __DIR__, 5 ) . '/public/media/thumbs' );

		foreach ( $iterator as $item )
		{
			if ( !preg_match( '#\.(jpe?g|gif|png)$#', $item->getFilename() ) )
			{
				continue;
			}

			yield "/media/thumbs/{$item->getFilename()}" => "/media/{$item->getFilename()}";
		}
	}
}
