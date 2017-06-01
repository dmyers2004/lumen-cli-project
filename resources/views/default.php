<?php
echo $description.chr(10).chr(10);

foreach ($help as $method=>$help) {
	echo 'php artisan '.$command.' '.$method.' ';
	
	foreach ($help['params'] as $p) {
		$name = $p->name;
		
		if (substr($name,-1) == '_') {
			$name = rtrim($name,'_').'?';
		}
		
		echo $name.' ';
	}
	
	echo '- '.$help['help'].chr(10);
}

echo chr(10).'Artisan command last updated: '.date('F j, Y, g:ia T',$filemtime).chr(10); 

