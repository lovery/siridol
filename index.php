<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="index.css">
<title>
Счетоводство на комплекса
</title>
</head>

<body bgcolor="#EEEEEE">
<?php

require 'dbinfo.php';

function print_html_num_td($num) {
	if ($num<0) {
		printf("<td class=tdNegative>");
	}
	else {
		printf("<td class=tdNONegative>");
	}
	printf("$num</td>\n");
}

$connect=mysql_connect($db_host, $db_user, $db_pass);
if (!$connect) {
	die("mysql_connect: ".mysql_error()."<br/>");
}

$result=mysql_select_db($db_name);
if (!$result) {
	die("mysql_select_db: ".mysql_error()."<br/>");
}

for ($i=0; $i<9; $i++) {
	$name_img[$i][0]="down_arrow_origin.png";
	$name_img[$i][1]="up_arrow_origin.png";
}

switch ($_GET["sort"]) {
case 1:
	if ($_GET["type"]=="asc") {
		$sqlpl=" order by Month, on_date";
		$name_img[0][0]="down_arrow.png";
	}
	else {
		$sqlpl=" order by Month DESC, on_date";
		$name_img[0][1]="up_arrow.png";
	}
	break;
case 2:
	if ($_GET["type"]=="asc") {
		$sqlpl=" order by on_date, Month";
		$name_img[1][0]="down_arrow.png";
	}
	else {
		$sqlpl=" order by on_date DESC, Month";
		$name_img[1][1]="up_arrow.png";
	}
	break;
case 3:
	if ($_GET["type"]=="asc") {
		$sqlpl=" order by Rubbish, Month, on_date";
		$name_img[2][0]="down_arrow.png";
	}
	else {
		$sqlpl=" order by Rubbish DESC, Month, on_date";
		$name_img[2][1]="up_arrow.png";
	}
	break;
case 4:
	if ($_GET["type"]=="asc") {
		$sqlpl=" order by Greenarea, Month, on_date";
		$name_img[3][0]="down_arrow.png";
	}
	else {
		$sqlpl=" order by Greenarea DESC, Month, on_date";
		$name_img[3][1]="up_arrow.png";
	}
	break;
case 5:
	if ($_GET["type"]=="asc") {
		$sqlpl=" order by homemanager, Month, on_date";
		$name_img[4][0]="down_arrow.png";
	}
	else {
		$sqlpl=" order by homemanager DESC, Month, on_date";
		$name_img[4][1]="up_arrow.png";
	}
	break;
case 6:
	if ($_GET["type"]=="asc") {
		$sqlpl=" order by cleanstreets, Month, on_date";
		$name_img[5][0]="down_arrow.png";
	}
	else {
		$sqlpl=" order by cleanstreets DESC, Month, on_date";
		$name_img[5][1]="up_arrow.png";
	}
	break;
case 7:
	if ($_GET["type"]=="asc") {
		$sqlpl=" order by fund, Month, on_date";
		$name_img[6][0]="down_arrow.png";
	}
	else {
		$sqlpl=" order by fund DESC, Month, on_date";
		$name_img[6][1]="up_arrow.png";
	}
	break;
case 8:
	if ($_GET["type"]=="asc") {
		$sqlpl=" order by Rubbish+Greenarea+homemanager+cleanstreets+fund,
		       Month, on_date";
		$name_img[7][0]="down_arrow.png";
	}
	else {
		$sqlpl=" order by Rubbish+Greenarea+homemanager+cleanstreets+fund DESC,
			Month, on_date";
		$name_img[7][1]="up_arrow.png";
	}
	break;
case 9:
	if ($_GET["type"]=="asc") {
		$sqlpl=" order by explanation, Month, on_date";
		$name_img[8][0]="down_arrow.png";
	}
	else {
		$sqlpl=" order by explanation DESC, Month, on_date";
		$name_img[8][1]="up_arrow.png";
	}
	break;
};

printf("<table class='tableBorder'>\n");
printf("<tr>
	<th class='width_td'><nobr>За месец<a href=?sort=1&type=asc><img
	src=".$name_img[0][0]." /></a><a href=?sort=1&type=desc><img
	src=".$name_img[0][1]." /></a></nobr></th>
	<th class='width_td'><nobr>Дата<a href=?sort=2&type=asc><img
	src=".$name_img[1][0]." /></a><a href=?sort=2&type=desc><img
	src=".$name_img[1][1]." /></a></nobr></th>
	<th class='width_td'><nobr>Смет<a href=?sort=3&type=asc><img
	src=".$name_img[2][0]." /></a><a href=?sort=3&type=desc><img
	src=".$name_img[2][1]." /></a><nobr></th>
	<th class='width_td'>Зелени <nobr>площи<a href=?sort=4&type=asc><img
	src=".$name_img[3][0]." /></a><a href=?sort=4&type=desc><img
	src=".$name_img[3][1]." /></a></nobr></th>
	<th class='width_td'><nobr>Домоупр.<a href=?sort=5&type=asc><img
	src=".$name_img[4][0]." /></a><a href=?sort=5&type=desc><img
	src=".$name_img[4][1]." /></a></nobr></th>
	<th class='width_td'>Почист. <nobr>улици<a href=?sort=6&type=asc><img
	src=".$name_img[5][0]." /></a><a href=?sort=6&type=desc><img
	src=".$name_img[5][1]." /></a></nobr></th>
	<th class='width_td'><nobr>Фонд<a href=?sort=7&type=asc><img
	src=".$name_img[6][0]." /></a><a href=?sort=7&type=desc><img
	src=".$name_img[6][1]." /></a></nobr></th>
	<th class='width_td'><nobr>Общо<a href=?sort=8&type=asc><img
	src=".$name_img[7][0]." /></a><a href=?sort=8&type=desc><img
	src=".$name_img[7][1]." /></a></nobr></th>
	<th><nobr>Пояснение<a href=?sort=9&type=asc><img
	src=".$name_img[8][0]." /></a><a href=?sort=9&type=desc><img
	src=".$name_img[8][1]." /></a></nobr></th>
	</tr>");

$sql="SELECT date_format(Month, '%Y.%m') as month, date_format(on_date, '%Y.%m.%d') as data,
	Rubbish, Greenarea, homemanager, cleanstreets, fund,
	Rubbish+Greenarea+homemanager+cleanstreets+fund as total, explanation from accountancy".$sqlpl;
$sql_result=mysql_query($sql);
if (!$sql_result) {
	die("mysql_query: ".mysql_error()."<br/>");
}

$is_date='ne e data';
while ($array=mysql_fetch_array($sql_result, MYSQL_ASSOC)) {
	if ($is_date!=$array[month] & $_GET["sort"]=="1" & $is_date!='ne e data') {
		printf("<tr>\n");
		printf("<td class='nonegative' colspan=2>Общо за месец ".$is_date."</td>\n");
		print_html_num_td($is_rub);
		print_html_num_td($is_green);
		print_html_num_td($is_home);
		print_html_num_td($is_clean);
		print_html_num_td($is_fund);
		print_html_num_td($is_total);
		printf("<td>&nbsp;</td>\n");
		printf("</tr>\n");
		$is_rub=$is_green=$is_home=$is_clean=$is_fund=$is_total=0;
	}
	printf("<tr>\n");
	printf("<td>$array[month]</td>\n");
	printf("<td>$array[data]</td>\n");
	print_html_num_td($array[Rubbish]);
	$is_rub+=$array[Rubbish];
	print_html_num_td($array[Greenarea]);
	$is_green+=$array[Greenarea];
	print_html_num_td($array[homemanager]);
	$is_home+=$array[homemanager];
	print_html_num_td($array[cleanstreets]);
	$is_clean+=$array[cleanstreets];
	print_html_num_td($array[fund]);
	$is_fund+=$array[fund];
	print_html_num_td($array[total]);
	$is_total+=$array[total];
	printf("<td><nobr>$array[explanation]</nobr></td>\n");
	printf("</tr>\n");
	$is_date=$array[month];
}

$total_sql=mysql_query("select trub, tgreen, thome, tclean, tfund,
	trub+tgreen+thome+tclean+tfund as total from (select sum(Rubbish) as trub,
	sum(Greenarea) as tgreen, sum(homemanager) as thome, sum(cleanstreets) as tclean,
	sum(fund) as tfund from accountancy) as tab");
if (!$total_sql) {
	die( "mysql_query: ".mysql_error()."<br/>");
}

if ($_GET["insert"]=="5") {
	printf("<tr><form>
		<td><input type='text' size=7 name='month'/></td>
		<td><input type='text' size=10 name='data_come'/></td>
		<td><input type='text' size=8 name='rub'/></td>
		<td><input type='text' size=8 name='area'/></td>
		<td><input type='text' size=8 name='hman'/></td>
		<td><input type='text' size=8 name='clean'/></td>
		<td><input type='text' size=8 name='fund'/></td>
		<td>&nbsp;</td>
		<td><input type='text' size=30 name='explan'/></td>
		</form></tr>");
}

$total=mysql_fetch_array($total_sql, MYSQL_ASSOC);
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
printf("<form onclick=?insert=5 method='get'><input type='submit' name='insert' value='Добавяне'/></form>\n");

if (!mysql_close($connect)) {
	die("There is a problem with closing the connection<br/>");
}
?>
</body>
</html>
<!-- vim: set encoding=utf8: -->
