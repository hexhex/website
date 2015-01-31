In order to install the demo, edit the following files:

  evalurl.txt:            complete URL to eval.php on your webserver (including http://www.)
  evalandformaturl.txt:   complete URL to evalandformat.php on your webserver (including http://www.)

You may also edit the following files to customize the dlvhex2 call:

  getversion.sh:          command to execute in order to retrieve the reasoner version
  reasonercall.sh:        command to execute in order to call the reasoner (HEX-program will be sent via stdin, plugin via option --pythonplugin=)


If dlvhex2 does not directly run on your webserver, you may forward the call to another server by adding the URL of the actual reasoning server
to fwdurl.txt and substituting eval_fwd.php for eval.php. The reasoning  server must also run a HTTP server with php support and host a copy of
the demo directory; the URL in fwdurl.txt on your main webserver must point to the demo/eval.php file on your reasoning server.
The commands in getversion.sh and reasonercall.sh are then executed on the reasoning server rather than the main webserver.
