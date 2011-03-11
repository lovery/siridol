<html>
<head>
</head>
<body>
<?php

require './Boqna/dbinfo.php';

$connect=mysql_connect($db_host, $db_user, $db_pass);
if (!$connect) {
	        die("mysql_connect: ".mysql_error()."<br/>");
}

if (!mysql_set_charset('utf8')) {
	        die("mysql_set_charset: ".mysql_error()."<br/>");
}

$result=mysql_select_db($db_name);
if (!$result) {
	        die("mysql_select_db: ".mysql_error()."<br/>");
}

$sql_house_id="SELECT ID, date_format(Month, '%Y.%m') as month, explanation  FROM Id_house;";

$sql_res_house_id=mysql_query($sql_house_id);

if (!$sql_res_house_id) {
	        die("mysql_query: ".mysql_error()."<br/>");
}

while ($array_id_house[]=mysql_fetch_array($sql_res_house_id, MYSQL_ASSOC)) {
	$sql_tmp="UPDATE `accountancy2` SET id_house=".$array_id_house['ID']." where explanation >= \"".$array_id_house['explanation']."\";";
	if (mysql_query($sql_tmp)) {
	        die("mysql_query: ".mysql_error()."<br/>");
	}
}
/*
if (!mysql_query("UPDATE `accountancy2` SET id_house=NULL where explanation > \"".$array_id_house['explanation']."\";")) {
	die("mysql_query: ".mysql_error()."<br/>");
}
 */

if (!mysql_close($connect)) {
	        die("There is a problem with closing the connection<br/>");
}

?>
</body>
</html>
