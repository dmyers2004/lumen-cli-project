<?php namespace App\Console\Commands;

class Change extends \App\Console\Commands\Base_Command {

	protected $signature = 'quad:change {method=help} {arg1?} {arg2?} {arg3?} {arg4?} {arg5?}';
	protected $description = 'Change Application Setting';
	
	/**
	*  change a application config setting
	*/
	public function application($name,$value) {
		return __FUNCTION__.' Changing '.$name.' to '.$value;
	}
	
	/**
	* change a application config setting
	*/
	public function state($name,$value) {
		return __FUNCTION__.' Changing '.$name.' to '.$value;
	}

	/**
	* change date setting
	*/
	public function date($date) {
		return __FUNCTION__.' Changing '.$date;
	}

	/**
	* change running setting
	*/
	public function running($state) {
		return __FUNCTION__.' Changing '.$state;
	}

} /* end class */