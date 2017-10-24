<?php

namespace Deployer;

task('deploy:assetic:dump', function () {
    if (get('dump_assets', false)) {
        run('{{bin/php}} {{bin/console}} assetic:dump {{console_options}}');
    }
})->desc('Dump assets');