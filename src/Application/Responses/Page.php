<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\CCOne\Application\Responses;

use hollodotme\CCOne\Traits\EnvInjecting;
use IceHawk\IceHawk\Constants\HttpCode;

/**
 * Class Page
 * @package hollodotme\CCOne\Application\Responses
 */
final class Page
{
	use EnvInjecting;

	public function respond( string $template, array $data, int $httpCode = HttpCode::OK ) : void
	{
		$renderer = $this->getEnv()->getTemplateRenderer();

		header( 'Content-type: text/html; charset=utf-8', true, $httpCode );
		echo $renderer->render( $template, $data );
		flush();
	}
}
