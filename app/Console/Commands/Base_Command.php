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
	protected $method;
	protected $methods;
	protected $command;
	protected $params;
	protected $help;
	protected $filemtime;

	public function __construct() {
		date_default_timezone_set('America/New_York');

		parent::__construct();
	}

	public function handle() {
		/* $v = env('SECRET_KEY'); */

		/* graft on help method which is on this class */
		$this->methods['help'] = 0;
		$this->help['help'] = ['help'=>'Show this Help','params'=>[]];

		$child_class_name = get_called_class();

		$reflector = new \ReflectionClass($child_class_name);
		
		$this->filemtime = filemtime($reflector->getFileName());
		
		$methods = $reflector->getMethods();
		
		foreach ($methods as $method) {
			if ($method->class == $child_class_name) {
				$this->methods[$method->name] = 0;
				
				foreach ($method->getParameters() as $p) {
					if (substr($p->name,-1) != '_') {
						$this->methods[$method->name]++;
					}
				}
				
				$help = trim(str_replace(['/**','* ','*/'],'',	$method->getDocComment()));

				$this->help[$method->name] = ['help'=>$help,'params'=>$method->getParameters()];
			}
		}

		$this->params = $this->argument();
		
		$this->command = array_shift($this->params); /* shift off command */
		$this->method = array_shift($this->params); /* shift off method */
		
		/* does method exist? */
		if (array_key_exists($this->method,$this->methods)) {
			try {
				$this->_required($this->methods[$this->method])->info(call_user_func_array([$this,$this->method],array_filter($this->params)));
			} catch(Exception $e) {
				$this->error($e->getMessage());
			}
		} else {
			$this->error('Method "'. $this->method.'" not found');
		}
	}

	protected function _required($count) {
		if (count(array_filter($this->argument())) < ($count + 2)) {
			throw new Exception($count.' Argument'.(($count > 1) ? 's' : '').' required');
		}

		return $this;
	}

	public function help() {
		$view = (app('view')->exists($this->command)) ? $this->command : 'default';
		
		return app('view')->make($view,[
			'signature'=>$this->signature,
			'description'=>$this->description,
			'method'=>$this->method,
			'methods'=>$this->methods,
			'command'=>$this->command,
			'params'=>$this->params,
			'help'=>$this->help,
			'filemtime'=>$this->filemtime,
		]);
	}

} /* end class */