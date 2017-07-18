<?php
namespace Deployer;
require 'recipe/laravel.php';
use function Deployer\set;
use function Deployer\server;
use function Deployer\task;
use function Deployer\run;
use function Deployer\get;
use function Deployer\add;
use function Deployer\before;
use function Deployer\after;
use function Deployer\upload;
// Configuration

// set('ssh_type', 'native');
// set('ssh_multiplexing', true);

// set('repository', 'git@domain.com:username/repository.git');

// add('shared_files', []);
// add('shared_dirs', []);

// add('writable_dirs', []);

// // Servers

// server('production', 'domain.com')
//     ->user('username')
//     ->identityFile()
//     ->set('deploy_path', '/var/www/domain.com')
//     ->pty(true);


// // Tasks

// desc('Restart PHP-FPM service');
// task('php-fpm:restart', function () {
//     // The user must have rights for restart service
//     // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
//     run('sudo systemctl restart php-fpm.service');
// });
// after('deploy:symlink', 'php-fpm:restart');

// // [Optional] if deploy fails automatically unlock.
// after('deploy:failed', 'deploy:unlock');

// // Migrate database before symlink new release.

// before('deploy:symlink', 'artisan:migrate');


set('default_stage', 'production');
server('clevoclick', 'clevoclick.com.ng')
	->stage('production')
	->user("clevocli")
	->password("edgeproject2015")
	->set('deploy_path', '/var/www/cause');

task('deploy:staging', function(){
	writeln('<info>Deploying...</info>');
	$appFiles = ['composer.json', '.gitignore'];
	$deploy_path = '/var/www';

	foreach ($appFiles as $file) {
		# code...
		upload($file, "{$deploy_path}/{$file}");

	}
	writeln('<info>Deployment is done.</info>');
});

task('pwd', function(){
	$result = run('pwd');
	writeln("Current dir: $result");
});

