<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="index.css">
<title>
Отчитане на плащане
</title>
</head>
<body>
<h1 align='center'>Отчиране на вноска</h1><br/>
<p align='center'>Моля въведете коректни стойности</p><br/>
<p>Отбележете информацията за платеца</p><br/>
<form method='get' action='reportiong.php'>
<table width='100%'>
<tr>
<td width='50%'>Обитаващ<input type='radio' value='live' name='type_payer'>:<br/></td>
<td width='50%'>Пълно плащане<input type='radio' value='full_pay' name='full_or_half'>:<br/></td>
</tr>
<tr>
<td width='50%'>Не обитаващ<input type='radio' value='nolive' name='type_payer'>:<br/></td>
<td width='50%'>Непълно плащане<input type='radio' value='half_pay' name='full_or_half'>:<br/></td>
</tr>
</table>
</form>
<table class='tableBorder' width='100%'>
<form method='get' action='reporting.php'>
<tr>
<th class='form_width_td'><nobr>За месец</nobr></th>
<th class='form_width_td'><nobr>Дата</nobr></th>
<th class='form_width_td'><nobr>Смет</nobr></th>
<th class='form_width_td'><nobr>Зелени площи</nobr></th>
</tr>
<tr>
<td><input type='text' name='for_month' /></td>
<td><input type='text' name='pay_date'/></td>
<td><select name='rubb'>
<option value='0'>0лв.</option>
<option value='5'>5лв.</option>
<option value='2.50'>2.50лв.</option>
</select></td>
<td><select name='grarea'>
<option value='0'>0лв.</option>
<option value='15'>15лв.</option>
<option value='7.50'>7.50лв.</option>
</select></td>
<?php
/*
if (empty($_POST["type_payer"]) && empty($_POST["full_or_half"])) {
	printf("<td><select name='rubb'>\n
		<option value='0'>0лв.</option>\n
		<option value='5'>5лв.</option>\n
		<option value='2.50'>2.50лв.</option>\n
		</select></td>\n
		<td><select name='grarea'>\n
		<option value='0'>0лв.</option>\n
		<option value='15'>15лв.</option>\n
		<option value='7.50'>7.50лв.</option>\n
		</select></td>\n");
}
else {
	if ($_POST["type_payer"]=="live") {
	       if ($_POST["full_or_half"]=="full_pay") {
		       printf("<td name='rubb' value='5'>5лв.</td>\n
			       <td name='grarea' value='15'>15лв.</td>\n");
	       }
	       if ($_POST["full_or_half"]=="half_pay") {
		       printf("<td name='rubb' value='2.50'>2.50лв.</td>\n
			       <td name='grarea' value='7.50'>7.50лв.</td>\n");
	       }
	}
	if ($_POST["type_payer"]=="nolive") {
	       if ($_POST["full_or_half"]=="full_pay") {
		       printf("<td name='rubb' value='2.50'>2.50лв.</td>\n
			       <td name='grarea' value='7.50'>7.50лв.</td>\n");
	       }
	       if ($_POST["full_or_half"]=="half_pay") {
		       printf("<td name='rubb' value='1.25'>1.25лв.</td>\n
			       <td name='grarea' value='3.75'>3.75лв.</td>\n");
	       }
	}
}
 */
?>

</tr>
<tr>
<th class='form_width_td'><nobr>Домоупр.</nobr></th>
<th class='form_width_td'><nobr>Почист. улици</nobr></th>
<th class='form_width_td'><nobr>Фонд</nobr></th>
<th class='form_width_td'><nobr>Пояснение</nobr></th>
</tr>
<tr>
<td><select name='hmman'>
	<option value='0'>0лв.</option>
	<option value='5'>5лв.</option>
	<option value='2.50'>2.50лв.</option>
</select></td>
<td><select name='clstreet'>
	<option value='0'>0лв.</option>
	<option value='5'>5лв.</option>
	<option value='2.50'>2.50лв.</option>
</select></td>
<td><select name='fund'>
	<option value='0'>0лв.</option>
	<option value='20'>20лв.</option>
	<option value='10'>10лв.</option>
</select></td>
<td><input type='text' name='expl'/></td>
</tr>
</table>
<input type="submit" value="Submit"/>
</form>
<?php
require 'dbinfo.php';
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
while ($array_id_house=mysql_fetch_array($sql_res_house_id, MYSQL_ASSOC)) {
	if ($array_id_house['explanation']==$_GET["expl"]) {
		$id_house_new_row=$array_id_house['ID'];
		break;
	}
}
printf("\n<br/>$_GET[for_month]   $_GET[pay_date]   $_GET[rubb]   $_GET[grarea]   $_GET[hmman]   $_GET[clstreet]    $_GET[fund]     $_GET[expl]    $id_house_new_row  ");
$sql="INSERT INTO accountancy (month, on_date, rubbish, greenarea, homemanager, cleanstreets, fund, explanation, id_house) VALUES ($_GET[pay_date], $_GET[pay_date], $_GET[rubb], $_GET[grarea], $_GET[hmman], $_GET[clstreet], $_GET[fund], $_GET[expl], $id_house_new_row);";
mysql_query($sql);
mysql_close($connect);
?>
</body>
</html>
