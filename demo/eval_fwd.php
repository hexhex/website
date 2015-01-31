<?php
        header("Content-Type: text/plain");
	# insert the IP of the server which actually evaluates the HEX-program; this server must also run a webserver with php support
	print file_get_contents(trim(file_get_contents('fwdurl.txt')) . "?mode=" . urlencode($_GET["mode"]) . "&commandlineoptions=" . urlencode($_GET["commandlineoptions"]) . "&hexprogram=" . urlencode($_GET["hexprogram"]) . "&extsource=" . urlencode($_GET["extsource"]));
?>
