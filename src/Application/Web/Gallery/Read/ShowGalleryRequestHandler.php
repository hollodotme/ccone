<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\CCOne\Application\Web\Gallery\Read;

use hollodotme\CCOne\Application\Responses\Page;
use hollodotme\CCOne\Application\Traits\AuthChecking;
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
	use AuthChecking;

	public function handle( ProvidesReadRequestData $request ) : void
	{
		$this->checkAuth( $this->getEnv()->getSession() );

		$data = [
			'thumbs' => $this->getThumbnails(),
		];

		(new Page( $this->getEnv() ))->respond( 'Gallery/Read/Pages/ShowGallery.twig', $data );
	}

	private function getThumbnails() : array
	{
		$iterator = new \DirectoryIterator( dirname( __DIR__, 5 ) . '/public/media/thumbs' );
		$thumbs   = [];
		foreach ( $iterator as $item )
		{
			if ( !preg_match( '#\.(jpe?g|gif|png)$#', $item->getFilename() ) )
			{
				continue;
			}

			$fileName = $item->getFilename();

			$thumbs["/media/thumbs/{$fileName}"] = "/media/{$fileName}";
		}

		return $thumbs;
	}
}
