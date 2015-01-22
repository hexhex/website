<?php
        header("Content-Type: text/plain");

        if ($_GET["mode"] == "getversion"){
		print trim(shell_exec(file_get_contents("getversion.sh")));
	}

        if ($_GET["mode"] == "evalhex"){
		$commandlineoptions = $_GET["commandlineoptions"];
		$hexprogram = $_GET["hexprogram"];
		$extsource = $_GET["extsource"];

		$reasonercall = trim(file_get_contents("reasonercall.sh"));
		$shellstr = "$reasonercall $commandlineoptions --";
		#$shellstr = "echo \"%hexprogram\" | $reasonercall $commandlineoptions --pythonplugin=<(echo -e \"" . addslashes($extsource) . "\") --")";
		exec("echo \"$hexprogram\" | $shellstr 2>&1", $answer, $retcode);
		print $retcode;
		foreach ($answer as $line){
		        print "\n" . $line;
		}
	}
?>
