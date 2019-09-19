<?php
declare(strict_types=1);

$app = require_once __DIR__ . "/../bootstrap.php";


$content = $app->createRiver('businessetc');


echo "<pre>", print_r($content), "</pre>";



