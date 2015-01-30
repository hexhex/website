<?php
        header("Content-Type: text/plain");
	# insert the IP of the server which actually evaluates the HEX-program; this server must also run a webserver with php support
	print file_get_contents("http://128.130.205.74/demo/eval.php?mode=" . urlencode($_GET["mode"]) . "&commandlineoptions=" . $_GET["commandlineoptions"] . "&hexprogram=" . urlencode($_GET["hexprogram"]) . "&extsource=" . urlencode($_GET["extsource"]));
?>
