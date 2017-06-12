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

	}
}
