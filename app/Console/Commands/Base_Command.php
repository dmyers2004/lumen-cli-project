<?php namespace App\Console\Commands;

/*
https://mattstauffer.co/blog/creating-artisan-commands-with-the-new-simpler-syntax-in-laravel-5.1
https://laravel.com/docs/5.4/database
https://laravel.com/docs/5.4/eloquent
*/

use Illuminate\Console\Command;
use Exception;

class Base_Command extends Command {

		protected $signature;
		protected $description;
		protected $methods;

		public function handle() {
			/* $v = env('SECRET_KEY'); */

			$method = $this->argument('method');

			if (array_key_exists($method,$this->methods)) {
				try {
					$this->_required($this->methods[$method])->info($this->$method($this->argument('arg1'),$this->argument('arg2'),$this->argument('arg3'),$this->argument('arg4'),$this->argument('arg5')));
				} catch(Exception $e) {
					$this->error($e->getMessage());
				}
			} else {
				$this->error('Method "'. $method.'" not found');
			}
		}

		protected function _required($count) {
			if (count(array_filter($this->argument())) != ($count + 2)) {
				throw new Exception($count.' Argument'.(($count > 1) ? 's' : '').' required');
			}

			return $this;
		}

		public function help() {
			$command = substr($this->signature, 0, strpos($this->signature, ' '));
			
			return app('view')->make($command,[
				'methods'=>$this->methods,
				'signature'=>$this->signature,
				'command'=>$command,
				'description'=>$this->description
			]);
		}
		
		public function database() {
			$results = app('db')->select("SELECT * FROM users");

			var_dump($results);
		}

} /* end class */