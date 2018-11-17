<?php

declare(strict_types=1);
require __DIR__.'/vendor/autoload.php';

$service = \CleanArchitecture\GithubUser::factory('https://api.github.com');

echo json_encode($service->getInfo(), JSON_PRETTY_PRINT);
