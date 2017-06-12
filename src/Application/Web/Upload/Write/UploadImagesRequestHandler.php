<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\CCOne\Application\Web\Upload\Write;

use hollodotme\CCOne\Traits\EnvInjecting;
use IceHawk\IceHawk\Interfaces\HandlesPostRequest;
use IceHawk\IceHawk\Interfaces\ProvidesWriteRequestData;

/**
 * Class UploadImagesRequestHandler
 * @package hollodotme\CCOne\Application\Web\Upload\Write
 */
final class UploadImagesRequestHandler implements HandlesPostRequest
{
	use EnvInjecting;

	public function handle( ProvidesWriteRequestData $request ) : void
	{
		// TODO: Implement handle() method.
	}
}
