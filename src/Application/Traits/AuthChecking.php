<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\CCOne\Application\Traits;

use hollodotme\CCOne\Application\Responses\Redirect;
use hollodotme\CCOne\Session;

trait AuthChecking
{
	private function checkAuth( Session $session ) : void
	{
		if ( !$session->isAuthenticated() )
		{
			(new Redirect())->respond( '/login' );
			die();
		}
	}
}
