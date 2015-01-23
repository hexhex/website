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
	<noscript><style> .jsonly { display: none } </style></noscript>
        <script language="Javascript" type="text/javascript" src="demo/edit_area/edit_area_full.js"></script>
	<script type="text/javascript">
		<!--
                function evaluateHEX(){
			var outputdiv=document.getElementById("outputdiv");
			// display loading animation
			var img=document.createElement('img');
			img.src = "demo/dlvhexlogoanimated.gif";
			img.width = 80;
			img.height = 80;
			var centerimg=document.createElement('center');
			centerimg.appendChild(img);
			outputdiv.innerHTML = "<div align=\"center\"><p style=\"font-size:20px\">Processing ...</p></div></br>";
			outputdiv.appendChild(centerimg);
			window.setTimeout(scrollToResults, 0);
			// call reasoner
			window.setTimeout(callReasoner, 0);
                }
                function callReasoner(){
                        // assemble command-line arguments
                        var commandlineoptions = "";
                        if (document.getElementById("optFilter").value != "") commandlineoptions = commandlineoptions + " --filter=" + document.getElementById("optFilter").value;
                        if (document.getElementById("optNumAS").value != "") commandlineoptions = commandlineoptions + " -n=" + document.getElementById("optNumAS").value;
                        if (document.getElementById("optLiberalSafety").checked) commandlineoptions = commandlineoptions + " --liberalsafety";
                        if (document.getElementById("optCustom").value != "") commandlineoptions = commandlineoptions + " " + document.getElementById("optCustom").value;
                        // assemble query
                        var args = "?mode=evalhex";
                        args = args + "&commandlineoptions=" + encodeURIComponent(commandlineoptions);
			if (document.getElementById("useeditarea").checked){
				args = args + "&hexprogram=" + encodeURIComponent(editAreaLoader.getValue("hexprogram"));
				args = args + "&extsource=" + encodeURIComponent(editAreaLoader.getValue("extsource"));
			}else{
		                args = args + "&hexprogram=" + encodeURIComponent(document.getElementById("hexprogram").value);
		                args = args + "&extsource=" + encodeURIComponent(document.getElementById("extsource").value);
			}
                        // send query
                        xmlHttp = new XMLHttpRequest();
                        xmlHttp.open("GET", "demo/evalandformaturl.txt", false);
                        xmlHttp.send(null);
                        evalandformaturl = xmlHttp.responseText;
                        xmlHttp.open("GET", evalandformaturl + args, false);
                        xmlHttp.send(null);
                        answer = xmlHttp.responseText;
                        // write output to page
                        outputdiv.innerHTML = answer;
                        window.setTimeout(scrollToResults, 0);
                }
                function scrollToResults(){
                        document.getElementById("outputdiv").scrollIntoView();
                }
                function loadExample(){
                        example = document.getElementById("cmbExample").value;
                        xmlHttp = new XMLHttpRequest();
                        xmlHttp.open("GET", "demo/examples/" + example + "/program.hex", false);
                        xmlHttp.send(null);
                        if (document.getElementById("useeditarea").checked){
                                editAreaLoader.setValue("hexprogram", xmlHttp.responseText);
                        }else{
                                document.getElementById("hexprogram").value = xmlHttp.responseText;
                        }
                        xmlHttp.open("GET", "demo/examples/" + example + "/plugin.py", false);
                        xmlHttp.send(null);
                        if (document.getElementById("useeditarea").checked){
                                editAreaLoader.setValue("extsource", xmlHttp.responseText);
                        }else{
                                document.getElementById("extsource").value = xmlHttp.responseText;
                        }
                        document.getElementById("cmbExample").value = "";
                }
		// HEX-program loading
                var load_hexprogram = document.createElement('input');
                load_hexprogram.setAttribute('type', 'file');
                load_hexprogram.addEventListener('change', loadHexprogram, false);
		function loadHexprogram(evt) {
			var files = evt.target.files;
			if (files) {
				var r = new FileReader();
				f = files[0];
				r.onload = (function (f) {
					return function (e) {
						editAreaLoader.setValue("hexprogram", e.target.result);
					};
				})(f);
				r.readAsText(f);
				load_hexprogram.value = "";
			}
		}
                function saveHexprogram(id, content){
			a = document.createElement('a');
			document.body.appendChild(a);
			a.download = name;
			a.href = "data:application/octet-stream," + encodeURIComponent(editAreaLoader.getValue("hexprogram"));
			a.download = "program.hex";
			a.click();
                }
		// external source loading
                var load_extsource = document.createElement('input');
                load_extsource.setAttribute('type', 'file');
                load_extsource.addEventListener('change', loadExtsource, false);
		function loadExtsource(evt) {
			var files = evt.target.files;
			if (files) {
				var r = new FileReader();
				f = files[0];
				r.onload = (function (f) {
					return function (e) {
						editAreaLoader.setValue("extsource", e.target.result);
					};
				})(f);
				r.readAsText(f);
				load_extsource.value = "";
			}
		}
                function saveExtsource(id, content){
			a = document.createElement('a');
			document.body.appendChild(a);
			a.download = name;
			a.href = "data:application/octet-stream," + encodeURIComponent(editAreaLoader.getValue("extsource"));
			a.download = "extsource.py";
			a.click();
                }
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
                                                ,toolbar: "load, save, select_font"
                                                ,load_callback: "load_hexprogram.click"
                                                ,save_callback: "saveHexprogram"
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
                                                ,toolbar: "save, load, select_font"
                                                ,load_callback: "loadExtsource"
                                                ,save_callback: "saveExtsource"
						,allow_toggle: false
                                                ,toolbar: "load, save, select_font"
                                                ,load_callback: "load_extsource.click"
                                                ,save_callback: "saveExtsource"
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
		function toggle_visibility(id) {
		        var checkbox = document.getElementById("visible_" + id);
		        checkbox.checked = !checkbox.checked;
		        update_visibility(id);
		}
		function update_visibility(id) {
		        var checkbox = document.getElementById("visible_" + id);
		        var hidebutton = document.getElementById("hide_" + id);
		        var element = document.getElementById(id);
		        if(checkbox.checked){
		                hidebutton.innerHTML = "Hide";
		                element.style.display = 'block';
		        }else{
		                hidebutton.innerHTML = "Show";
		                element.style.display = 'none';
		        }
		}
		-->
        </script>
	<h2>Online Demo</h2>
	<?php
                $hexprogram = $_POST['hexprogram'];
                $extsource = $_POST['extsource'];
		if (isset($_POST['btnLoad'])){
	                $example = trim($_POST['example']);
		}else{
			$example = "";
		}
                if (!isset($_POST['btnEvaluate']) && !isset($_POST['btnLoad'])){
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
                        <div style="text-align:right;">
                                Load example:
                                <?php
                                        $exampleList = "<option name=\"\" value=\"\"></option>";
                                        if ($handle = opendir('demo/examples')) {
                                                while (false !== ($file = readdir($handle))) {
                                                        if ($file != "." && $file != ".."){
                                                                $exname = file_get_contents("demo/examples/" . $file . "/name.txt");
                                                                $exampleList = $exampleList . "<option name=\"example\" value=\"$file\">$exname</option>";
                                                        }
                                                }
                                                closedir($handle);
                                        }
                                ?>
				<noscript>
                                <select name="example">
                                <?php print $exampleList; ?>
                                </select>
				<input type="submit" name="btnLoad" value="Load">
				</noscript>
                                <select class="jsonly" id="cmbExample" onchange="loadExample();">
                                <?php print $exampleList; ?>
                                </select><br>
				<noscript><b>Your browser does not support JavaScript.</b><br>Please enable it to make use of advanced features.</a></noscript>
                                <p class="jsonly"><input type="checkbox" id="useeditarea" name="useeditarea" onclick="updateEditAreas();" <?php echo ((!isset($_POST['btnLoad']) && !isset($_POST['btnEvaluate'])) || isset($_POST['useeditarea'])) ? 'checked' : ''; ?>>Use advanced editor (powered by <a href='http://www.cdolivet.com/editarea' target='_blank'>EditArea</a>)</input></p>
                        </div>
			<input type="checkbox" style="display:none" id="visible_hexprogramdiv" name="visible_hexprogramdiv" <?php echo ((!isset($_POST['btnLoad']) && !isset($_POST['btnEvaluate'])) || isset($_POST['visible_hexprogramdiv'])) ? 'checked' : ''; ?> />
			<input type="checkbox" style="display:none" id="visible_extsourcediv" name="visible_extsourcediv" <?php echo isset($_POST['visible_extsourcediv']) ? 'checked' : ''; ?> />
			<input type="checkbox" style="display:none" id="visible_commandlineoptionsdiv" name="visible_commandlineoptionsdiv" <?php echo isset($_POST['visible_commandlineoptionsdiv']) ? 'checked' : ''; ?> />
<!-- <div style="width:49%;float:left;">-->
			<b>HEX-Program:</b><br><p class="jsonly">[<a id="hide_hexprogramdiv" href="javascript:void(0)" onclick="toggle_visibility('hexprogramdiv'); updateEditArea('hexprogram');">Hide</a>]</p>
			<div id="hexprogramdiv" style="width:100%">
			<textarea id="hexprogram" name="hexprogram" style="width:100%; resize:none;" rows="30"><?php if ($example != ""){print file_get_contents("demo/examples/" . $example . "/program.hex");}else{print $hexprogram;}?></textarea>
			</div>
<!-- </div>-->
<!-- <div style="width:2%;float:left;">&nbsp;</div>-->
<!-- <div style="width:49%;float:left;">-->
			<br><br>
			<b>External Source Definition (Python):</b><br><p class="jsonly">[<a id="hide_extsourcediv" href="javascript:void(0)" onclick="toggle_visibility('extsourcediv'); updateEditArea('extsource');">Hide</a>]</p>
			<div id="extsourcediv" style="width:100%">
			<textarea id="extsource" name="extsource" style="width:100%; resize:none;" rows="30"><?php if ($example != ""){print file_get_contents("demo/examples/" . $example . "/plugin.py");}else{print $extsource;}?></textarea>
			</div>
			<br><br>
			<b>Command-line Options:</b><br><p class="jsonly">[<a id="hide_commandlineoptionsdiv" href="javascript:void(0)" onclick="toggle_visibility('commandlineoptionsdiv');">Hide</a>]</p>
			<div id="commandlineoptionsdiv" style="width:100%">
                        <table id="commandlineoptions" summary="">
                        <tr><td style="white-space: nowrap">Filter predicates (comma-separated):</td><td style="width:1000%"><input type="text" id="optFilter" name="optFilter" style="width:100%" value="<?php echo isset($_POST['optFilter']) ? $_POST['optFilter'] : ''; ?>"></td></tr>
                        <tr><td style="white-space: nowrap">Number of answer sets to compute<br>(empty or 0 means all):</td><td><input type="text" id="optNumAS" name="optNumAS" style="width:100%" value="<?php echo isset($_POST['optNumAS']) ? $_POST['optNumAS'] : ''; ?>"></td></tr>
                        <tr><td style="white-space: nowrap">Liberal safety:</td><td><input type="checkbox" id="optLiberalSafety" name="optLiberalSafety" <?php echo isset($_POST['optLiberalSafety']) ? 'checked' : ''; ?> /></td></tr>
                        <tr><td style="white-space: nowrap">Custom options:</td><td><span><input type="text" id="optCustom" name="optCustom" style="display:table-cell; width:100%" value="<?php echo isset($_POST['optCustom']) ? $_POST['optCustom'] : ''; ?>"></span></td></tr>
                        </table>
			</div>
			<div style="width:100%;text-align:right;">
				<noscript><input type="submit" name="btnEvaluate" value="Evaluate"></noscript>
				<input class="jsonly" type="button" onclick="evaluateHEX();" value="Evaluate">
			</div>
<!-- </div>-->
	     </form>
	</div>
	<h3>Output</h3>
	<div id="outputdiv" style="width:100%;float:right;">
	<?php
		if (isset($_POST['btnEvaluate'])){
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
			$contents = trim(file_get_contents(trim(file_get_contents('demo/evalandformaturl.txt')) . $args));
			print $contents;
		}else{
			print "Please prepare your input and click &#039;Evaluate&#039; to run the reasoner";
		}
        ?>
	</div>
        <script language="Javascript" type="text/javascript">
		<!--
		update_visibility('hexprogramdiv');
		update_visibility('extsourcediv');
		update_visibility('commandlineoptionsdiv');
		updateEditAreas();
		-->
        </script>
      </div>
      <div class="grid_3">
  <p>&nbsp;</p>
  <p>
    <img width="200" height="44" src="images/logo_whitebg.png" alt="logo" id="logo">
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
    <span style="font-size: 14pt">General</span><br>
	  <a href="https://github.com/hexhex/">dlvhex source code @ github.com</a><br>
	  <!-- a href="https://sourceforge.net/projects/dlvhex/">dlvhex: Sourceforge project</a><br/ -->
	  <a href="doap.rdf">Description-Of-A-Project</a>
	</p>
  <p>
    <span style="font-size: 14pt">Popular Plugins</span><br>
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
	</p>
  <p>
    <span style="font-size: 14pt">Documentation</span><br>
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
