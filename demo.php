<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>dlvhex</title>
    <link rel="stylesheet" type="text/css" media="all" href="css/reset.css"></link>
    <link rel="stylesheet" type="text/css" media="all" href="css/text.css"></link>
    <link rel="stylesheet" type="text/css" media="all" href="css/960.css"></link>
    <link rel="stylesheet" type="text/css" media="all" href="css/style.css"></link>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  </head>
  <body>
    <!-- Title -->
    <div class="container_12">
	<div class="grid_12" id="title">
	      <h1>dlvhex
        </h1>
	</div>
    </div>
    <!-- Menu -->
    <div class="container_12">
      <div class="grid_12" id="menu">
	<a href="index.html">About</a>
	<a href="people.html">People</a>
	<a href="news.html">News</a>
	<a href="download.html">Download</a>
	<a href="support.html">Support</a>
	<a href="documentation.html">Documentation</a>
	<a href="http://asptut.gibbi.com/">Demo &amp; ASP Tutorial</a>
	<a href="related.html">Related Work</a>
	<a href="applications.html">Applications</a>
	<a href="literature.html">Literature</a>
      </div>
    </div>
    <!-- Information -->
    <div class="container_12">
      <div class="grid_9">
	<h2>Online Demo</h2>
	<?php
                $hexprogram = $_POST['hexprogram'];
                $extsource = $_POST['extsource'];
                $example = trim($_POST['example']);
                if (!isset($_POST['hexprogram'])){
                        $example = "Tutorial";
                }
	?>
	<!--<img width="30%" src="images/dlvhexlogo.png" alt=""><br>-->
	<p>This online demo of the dlvhex system allows for
	evaluating programs without local installation.
	This is intended mainly for testing and learning purposes.
	Plugins for the program on the left may be directly implemented in a Python script on the right.</p>
	<p>Please check out the predefined examples at the bottom right corner for a quick overview or consider the system documentation for a more detailed description.</p>
	<div style="text-align:right;">(The online demo runs <?php
			print shell_exec("demo/getversion.sh");
		?>)
	</div>
	<br>
        <div style="width:100%;">
		<h3>Input</h3>
		<form method="post" action="demo.php">
			<div style="text-align:right;">
				Load example:
				<select name="example" onchange="this.form.submit()">
				<?php
					print "<option name=\"\" value=\"\"></option>";
					if ($handle = opendir('demo/examples')) {
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
<!-- <div style="width:49%;float:left;">-->
			<b>HEX-Program:</b></br>
			<textarea name="hexprogram" style="width:100%; resize:none;" rows="30"><?php if ($example != ""){print file_get_contents("demo/examples/" . $example . "/program.hex");}else{print $hexprogram;}?></textarea>
<!-- </div>-->
<!-- <div style="width:2%;float:left;">&nbsp;</div>-->
<!-- <div style="width:49%;float:left;">-->
			<br><br>
			<b>External Source Definition:</b></br>
			<textarea name="extsource" style="width:100%; resize:none;" rows="30"><?php if ($example != ""){print file_get_contents("demo/examples/" . $example . "/plugin.py");}else{print $extsource;}?></textarea>
			<br><br>
			<b>Command-line Options:</b></br>
			<table width="100%" summary="">
                        <tr><td>Filter predicates (comma-separated):<td><td><input type="text" name="optFilter" style="width:100%" value="<?php echo isset($_POST['optFilter']) ? $_POST['optFilter'] : ''; ?>"></td></tr>
                        <tr><td>Liberal safety:<td><td><input type="checkbox" name="optLiberalSafety" <?php echo isset($_POST['optLiberalSafety']) ? 'checked' : ''; ?>></td></tr>
                        <tr><td>Custom options:<td><td><input type="text" name="optCustom" style="width:100%" value="<?php echo isset($_POST['optCustom']) ? $_POST['optCustom'] : ''; ?>"></td></tr>
			</table>
			<div style="width:100%;text-align:right;"><input type="submit" value="Evaluate"></div>
<!-- </div>-->
	     </form>
	</div>
	<h3>Output</h3>
	<div style="width:100%;float:right;">
	<?php
		if (!isset($_POST['hexprogram'])){
			function endsWith($haystack, $needle) {
				return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
			}
			$commandlineoptions = "";
			if ($_POST['optFilter'] != "") { $commandlineoptions = $commandlineoptions . " --filter=" . $_POST['optFilter']; };
			if ($_POST['optLiberalSafety']) { $commandlineoptions = "--liberalsafety"; }
			if ($_POST['optCustom'] != "") { $commandlineoptions = $commandlineoptions . " " . $_POST['optCustom']; };
			$reasonercall = trim(file_get_contents("demo/reasonercall.sh"));
			$shellstr = "echo \"$hexprogram\" | $reasonercall $commandlineoptions --";
			$answer = shell_exec("$shellstr 2>&1; echo ret$?");
			$pattern = '/ret\d+/i';
			$replace = '';
			$retcode = endsWith(trim($answer), "ret0");
			$answer = preg_replace($pattern, $replace, $answer);
			print "<b>Command Line:</b><br>";
			print "dlv $commandlineoptions program.hex";
			print "<br>";
		        print "where program.hex and extsource.py refer to the program and plugin entered above, respectively";
			print "<br><br>";
		        if ($retcode) {
		                print "<b>Answer Sets:</b>";
		                $astab = "";
		                $ret = shell_exec("echo -e \"$answer\" | tail -n 1");
		                $answersets = explode(PHP_EOL, trim(shell_exec("echo -e \"$answer\" | head -n -1")));
		                $nr = 0;
		                foreach ($answersets as $answerset){
		                        if ($answerset != ""){
		                                $nr++;
		                                if ($nr % 2 == 0){
		                                        $astab = $astab . "<tr><td>" . $nr . "</td><td>" . $answerset . "</td></tr>";
		                                }else{
		                                        $astab = $astab . "<tr class=\"odd\"><td>" . $nr . "</td><td>" . $answerset . "</td></tr>";
		                                }
		                        }
		                }
				$tabtag = "table"; # prevent WML from adding the summary attribute
		                if ($nr == 0){
		                        print "<$tabtag><tr><td><font color=\"blue\"><b>None</b><br>(program is inconsistent)</font></td></tr></table>";
		                }else{
		                        print "<$tabtag><tbody>"; #<thead><tr><th width=\"10%\">Number</th><th>Set</th></tr></thead><tbody>";
		                        print $astab;
		                        print "<tbody></table>";
		                }
		        }else{
		                print "<font color=\"red\"><b>Error:</b></font><br><br>";
		                print $answer;
		        }
		}else{
			print "Please click 'Evaluate' to run the reasoner";
		}
        ?>
	</div>
      </div>
      <div class="grid_3">
  <p>&nbsp;</p>
  <p>
    <img width="100%" height="100%" src="images/logo_whitebg.png" alt="logo" id="logo">
  </p>
  <p>
	<div style="font-size: 14pt"><label for="q">Search this website</label></div>
	<form action="http://www.google.com/cse" id="cse-search-box">
	  <div>
	    <input name="cx" id="cx" value="010363983165505105153:4bhl-l5ixd4" type="hidden" alt="Search this website">
	    <input name="ie" id="ie" value="UTF-8" type="hidden" alt="Search this website">
	    <input style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial;" name="q" id="q" size="19" type="text">
	    <input name="sa" id="sa" value="Search" type="submit">
	  </div>
	</form>
  </p>
	<p>
	  <a href="https://github.com/hexhex/">dlvhex source code @ github.com</a><br>
	  <!-- a href="https://sourceforge.net/projects/dlvhex/">dlvhex: Sourceforge project</a><br/ -->
<!-- <a href="http://www.polleres.net/dlvhex-sparql">SPARQL Plugin</a><br> -->
<a href="actionplugin.html">Action Plugin</a><br>
<a href="decisiondiagramsplugin.html">DecisionDiagrams Plugin</a><br>
<a href="dlplugin.html">Description Logics Plugin</a><br>
<a href="dlliteplugin.html">Description Logics Lite Plugin</a><br>
<a href="mergingplugin.html">MELD: Belief Merging Plugin</a><br>
<a href="nestedhexplugin.html">Nested HEX Plugin</a><br>
<a href="http://www.kr.tuwien.ac.at/research/systems/mcsie">MCSIE Plugin</a><br>
<a href="stringplugin.html">String Plugin</a><br>
<a href="https://sourceforge.net/projects/dlvhex-semweb/">dlvhex-semweb Project</a><br>
	  <a href="doap.rdf">Description-Of-A-Project</a>
	</p>
  <p>
    <span style="font-size: 14pt">Documentation:</span><br>
    <a href="https://github.com/hexhex/core/blob/master/README">README</a><br>
    <a href="doc2x">doxygen</a><br>
    <a href="doc2x/group__pluginframework.html">Writing Plugins in C++</a><br>
    <a href="doc2x/group__pythonpluginframework.html">Writing Plugins in Python</a>
    <!--
    <a href="doc1x">doxygen version 1.X</a><br>
    <a href="doc1x/group__pluginframework.html">Writing Plugins 1.X</a><br>
    -->
  </p>
      </div> <!-- grid_3 -->
    </div> <!-- container_12 -->
  </body>
</html>
<!--
        Local Variables:
        mode: xml
        End:
-->
