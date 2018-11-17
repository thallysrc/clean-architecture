<?php

declare(strict_types=1);
require __DIR__.'/vendor/autoload.php';

$user = $argv[1];

$service = \CleanArchitecture\GithubUser::factory('https://api.github.com');

echo json_encode($service->getInfo($user), JSON_PRETTY_PRINT);
