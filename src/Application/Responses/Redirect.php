<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\CCOne\Application\Responses;

use IceHawk\IceHawk\Constants\HttpCode;

/**
 * Class Redirect
 * @package hollodotme\CCOne\Application\Responses
 */
final class Redirect
{
	public function respond( string $url, int $httpCode = HttpCode::MOVED_PERMANENTLY ) : void
	{
		session_write_close();

		header( 'Location: ' . $url, true, $httpCode );
		flush();
	}
}
