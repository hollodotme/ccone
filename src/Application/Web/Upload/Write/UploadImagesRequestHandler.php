<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\CCOne\Application\Web\Upload\Write;

use hollodotme\CCOne\Traits\EnvInjecting;
use IceHawk\IceHawk\Interfaces\HandlesPostRequest;
use IceHawk\IceHawk\Interfaces\ProvidesUploadedFileData;
use IceHawk\IceHawk\Interfaces\ProvidesWriteRequestData;
use Intervention\Image\ImageManager;

/**
 * Class UploadImagesRequestHandler
 * @package hollodotme\CCOne\Application\Web\Upload\Write
 */
final class UploadImagesRequestHandler implements HandlesPostRequest
{
	use EnvInjecting;

	public function handle( ProvidesWriteRequestData $request ) : void
	{
		$input = $request->getInput();
		$files = $input->getFiles( 'files' );

		$countSaved = 0;

		foreach ( $files as $file )
		{
			if ( !$file->didUploadSucceed() )
			{
				continue;
			}

			$fileName   = $this->getFileName( $file );
			$targetPath = dirname( __DIR__, 5 ) . '/public/media/' . $fileName;

			if ( !copy( $file->getTmpName(), $targetPath ) )
			{
				continue;
			}

			$this->createThumbnail( $file, $fileName );

			++$countSaved;
		}

		if ( $countSaved === 0 )
		{
			die( json_encode( [ 'success' => false, 'error' => 'Konnte Bilder nicht hochladen.' ] ) );
		}

		die( json_encode( [ 'success' => true, 'error' => '' ] ) );
	}

	private function getFileName( ProvidesUploadedFileData $file ) : string
	{
		$uuid = bin2hex( random_bytes( 16 ) );

		return strtolower( preg_replace( '#^.+\.(jpe?g|png|gif)$#i', "{$uuid}.$1", $file->getName() ) );
	}

	private function createThumbnail( ProvidesUploadedFileData $file, string $fileName ) : void
	{
		$image = (new ImageManager())
			->make( $file->getTmpName() )
			->widen(
				300,
				function ( $constraint )
				{
					$constraint->aspectRatio();
					$constraint->upsize();
				}
			)
			->heighten(
				300,
				function ( $constraint )
				{
					$constraint->aspectRatio();
					$constraint->upsize();
				}
			)
			->resizeCanvas( 300, 300, 'center', false, '#fff6ef' );

		$image->save( dirname( __DIR__, 5 ) . '/public/media/thumbs/' . $fileName );
	}
}
