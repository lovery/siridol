<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset = UTF-8">
<link rel="stylesheet" type="text/css" href="index.css">
<title>
Счетоводство на комплекса
</title>
</head>

<body bgcolor="#EEEEEE">
<?php
require 'dbinfo.php';
require 'index_php_function.php';
require 'index_sort_GET.php';

$connect = mysql_connect($db_host, $db_user, $db_pass);
if (!$connect) {
	die("mysql_connect: ".mysql_error()."<br/>");
}

if (!mysql_set_charset('utf8')) {
	die("mysql_set_charset: ".mysql_error()."<br/>");
}

$result = mysql_select_db($db_name);
if (!$result) {
	die("mysql_select_db: ".mysql_error()."<br/>");
}

date_default_timezone_set('Europe/Helsinki');

if ($_GET["sort"] == 1) {
	$month_for_pay = new DateTime('2010-07');
	$month_for_pay_str = $month_for_pay->format('Y.m');
	while (strcmp($month_for_pay_str, date('Y.m')) <= 0) {
		$sql_select_by_month = "select * from accountancy where Month = str_to_date('".$month_for_pay_str.".00', '%Y.%m.%d')";
		$sql_full_join = "(select * from (".$sql_select_by_month.") as acc1 left join Id_house on acc1.id_house = Id_house.id_h 
			union select * from (".$sql_select_by_month.") as acc2 right join Id_house on acc2.id_house = Id_house.id_h) as full_table";
		$final_sql = "SELECT date_format(Month, '%Y.%m') as month, date_format(on_date, '%Y.%m.%d') as data, Rubbish, Greenarea, homemanager, cleanstreets, fund, case Rubbish is NULL when true then 0 else Rubbish+Greenarea+homemanager+cleanstreets+fund end as total, explanation, id_house, payer_name from ".$sql_full_join.$sqlpl.";";
		$sql_result = mysql_query($final_sql);
		if (!$sql_result) {
			die("mysql_query: ".mysql_error()."<br/>");
		}
		print_main_table($sql_result, $month_for_pay_str, $name_img);
		$month_for_pay->add(new DateInterval('P1M'));
		$month_for_pay_str = $month_for_pay->format('Y.m');
	}
}
else {
	$sql = "SELECT date_format(Month, '%Y.%m') as month, date_format(on_date, '%Y.%m.%d') as data, Rubbish, Greenarea, homemanager, cleanstreets, fund, Rubbish+Greenarea+homemanager+cleanstreets+fund as total, explanation, id_house from accountancy".$sqlpl;
	$sql_result = mysql_query($sql);
	if (!$sql_result) {
		die("mysql_query: ".mysql_error()."<br/>");
	}
	while ($array = mysql_fetch_array($sql_result, MYSQL_ASSOC)) {
		print_array_tr($array);
	}
}

$total_sql = mysql_query("SELECT trub, tgreen, thome, tclean, tfund, trub+tgreen+thome+tclean+tfund as total from (select sum(Rubbish) as trub, sum(Greenarea) as tgreen, sum(homemanager) as thome, sum(cleanstreets) as tclean, sum(fund) as tfund from accountancy) as tab");
if (!$total_sql) {
	die( "mysql_query: ".mysql_error()."<br/>");
}

$total = mysql_fetch_array($total_sql, MYSQL_ASSOC);
printf("<tr align='right'>
	<th>&nbsp;</th>
	<th>Общо:</th>
	<th>$total[trub]</th>
	<th>$total[tgreen]</th>
	<th>$total[thome]</th>
	<th>$total[tclean]</th>
	<th>$total[tfund]</th>
	<th>$total[total]</th>
	<th>&nbsp;</th>
	</tr>\n");
printf("</table>\n");

if (!mysql_close($connect)) {
	die("There is a problem with closing the connection<br/>");
}
?>
</body>
</html>
