<?php

namespace Deployer;

require 'recipe/laravel.php';

set('application', 'Keys');
set('repository', 'git@github.com:SjorsO/keys.git');
set('git_tty', true);

// Keeping less than 3 releases seems to cause some files to get written
// to "releases/x/storage" instead of the correct shared symlink.
set('keep_releases', 3);

host('sjors@keys.lol')->set('deploy_path', '/var/www/keys');


task('build-npm-assets', 'npm i; npm run prod');

task('clear-opcache', 'sudo service php7.3-fpm reload');


after('deploy:failed', 'deploy:unlock');


task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',

    'deploy:vendors',
    'build-npm-assets',

    'deploy:writable',

//    'artisan:storage:link',
    'artisan:view:clear',
    'artisan:config:cache',
    'artisan:route:cache',

    'artisan:migrate',

    'deploy:symlink',

    'clear-opcache',
    'artisan:queue:restart',

    'deploy:unlock',
    'cleanup',
]);
