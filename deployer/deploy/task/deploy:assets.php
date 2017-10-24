<?php

namespace Deployer;

task('deploy:assets', function () {
    $assets = implode(' ', array_map(function ($asset) {
        return "{{release_path}}/$asset";
    }, get('assets')));
    run(sprintf('find %s -exec touch -t %s {} \';\' &> /dev/null || true', $assets, date('YmdHi.s')));
})->desc('Normalize asset timestamps');
