<?php
        header("Content-Type: text/plain");

        # evaluate query
        $contents = file_get_contents(trim(file_get_contents('evalurl.txt')) . "?mode=evalhex" . "&commandlineoptions=" . urlencode($_GET['commandlineoptions']) . "&hexprogram=" . urlencode($_GET['hexprogram']) . "&extsource=" . urlencode($_GET['extsource']));

        # format query
        $answer = explode("\n", $contents);
        $retcode = $answer[0];
        $answer = array_slice($answer, 1);
        print "<b>Command Line:</b><br>";
        print "<tt>shell$ dlvhex2 " . $_GET['commandlineoptions'] . " --pythonplugin=extsource.py program.hex</tt>";
        print "<br>";
        print "where <tt>program.hex</tt> and <tt>extsource.py</tt> refer to the program and plugin entered above, respectively";
        print "<br><br>";
	if ($retcode == "") {
                print "<font color=\"red\"><b>Error:</b></font><br>";
                print "Reasoning server unreachable<br>";
        }else if ($retcode == 0) {
                print "<b>Answer Sets:</b>";
                $astab = "";
                $ret = shell_exec("echo -e \"$answer\"");
                $nr = 0;
                foreach ($answer as $answerset){
                        if ($answerset != ""){
                                $nr++;
                                if ($nr % 2 == 0){
                                        $astab = $astab . "<tr><td width=\"10%\">" . $nr . "</td><td>" . str_replace(",", ",<wbr>", $answerset) . "</td></tr>";
                                }else{
                                        $astab = $astab . "<tr class=\"odd\"><td width=\"10%\">" . $nr . "</td><td>" . str_replace(",", ",<wbr>", $answerset) . "</td></tr>";
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
?>
