<?php

namespace Deployer;

task('deploy:assets:install', function () {
    run('{{bin/php}} {{bin/console}} assets:install {{console_options}} {{release_path}}/web');
})->desc('Install bundle assets');
