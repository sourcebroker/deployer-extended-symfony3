<?php

namespace Deployer;

// Some parts from https://github.com/deployphp/deployer/blob/master/recipe/symfony3.php

set('symfony_env', 'prod');
set('shared_dirs', ['var/logs', 'var/sessions']);
set('shared_files', ['app/config/parameters.yml']);
set('writable_dirs', ['var/cache', 'var/logs', 'var/sessions']);
set('bin_dir', 'bin');
set('var_dir', 'var');
set('bin/console', function () {
    return sprintf('{{release_path}}/%s/console', trim(get('bin_dir'), '/'));
});
set('console_options', function () {
    $options = '--no-interaction --env={{symfony_env}}';
    return get('symfony_env') !== 'prod' ? $options : sprintf('%s --no-debug', $options);
});
set('assets', ['web/css', 'web/images', 'web/js']);
set('dump_assets', false);
set('env', function () {
    return [
        'SYMFONY_ENV' => get('symfony_env')
    ];
});
set('clear_paths', [
    '.git',
    '.gitignore',
    '.gitattributes',
    'composer.json',
    'composer.lock',
    'composer.phar',
    'web/app_*.php',
    'web/config.php',
]);

// Look https://github.com/sourcebroker/deployer-extended-media for docs
set('media',
    [
        'filter' => [
            '+ /web/',
            '+ /web/media/',
            '+ /web/media/**',
            '- *'
        ]
    ]);

// Look https://github.com/sourcebroker/deployer-extended-database for docs
set('db_defaults', [
    'truncate_tables' => [],
    'ignore_tables_out' => [],
    'post_sql_in' => '',
    'post_sql_in_markers' => ''
]);

// Look https://github.com/sourcebroker/deployer-extended-database for docs
set('db_databases',
    [
        'database_default' => [
            get('db_defaults'),
            (new \SourceBroker\DeployerExtendedSymfony3\Drivers\Symfony3Driver)->getDatabaseConfig(),
        ]
    ]
);

