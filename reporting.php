<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="index.css">
<script type="text/javascript">
function set_name_expl() {
	if (document.getElementById('expltmp_uniq_id').value!="") {
		document.getElementById('expl_uniq_id').value = document.getElementById('expltmp_uniq_id').value +
		(document.getElementById('noliving_uniq_id').checked ? ", не обитава" : "") +
		(document.getElementById('nofullpayer_uniq_id').checked ? ", непълно плащане" : "");
	}
	else {
		document.getElementById('expl_uniq_id').value = document.getElementById('expltmp_uniq_id').value;
	}
}
</script>
<title>
Отчитане на плащане
</title>
</head>
<body>
<h1 align='center'>Отчитане на плащане</h1><br/>
<table class='tableBorder' width='100%'>
<form method='get' action='reporting.php'>
<tr>
<th class='form_width_td'><nobr>За месец</nobr></th>
<td><input type='text' size='9' name='for_month' value=
	'<?php
	print(date("Y.m")); 
	?>'
/></td>
</tr>
<tr>
<th class='form_width_td'><nobr>Дата</nobr></th>
<td><input type='text' size='9' name='pay_date' value=
	'<?php
	print(date("Y.m.d")); 
	?>'
/></td>
</tr>
<tr>
<th class='form_width_td'><nobr>Смет</nobr></th>
<td><input class='input_num' type='text' name='rubb' size='9' value='5'/>лв.</td>
</tr>
<tr>
<th class='form_width_td'><nobr>Зелени площи</nobr></th>
<td><input class='input_num' type='text' name='grarea' size='9' value='15'/>лв.</td>
</tr>
<tr>
<th class='form_width_td'><nobr>Домоупр.</nobr></th>
<td><input class='input_num' type='text' name='hmman' size='9'  value='5'/>лв.</td>
</tr>
<tr>
<th class='form_width_td'><nobr>Почист. улици</nobr></th>
<td><input class='input_num' type='text' name='clstreet' size='9' value='5'/>лв.</td>
</tr>
<tr>
<th class='form_width_td'><nobr>Фонд</nobr></th>
<td><input class='input_num' type='text' name='fund' size='9' value='20'/>лв.</td>
</tr>
<tr>
<th class='form_width_td'><nobr>Пояснение</nobr></th>
<td>
<select id='expltmp_uniq_id' name='expltmp' onchange='set_name_expl()'>
	<option value=''></option>
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
		$sql_house_id="SELECT ID, explanation FROM Id_house ORDER BY explanation";
		$sql_res_house_id=mysql_query($sql_house_id);
		if (!$sql_res_house_id) {
			die("mysql_query: ".mysql_error()."\n");
		}
		while ($array_id_house=mysql_fetch_array($sql_res_house_id, MYSQL_ASSOC)) {
			print("<option value='$array_id_house[explanation]'>$array_id_house[explanation]</option>\n");
		}
		if (!mysql_close($connect)) {
			die("There is a problem with closing the connection\n");
		}
	?>
	</select>
<div>
<input type='checkbox' id='noliving_uniq_id' name='noliving' onchange='set_name_expl()'/>Не обитава
</div>
<div>
<input type='checkbox' id='nofullpayer_uniq_id' name='nofullpayer' onchange='set_name_expl()'/>Непълно плащане
</div>
<input type='text' size='50'id='expl_uniq_id' name='expl'/>
</td>
</tr>
</table>
<input type="submit" value="Submit"/>
</form>
<?php
require 'dbinfo.php';
$dbh=new PDO('mysql:host=localhost;dbname=test', $db_user, $db_pass);

$dbh->exec("SET CHARACTER SET utf8");

$dbh->beginTransaction();

$dbh->exec("SELECT ID,explanation  FROM Id_house;");
$sql_res_house_id=mysql_query($sql_house_id);
if (!$sql_res_house_id) {
	        die("mysql_query: ".mysql_error()."<br/>");
}
$new_explanation=$_GET["expl"];
while ($array_id_house=mysql_fetch_array($sql_res_house_id, MYSQL_ASSOC)) {
	if (strpos($_GET["expl"], $array_id_house['explanation'])!=false) {
		$id_house_new_row=$array_id_house['ID'];
		break;
	}
}
$sql="INSERT INTO accountancy ($_GET[for_month]   $_GET[pay_date]   $_GET[rubb]   $_GET[grarea]   $_GET[hmman]   $_GET[clstreet]    $_GET[fund]     $_GET[expl]    $id_house_new_row  )";
$sql="INSERT INTO accountancy (month, on_date, rubbish, greenarea, homemanager, cleanstreets, fund, explanation, id_house) VALUES ($_GET[pay_date], $_GET[pay_date], $_GET[rubb], $_GET[grarea], $_GET[hmman], $_GET[clstreet], $_GET[fund], $new_explanation, $id_house_new_row);";
mysql_close($connect);
?>
</body>
</html>
