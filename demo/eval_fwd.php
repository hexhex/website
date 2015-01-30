<?php
        header("Content-Type: text/plain");
	print file_get_contents("http://128.130.205.74/demo/eval.php?mode=" . urlencode($_GET["mode"]) . "&commandlineoptions=" . $_GET["commandlineoptions"] . "&hexprogram=" . urlencode($_GET["hexprogram"]) . "&extsource=" . urlencode($_GET["extsource"]));
?>
