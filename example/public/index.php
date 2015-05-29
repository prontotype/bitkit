<?php

/*
|--------------------------------------------------------------------------
| Base path
|--------------------------------------------------------------------------
|
| Path to the root of your site (may be different from your web root!).
|
*/

$basePath = __DIR__ . '/..';

/*
|--------------------------------------------------------------------------
| Path to your Composer autoload file
|--------------------------------------------------------------------------
|
| You will only need to edit this if you have specified a custom location
| for your Composer vendors directory.
|
*/

$autoloader = __DIR__ . '/../../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Boot up the application
|--------------------------------------------------------------------------
|
| You shouldn't need to edit anything below this line.
|
*/

require $autoloader;

$app = new BitKit\Application($basePath);
$status = $app->run();

exit($status);
