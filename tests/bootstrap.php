<?php
/**
* Main bootstrapper used to set up the testsuites environment.
*
* @package Application Utils
* @subpackage Tests
* @author Sebastian Mordziol <s.mordziol@mistralys.eu>
*/

declare(strict_types=1);

$autoloader = __DIR__ . '/../vendor/autoload.php';

if(!file_exists($autoloader))
{
    die('ERROR: The autoloader is not present. Please run composer install first.');
}

require_once $autoloader;
