<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\CCOne;

use IceHawk\Bridges\SessionForms\AbstractSession;

/**
 * Class Session
 * @package hollodotme\CCOne
 */
final class Session extends AbstractSession
{
	private const IS_AUTHENTICATED = 'isAuthenticated';

	public function isAuthenticated() : bool
	{
		return (bool)$this->get( self::IS_AUTHENTICATED );
	}

	public function setAuthenticated() : void
	{
		$this->set( self::IS_AUTHENTICATED, true );
	}

	public function setUnauthenticated() : void
	{
		$this->set( self::IS_AUTHENTICATED, false );
	}
}
