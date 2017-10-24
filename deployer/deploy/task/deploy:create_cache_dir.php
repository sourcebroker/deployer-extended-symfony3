<?php

namespace Deployer;

task('deploy:create_cache_dir', function () {
    set('cache_dir', '{{release_path}}/' . trim(get('var_dir'), '/') . '/cache');
    run('if [ -d "{{cache_dir}}" ]; then rm -rf {{cache_dir}}; fi');
    run('mkdir -p {{cache_dir}}');
    run("chmod -R g+w {{cache_dir}}");
})->desc('Create cache dir');