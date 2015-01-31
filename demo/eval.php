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

		# escaping here because strings will be interpreted when the echo statements below is evaluated
		$hexprogramQuoted = addslashes($hexprogram);
		$extsourceQuoted = addslashes($extsource);
		# no escaping because this string is not passed through an echo command
		$commandlineoptionsQuoted = $commandlineoptions;

		# direct call without virtual machine
		$shellstr = 'hexprogramfile=$(mktemp); extsourcefile=$(mktemp); stderrfile=$(mktemp); echo "' . $hexprogramQuoted . '" > $hexprogramfile; echo "' . $extsourceQuoted . '" > $extsourcefile; ' . $reasonercall . ' ' . $commandlineoptions . ' --pythonplugin=$extsourcefile $hexprogramfile 2>$stderrfile; ret=$?; rm $hexprogramfile; rm $extsourcefile; if [ $ret -ne -0 ]; then cat $stderrfile; fi; exit $ret';

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
