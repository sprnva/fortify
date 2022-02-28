<?php

namespace App\Core\Install;

use App\Core\Filesystem\Filesystem;

class Fortify
{
	public function handle_install()
	{
		$exist = 0;

		if (!file_exists('app/controllers/Auth')) {
			// Controllers...
			(new Filesystem)->ensureDirectoryExists('app/controllers/Auth');
			(new Filesystem)->copyDirectory(__DIR__ . '/../stubs/default/app/controllers/Auth', 'app/controllers/Auth', '.php');
		} else {
			$exist++;
		}

		if (!file_exists('app/views/auth')) {
			// Views...
			(new Filesystem)->ensureDirectoryExists('app/views/auth');
			(new Filesystem)->copyDirectory(__DIR__ . '/../stubs/default/app/views/auth', 'app/views/auth');
		} else {
			$exist++;
		}

		if (!file_exists('config/routes/auth.php')) {
			// Routes...
			copy(__DIR__ . '/../stubs/default/config/routes/auth.php', 'config/routes/auth.php');
		} else {
			$exist++;
		}

		echo ($exist < 1) ? "Fortified.\n" : "Already fortified.\n";
	}
}
