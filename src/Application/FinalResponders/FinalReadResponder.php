<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\CCOne\Application\FinalResponders;

use hollodotme\CCOne\Traits\EnvInjecting;
use IceHawk\IceHawk\Interfaces\ProvidesReadRequestData;
use IceHawk\IceHawk\Interfaces\RespondsFinallyToReadRequest;

/**
 * Class FinalReadResponder
 * @package hollodotme\CCOne\Application\FinalResponders
 */
final class FinalReadResponder implements RespondsFinallyToReadRequest
{
	use EnvInjecting;

	public function handleUncaughtException( \Throwable $throwable, ProvidesReadRequestData $request ) : void
	{
		// TODO: Implement handleUncaughtException() method.
	}
}
