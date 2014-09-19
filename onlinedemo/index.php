<html style="width:100%">
<head>
	<title>dlvhex Online Demo</title>

	<style type="text/css">
		.TFtable{
			width:100%; 
			border-collapse:collapse; 
		}
		.TFtable td{ 
			padding:7px; border:MediumSlateBlue 1px solid;
		}
		/* provide some minimal visual accomodation for IE8 and below */
		.TFtable tr{
			background: MediumSlateBlue;
		}
		/*  Define the background color for all the ODD background rows  */
		.TFtable tr:nth-child(odd){ 
			background: Lavender;
		}
		/*  Define the background color for all the EVEN background rows  */
		.TFtable tr:nth-child(even){
			background: GhostWhite;
		}
	</style>
</head>

<body style="width:99%">

	<?php
		$hexprogram = $_POST['hexprogram'];
		$extsource = $_POST['extsource'];
		$example = trim($_POST['example']);
		$evaluate = isset($_POST['evaluate']);
	?>

	<img width="30%" src="./dlvhexlogo.png"/><br/>
	<p>This is an <b>online demo</b> of the <a href="..">dlvhex system</a>. Plugins for the program on the left may be directly implemented in a Python script on the right.</p>
	<p>Please check out the predefined examples at the bottom right corner for a quick overview or consider the system documentation for a more detailed description.</p>
	<div style="text-align:right;">(The online demo runs <?php
			print shell_exec("./getversion.sh");
		?>)
	</div>

        <div style="width:100%;">

		<form method="post" action="index.php">
			<div style="width:49%;float:left;">
				<b>HEX-Program:</b></br>
				<textarea name="hexprogram" style="width:100%;" rows="30"><?php if ($example != ""){print file_get_contents("./examples/" . $example . "/program.hex");}else{print $hexprogram;}?></textarea>
				<div style="width:100%;text-align:right;"><input type="submit" name="evaluate" value="Evaluate"></div>
			</div>
			<div style="width:2%;float:left;">&nbsp;</div>
			<div style="width:49%;float:left;">
				<b>External Source Definition:</b></br>
				<textarea name="extsource" style="width:100%;" rows="30"><?php if ($example != ""){print file_get_contents("./examples/" . $example . "/plugin.py");}else{print $extsource;}?></textarea>
				<div style="text-align:right;">
					Load example:
					<select name="example" onchange="this.form.submit()">
					<?php
						print "<option name=\"\" value=\"\"></option>";
						if ($handle = opendir('./examples')) {
							while (false !== ($file = readdir($handle))) {
								if ($file != "." && $file != ".."){
									print "<option name=\"example\" value=\"$file\">$file</option>";
								}
							}
	
							closedir($handle);
						}
					?>
					</select>
				</div>
			</div>
	     </form>
	</div>

	<div style="width:100%;float:right;">
	<?
		function endsWith($haystack, $needle) {
			return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
		}

		if ($evaluate) {
			$reasonercall = trim(file_get_contents("./reasonercall.sh"));
			$shellstr = "echo \"$hexprogram\" | $reasonercall --";
#			$shellstr = "echo \"%hexprogram\" | $reasonercall --pythonplugin=<(echo -e \"" . addslashes($extsource) . "\") --")";
			$answer = shell_exec("$shellstr 2>&1; echo ret$?");
			$pattern = '/ret\d+/i';
			$replace = '';
			$retcode = endsWith(trim($answer), "ret0");
			$answer = preg_replace($pattern, $replace, $answer);

			print "<b>Command Line:</b><br/><br/>";
			print "echo \"[HEX-program code]\" | $reasonercall -- 2>&1";
#               	print "echo \"$hexprogram\" | $reasonercall --pythonplugin=<(echo \"[external source code]\") 2>&1";
			print "<br/><br/>";

			if ($retcode) {
				print "<b>Answer Sets:</b>";
				print "<table class=\"TFTable\">";
				$ret = shell_exec("echo -e \"$answer\" | tail -n 1");
				$pattern = '/{([^}]*)}/i';
				$replace = '<tr><td>{$1}</td></tr>';
				echo preg_replace($pattern, $replace, $answer);
				print "</table>";
			}else{
				print "<font color=\"red\"><b>Error:</b></font><br/><br/>";
				print $answer;
			}
		}
	?>

	</div>

</body>
</html>
