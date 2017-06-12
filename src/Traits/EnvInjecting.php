<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\CCOne\Traits;

use hollodotme\CCOne\Env;

/**
 * Trait EnvInjecting
 * @package hollodotme\CCOne\Traits
 */
trait EnvInjecting
{
	/** @var Env */
	private $env;

	public function __construct( Env $env )
	{
		$this->env = $env;
	}

	final protected function getEnv() : Env
	{
		return $this->env;
	}
}
