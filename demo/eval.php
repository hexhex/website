<?php
	$reasonercall = trim(file_get_contents("reasonercall.sh"));
	$shellstr = "$reasonercall $commandlineoptions --";
	#$shellstr = "echo \"%hexprogram\" | $reasonercall $commandlineoptions --pythonplugin=<(echo -e \"" . addslashes($extsource) . "\") --")";
	exec("echo \"$hexprogram\" | $shellstr 2>&1", $answer, $retcode);
	for ($answer as $line){
		print $line;
	}
	print $retcode;
?>
