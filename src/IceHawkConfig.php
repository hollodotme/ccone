<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\CCOne;

use hollodotme\CCOne\Application\FinalResponders\FinalReadResponder;
use hollodotme\CCOne\Application\FinalResponders\FinalWriteResponder;
use hollodotme\CCOne\Application\Web\Gallery\Read\ShowGalleryRequestHandler;
use hollodotme\CCOne\Application\Web\Home\Read\ShowHomeRequestHandler;
use hollodotme\CCOne\Application\Web\Upload\Read\ShowUploadFormRequestHandler;
use hollodotme\CCOne\Application\Web\Upload\Write\UploadImagesRequestHandler;
use hollodotme\CCOne\Traits\EnvInjecting;
use IceHawk\IceHawk\Defaults\Traits\DefaultCookieProviding;
use IceHawk\IceHawk\Defaults\Traits\DefaultEventSubscribing;
use IceHawk\IceHawk\Defaults\Traits\DefaultRequestBypassing;
use IceHawk\IceHawk\Defaults\Traits\DefaultRequestInfoProviding;
use IceHawk\IceHawk\Interfaces\ConfiguresIceHawk;
use IceHawk\IceHawk\Interfaces\RespondsFinallyToReadRequest;
use IceHawk\IceHawk\Interfaces\RespondsFinallyToWriteRequest;
use IceHawk\IceHawk\Routing\Patterns\Literal;
use IceHawk\IceHawk\Routing\Patterns\RegExp;
use IceHawk\IceHawk\Routing\ReadRoute;
use IceHawk\IceHawk\Routing\WriteRoute;

/**
 * Class IceHawkConfig
 * @package hollodotme\CCOne
 */
final class IceHawkConfig implements ConfiguresIceHawk
{
	use EnvInjecting;
	use DefaultCookieProviding;
	use DefaultEventSubscribing;
	use DefaultRequestBypassing;
	use DefaultRequestInfoProviding;

	public function getReadRoutes() : iterable
	{
		return [
			new ReadRoute( new Literal( '/' ), new ShowHomeRequestHandler( $this->getEnv() ) ),
			new ReadRoute( new RegExp( '#^/upload-form/?$#' ), new ShowUploadFormRequestHandler( $this->getEnv() ) ),
			new ReadRoute( new RegExp( '#^/gallery/?$#' ), new ShowGalleryRequestHandler( $this->getEnv() ) ),
		];
	}

	public function getWriteRoutes() : iterable
	{
		return [
			new WriteRoute( new Literal( '/upload' ), new UploadImagesRequestHandler( $this->getEnv() ) ),
		];
	}

	public function getFinalReadResponder() : RespondsFinallyToReadRequest
	{
		return new FinalReadResponder( $this->getEnv() );
	}

	public function getFinalWriteResponder() : RespondsFinallyToWriteRequest
	{
		return new FinalWriteResponder( $this->getEnv() );
	}
}
