<?php

namespace Deployer;

task('deploy', [

    // Standard deployer deploy:info
    'deploy:info',

    // Read more on https://github.com/sourcebroker/deployer-extended#deploy-check-lock
    'deploy:check_lock',

    // Read more on https://github.com/sourcebroker/deployer-extended#deploy-check-composer-install
    'deploy:check_composer_install',

    // Read more on https://github.com/sourcebroker/deployer-extended#deploy-check-branch-local
    'deploy:check_branch_local',

    // Read more on https://github.com/sourcebroker/deployer-extended#deploy-check-branch
    'deploy:check_branch',

    // Standard deployer deploy:prepare
    'deploy:prepare',

    // Standard deployer deploy:lock
    'deploy:lock',

    // Standard deployer deploy:release
    'deploy:release',

    // Standard deployer deploy:update_code
    'deploy:update_code',

    // Special for symfony3
    'deploy:create_cache_dir',

    // Standard deployer deploy:shared
    'deploy:shared',

    // Special for symfony3
    'deploy:assets',

    // Standard deployer deploy:vendors
    'deploy:vendors',

    // Special for symfony3
    'deploy:database:update',

    // Special for symfony3
    'deploy:assets:install',

    // Special for symfony3
    'deploy:assetic:dump',

    // Special for symfony3
    'deploy:cache:clear',

    // Special for symfony3
    'deploy:cache:warmup',

    // Clear php cli cache.
    // Read more on https://github.com/sourcebroker/deployer-extended#php-clear-cache-cli
    'cache:clear_php_cli',

    // Standard deployer deploy:writable
    'deploy:writable',

    // Standard deployer deploy:clear_paths
    'deploy:clear_paths',

    // Standard deployers symlink (symlink release/x/ to current/)
    'deploy:symlink',

    // Standard deployer deploy:unlock
    'deploy:unlock',

    // Standard deployer cleanup.
    'cleanup',

    // Read more on https://github.com/sourcebroker/deployer-extended#deploy-extend-log
    'deploy:extend_log',

    // Standard deployer success.
    'success',

])->desc('Deploy your Symfony3 project');

after('deploy:failed', 'deploy:unlock');
