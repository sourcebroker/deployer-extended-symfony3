<?php

namespace Deployer;

task('deploy:database:migrate', function () {
    run('{{bin/php}} {{bin/console}} doctrine:migrations:migrate {{console_options}} --allow-no-migration');
})->desc('Migrate database');
