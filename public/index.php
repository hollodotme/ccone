<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\CCOne;

use IceHawk\IceHawk\IceHawk;

require_once __DIR__ . '/../vendor/autoload.php';

$env     = new Env();
$iceHawk = new IceHawk( new IceHawkConfig( $env ), new IceHawkDelegate() );
$iceHawk->init();

$iceHawk->handleRequest();
