<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\CCOne;

/**
 * Class Env
 * @package hollodotme\CCOne
 */
final class Env
{
	/** @var array */
	private $pool = [];

	private function getSharedInstance( string $key, \Closure $createFunction )
	{
		if ( !isset( $this->pool[ $key ] ) )
		{
			$this->pool[ $key ] = $createFunction->call( $this );
		}

		return $this->pool[ $key ];
	}

	public function getTemplateRenderer() : \Twig_Environment
	{
		return $this->getSharedInstance(
			'templateRenderer',
			function ()
			{
				$loader      = new \Twig_Loader_Filesystem( __DIR__ . '/Application/Web' );
				$options     = [
					'debug'      => true,
					'cache'      => sys_get_temp_dir(),
					'autoescape' => 'html',

				];
				$environment = new \Twig_Environment( $loader, $options );
				$environment->addExtension( new \Twig_Extension_Debug() );

				return $environment;
			}
		);
	}
}
