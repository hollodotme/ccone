<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\CCOne\Application\FinalResponders;

use hollodotme\CCOne\Traits\EnvInjecting;
use IceHawk\IceHawk\Interfaces\ProvidesWriteRequestData;
use IceHawk\IceHawk\Interfaces\RespondsFinallyToWriteRequest;

/**
 * Class FinalWriteResponder
 * @package hollodotme\CCOne\Application\FinalResponders
 */
final class FinalWriteResponder implements RespondsFinallyToWriteRequest
{
	use EnvInjecting;

	public function handleUncaughtException( \Throwable $throwable, ProvidesWriteRequestData $request ) : void
	{

	}
}
