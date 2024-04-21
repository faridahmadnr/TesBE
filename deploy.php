<?php

namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/npm.php';
require 'contrib/rsync.php';

///////////////////////////////////
// Config
///////////////////////////////////

set('application', 'KUR Backend');
set('repository', 'git@github.com:agungkes/kur-jogja-backend.git'); // Git Repository
set('ssh_multiplexing', true);  // Speed up deployment
set('http_user', 'kahasolu');
set('writable_mode', 'chmod');
set('keep_releases', 3);
// set('writable_mode', 'chmod');
//set('default_timeout', 1000);

set('rsync_src', function () {
    return __DIR__; // If your project isn't in the root, you'll need to change this.
});

set('bin/php', function () {
    return '/opt/alt/php82/usr/bin/php'; // only needed if using cpanel and the other
});

add('rsync', [
    'exclude' => [
        '.git',
        // '/vendor/',
        // '/node_modules/',
        '.github',
        'deploy.php',
    ],
]);

// add('shared_files', ['.env']);
add('shared_files', []);
add('shared_dirs', []);

// Set up a deployer task to copy secrets to the server.
// Grabs the dotenv file from the github secret
// task('deploy:secrets', function () {
//     file_put_contents(__DIR__ . '/.env', getenv('DOT_ENV'));
//     upload('.env', get('deploy_path') . '/shared');
// });

///////////////////////////////////
// Hosts
///////////////////////////////////

host('staging')
    ->setSshArguments(['-o StrictHostKeyChecking=no'])
    ->setHostname(getenv('STAGING_HOST'))
    ->setPort(getenv('STAGING_PORT'))
    ->set('remote_user', getenv('STAGING_USER'))
    ->set('branch', getenv('STAGING_BRANCH'))
    ->set('deploy_path', getenv('STAGING_DEPLOY_PATH'));

host('production')
    ->setSshArguments(['-o StrictHostKeyChecking=no'])
    ->setHostname(getenv('PRODUCTION_HOST'))
    ->setPort(getenv('PRODUCTION_PORT'))
    ->set('remote_user', getenv('PRODUCTION_USER'))
    ->set('branch', 'main')
    ->set('deploy_path', getenv('PRODUCTION_DEPLOY_PATH'));

after('deploy:failed', 'deploy:unlock');  // Unlock after failed deploy
after('deploy:info', 'deploy:unlock');  // Unlock after failed deploy

///////////////////////////////////
// Tasks
///////////////////////////////////

desc('Start of Deploy the application');

task('artisan:module:migrate', artisan('module:migrate --force', ['skipIfNoEnv']));

task('deploy', [
    'deploy:prepare',
    'rsync',                // Deploy code & built assets
    // 'deploy:secrets',       // Deploy secrets
    'deploy:vendors',
    'deploy:shared',        //
    'artisan:storage:link', //
    'artisan:view:cache',   //
    'artisan:config:cache', // Laravel specific steps
    'artisan:module:migrate',      //
    'artisan:queue:restart', //
    'deploy:publish',       //
]);

desc('End of Deploy the application');
