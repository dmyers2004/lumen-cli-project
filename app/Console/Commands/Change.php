<?php namespace App\Console\Commands;

use App\Console\Commands\Base_Command;

class Change extends Base_Command {

		protected $signature = 'change {method=help} {arg1?} {arg2?} {arg3?} {arg4?} {arg5?} {arg6?}';
		protected $description = 'Change Application Setting';
		protected $methods = [
			'help'=>0,
			'application'=>2,
			'state'=>2,
			'date'=>1,
			'running'=>1,
		];

		public function application($name,$value) {
			return __FUNCTION__.' Changing '.$name.' to '.$value;
		}

		public function state($name,$value) {
			return __FUNCTION__.' Changing '.$name.' to '.$value;
		}

		public function date($date) {
			return __FUNCTION__.' Changing '.$date;
		}

		public function running($state) {
			return __FUNCTION__.' Changing '.$state;
		}

} /* end class */