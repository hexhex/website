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
		$sshforwarding = trim(file_get_contents("sshforwarding.sh"));
		$shellstr = "$reasonercall $commandlineoptions --";

		# now delegate the reasoner call to a dedicated virtual machine

		# double escaping here because strings will be interpreted twice (when ssh is called and when the echo statements below are evaluated)
		$hexprogramQuoted = addslashes(addslashes($hexprogram));
		$extsourceQuoted = addslashes(addslashes($extsource));
		# single escaping suffices as the string will be interpreted only when ssh is called
		$commandlineoptionsQuoted = addslashes(addslashes($commandlineoptions));
		$shellstr = "$sshforwarding \"
				source ~/.profile;
				# double escaping of quotation marks here because they will be interpreted twice (when PHP is interpreted and when ssh is called)
				echo -e \\\"$hexprogramQuoted\\\" | $reasonercall $commandlineoptionsQuoted --pythonplugin=<(echo -e \\\"$extsourceQuoted\\\") --\"";

		# direct call without virtual machine
#		$shellstr = "echo \"$hexprogram\" | $reasonercall $commandlineoptions --pythonplugin=<(echo -e \"" . addslashes($extsource) . "\") --\")";

		# actual execution of the command
		exec("$shellstr 2>&1", $answer, $retcode);

		# final output
		print $retcode;
		foreach ($answer as $line){
		        print "\n" . $line;
		}
		#print "Executed: " . "$shellstr 2>&1";
	}
?>
