<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\CCOne;

use IceHawk\IceHawk\Interfaces\ProvidesRequestInfo;
use IceHawk\IceHawk\Interfaces\SetsUpEnvironment;

/**
 * Class IceHawkDelegate
 * @package hollodotme\CCOne
 */
final class IceHawkDelegate implements SetsUpEnvironment
{
	public function setUpGlobalVars() : void
	{
		// TODO: Implement setUpGlobalVars() method.
	}

	public function setUpErrorHandling( ProvidesRequestInfo $requestInfo ) : void
	{
		error_reporting( E_ALL );
		ini_set( 'display_errors', 'On' );
	}

	public function setUpSessionHandling( ProvidesRequestInfo $requestInfo ) : void
	{
		ini_set( 'session.name', 'cundcsid' );
		ini_set( 'session.save_handler', 'redis' );
		ini_set( 'session.save_path', 'tcp://127.0.0.1:6379?weight=1&database=3' );
		ini_set( 'session.gc_maxlifetime', '86400' );

		session_set_cookie_params( 86400, '/', '.c-und-c.one', true, true );
	}
}
