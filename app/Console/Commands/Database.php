<?php namespace App\Console\Commands;

class Database extends \App\Console\Commands\Base_Command {

	protected $signature = 'quad:database {method=help} {arg1?} {arg2?} {arg3?} {arg4?} {arg5?}';
	protected $description = 'Database Testing';
	
	/**
	*  Test 1 example
	*/
	public function test1($name_='name') {
		return __FUNCTION__.print_r(func_get_args(),true);
	}

	/**
	*  Test 2 example
	*/
	public function test2($name_='name',$value_='value') {
		return __FUNCTION__.print_r(func_get_args(),true);
	}

	/**
	*  Test 3 example
	*/
	public function test3($name='name',$value_='value') {
		return __FUNCTION__.print_r(func_get_args(),true);
	}

	/**
	*  Test 4 example
	*/
	public function test4($name='name',$value='value') {
		return __FUNCTION__.print_r(func_get_args(),true);
	}
	
	/**
	 * Test Database Connection
	 */
	public function test5() {
		$results = app('db')->select("SELECT * FROM migrations");

		var_dump($results);
		
		
		return 'yes';
	}

} /* end class */