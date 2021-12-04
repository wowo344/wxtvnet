
<?php
error_reporting(0);
include ('asset/data.php');
include ('asset/datajx.php');
$url = $_GET['url'];
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: x-requested-with,content-type");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Origin: *");
header("Cache-Control: no-cache, no-store, max-age=0, must-revalidate");
header("Connection: keep-alive");


if ($yzmjx["fdhost_on"] == "on") {
	$urlArr = explode("//", $_SERVER["HTTP_REFERER"])[1];
	$host = explode("/", $urlArr)[0];
	$host = explode(":", $host)[0];
	$fdhost = explode(",", $yzmjx["fdhost"]);
	$localhost = explode(":", $_SERVER["HTTP_HOST"])[0];
	$fdhost[] = $localhost;
	if ($yzmjx["blank_referer"] == "on") {
		$fdhost[] = "";
	}
	if (!in_array($host, $fdhost)) {
		exit("<html><meta name=\"robots\" content=\"noarchive\">\r\n                    \t  <style>h1{color:#FFFFFF; text-align:center; font-family: Microsoft Jhenghei;}p{color:#CCCCCC; font-size: 1.2rem;text-align:center;font-family: Microsoft Jhenghei;}</style>\r\n                    \t  <body bgcolor=\"#000000\"><table width=\"100%\" height=\"100%\" align=\"center\"><td align=\"center\"><h1>" . $yzmjx["referer_wenzi"] . "</font><font size=\"2\"></font></p></table><script src=\"assets/js/jquery.min.js\"></script><script>\$(\"#my-loading\", parent.document).remove();</script></body>\r\n                  </html>");
	}
}
?>