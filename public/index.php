<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\CCOne;

use IceHawk\IceHawk\IceHawk;

require_once __DIR__ . '/../vendor/autoload.php';

$iceHawk = new IceHawk( new IceHawkConfig(), new IceHawkDelegate() );
$iceHawk->init();

$iceHawk->handleRequest();
