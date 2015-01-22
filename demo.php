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
        <script language="Javascript" type="text/javascript" src="demo/edit_area/edit_area_full.js"></script>
	<script type="text/javascript">
	<!--
        function toggle_visibility(id) {
                var checkbox=document.getElementById("visible_" + id);
                checkbox.checked = !checkbox.checked;
                update_visibility(id);
        }
        function update_visibility(id) {
                var checkbox=document.getElementById("visible_" + id);
                var hidebutton=document.getElementById("hide_" + id);
                var element=document.getElementById(id);
                if(checkbox.checked){
                        hidebutton.innerHTML = "Hide";
                        element.style.display = 'block';
                }else{
                        hidebutton.innerHTML = "Show";
                        element.style.display = 'none';
                }
        }
	//-->
	</script>
	<h2>Online Demo</h2>
	<?php
                $hexprogram = $_POST['hexprogram'];
                $extsource = $_POST['extsource'];
                $example = trim($_POST['example']);
                if (!isset($_POST['formsubmitted'])){
                        $example = "Tutorial";
                }
	?>
	<!--<img width="30%" src="images/dlvhexlogo.png" alt=""><br>-->
	<p>This <b>online demo of the dlvhex system</b> allows for
	evaluating programs without local installation.
	This is intended mainly for testing and learning purposes.
	External sources for the program at the top may be directly implemented in a Python script below.</p>
	<p>Please check out the predefined <b>examples at the upper right corner</b> for a quick overview or consider the <b>links to the system documentation in the right-hand menu</b> for a more detailed description.</p>
	<div style="text-align:right;">(The online demo currently runs <i><?php
			print trim(file_get_contents(trim(file_get_contents('demo/evalurl.txt')) . "?mode=getversion"));
		?></i>)
	</div>
	<br>
        <div style="width:100%;">
		<h3>Input</h3>
		<form method="post" action="demo.php">
			<input type="checkbox" style="display:none" checked name="formsubmitted">
			<div style="text-align:right;">
				Load example:
				<select name="example" onchange="this.form.submit()">
				<?php
					print "<option name=\"\" value=\"\"></option>";
					if ($handle = opendir('demo/examples')) {
						while (false !== ($file = readdir($handle))) {
							if ($file != "." && $file != ".."){
								$exname = file_get_contents("demo/examples/" . $file . "/name.txt");
								print "<option name=\"example\" value=\"$file\">$exname</option>";
							}
						}
						closedir($handle);
					}
				?>
				</select><br>
                                <input type="checkbox" id="useeditarea" name="useeditarea" onclick="updateEditAreas();" <?php echo (!isset($_POST['formsubmitted']) || isset($_POST['useeditarea'])) ? 'checked' : ''; ?>>Use advanced editor (powered by <a href="http://www.cdolivet.com/editarea" target="_blank">EditArea</a>)</input>
			</div>
			<input type="checkbox" style="display:none" id="visible_hexprogramdiv" name="visible_hexprogramdiv" <?php echo (!isset($_POST['formsubmitted']) || isset($_POST['visible_hexprogramdiv'])) ? 'checked' : ''; ?> />
			<input type="checkbox" style="display:none" id="visible_extsourcediv" name="visible_extsourcediv" <?php echo isset($_POST['visible_extsourcediv']) ? 'checked' : ''; ?> />
			<input type="checkbox" style="display:none" id="visible_commandlineoptionsdiv" name="visible_commandlineoptionsdiv" <?php echo isset($_POST['visible_commandlineoptionsdiv']) ? 'checked' : ''; ?> />
<!-- <div style="width:49%;float:left;">-->
			<b>HEX-Program:</b><br>[<a id="hide_hexprogramdiv" href="javascript:void(0)" onclick="toggle_visibility('hexprogramdiv'); updateEditArea('hexprogram');">Hide</a>]</br>
			<div id="hexprogramdiv" style="width:100%">
			<textarea id="hexprogram" name="hexprogram" style="width:100%; resize:none;" rows="30"><?php if ($example != ""){print file_get_contents("demo/examples/" . $example . "/program.hex");}else{print $hexprogram;}?></textarea>
			</div>
<!-- </div>-->
<!-- <div style="width:2%;float:left;">&nbsp;</div>-->
<!-- <div style="width:49%;float:left;">-->
			<br><br>
			<b>External Source Definition (Python):</b><br>[<a id="hide_extsourcediv" href="javascript:void(0)" onclick="toggle_visibility('extsourcediv'); updateEditArea('extsource');">Hide</a>]</br>
			<div id="extsourcediv" style="width:100%">
			<textarea id="extsource" name="extsource" style="width:100%; resize:none;" rows="30"><?php if ($example != ""){print file_get_contents("demo/examples/" . $example . "/plugin.py");}else{print $extsource;}?></textarea>
			</div>
			<br><br>
			<b>Command-line Options:</b><br>[<a id="hide_commandlineoptionsdiv" href="javascript:void(0)" onclick="toggle_visibility('commandlineoptionsdiv');">Hide</a>]</br>
			<div id="commandlineoptionsdiv" style="width:100%">
                        <table id="commandlineoptions" summary="">
                        <tr><td style="white-space: nowrap">Filter predicates (comma-separated):</td><td style="width:1000%"><input type="text" name="optFilter" style="width:100%" value="<?php echo isset($_POST['optFilter']) ? $_POST['optFilter'] : ''; ?>"></td></tr>
                        <tr><td style="white-space: nowrap">Number of answer sets to compute<br>(empty or 0 means all):</td><td><input type="text" name="optNumAS" style="width:100%" value="<?php echo isset($_POST['optNumAS']) ? $_POST['optNumAS'] : ''; ?>"></td></tr>
                        <tr><td style="white-space: nowrap">Liberal safety:</td><td><input type="checkbox" name="optLiberalSafety" <?php echo isset($_POST['optLiberalSafety']) ? 'checked' : ''; ?> /></td></tr>
                        <tr><td style="white-space: nowrap">Custom options:</td><td><span><input type="text" name="optCustom" style="display:table-cell; width:100%" value="<?php echo isset($_POST['optCustom']) ? $_POST['optCustom'] : ''; ?>"></span></td></tr>
                        </table>
			</div>
			<div style="width:100%;text-align:right;"><input type="submit" value="Evaluate"></div>
<!-- </div>-->
	     </form>
	</div>
	<h3>Output</h3>
	<div style="width:100%;float:right;">
	<?php
		if (isset($_POST['formsubmitted']) && ($_POST['example'] == "")){
                        function endsWith($haystack, $needle) {
                                return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
                        }
                        $commandlineoptions = "";
                        if ($_POST['optFilter'] != "") { $commandlineoptions = $commandlineoptions . " --filter=" . $_POST['optFilter']; };
                        if ($_POST['optNumAS'] != "") { $commandlineoptions = $commandlineoptions . " -n=" . $_POST['optNumAS']; };
                        if ($_POST['optLiberalSafety']) { $commandlineoptions = "--liberalsafety"; }
                        if ($_POST['optCustom'] != "") { $commandlineoptions = $commandlineoptions . " " . $_POST['optCustom']; };
			$args = "?mode=evalhex" .
				"&commandlineoptions=" . urlencode($commandlineoptions) .
				"&hexprogram=" . urlencode($hexprogram) .
				"&extsource=" . urlencode($extsource);
			$contents = trim(file_get_contents(trim(file_get_contents('demo/evalurl.txt')) . $args));
			$answer = explode("\n", $contents);
			$retcode = $answer[0];
			$answer = array_slice($answer, 1);
                        print "<b>Command Line:</b><br>";
                        print "<tt>shell$ dlv $commandlineoptions program.hex</tt>";
                        print "<br>";
                        print "where <tt>program.hex</tt> and <tt>extsource.py</tt> refer to the program and plugin entered above, respectively";
                        print "<br><br>";
                        if ($retcode == 0) {
                                print "<b>Answer Sets:</b>";
                                $astab = "";
                                $ret = shell_exec("echo -e \"$answer\"");
                                $nr = 0;
                                foreach ($answer as $answerset){
                                        if ($answerset != ""){
                                                $nr++;
                                                if ($nr % 2 == 0){
                                                        $astab = $astab . "<tr><td width=\"10%\">" . $nr . "</td><td>" . $answerset . "</td></tr>";
                                                }else{
                                                        $astab = $astab . "<tr class=\"odd\"><td width=\"10%\">" . $nr . "</td><td>" . $answerset . "</td></tr>";
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
                        }else if ($retcode == 137){
                                print "<font color=\"red\"><b>Timeout due to limited resources of the demo server, please simplify your program or install the system locally</b></font><br>";
                        }else{
                                print "<font color=\"red\"><b>Error:</b></font><br>";
                                foreach ($answer as $line){
                                        print $line . "<br>";
                                }
                        }
		}else{
			print "Please click 'Evaluate' to run the reasoner";
		}
        ?>
	</div>
        <script language="Javascript" type="text/javascript">
		function updateEditAreas(){
			updateEditArea('hexprogram');
			updateEditArea('extsource');
		}
		function updateEditArea(id){
			if (document.getElementById("useeditarea").checked){
				if (id == "hexprogram"){
					editAreaLoader.init({
						id: "hexprogram" // id of the textarea to transform
						,start_highlight: true // if start with highlight
						,allow_resize: "no"
						,word_wrap: true
						,language: "en"
						,syntax: "hex"
						,allow_toggle: false
					});
				}
				if (id == "extsource"){
					editAreaLoader.init({
						id: "extsource" // id of the textarea to transform
						,start_highlight: true // if start with highlight
						,allow_resize: "no"
						,word_wrap: true
						,language: "en"
						,syntax: "python"
						,allow_toggle: false
					});
				}
			}else{
				if (id == "hexprogram"){
					editAreaLoader.delete_instance("hexprogram");
				}
				if (id == "extsource"){
					editAreaLoader.delete_instance("extsource");
				}
			}
		}
		update_visibility('hexprogramdiv');
		update_visibility('extsourcediv');
		update_visibility('commandlineoptionsdiv');
		updateEditAreas();
        </script>
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
