<html>
<head>
<meta http-equiv='accounting' charset='UTF-8'/>
<link rel="stylesheet" type="text/css" href="boqna-accountancy.css">
<title>
Счетоводство на комплекса
</title>
</head>
<body>
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#CCCCCC">
<tr>
<td>
<?php
$connect=mysql_connect('localhost', 'root', 'happypass');
if (!$connect) {
        die ('There is a problem with connect to the MySQL Server<br/>');
}   

$result=mysql_select_db('test');
if (!$result) {
    echo 'There is a problem with loading the database<br/>';
}

$sql=' SELECT date_format(Month, "%Y-%m"), date_format(Date, "%Y.%m.%d"), Rubbish, Greenarea, homemanager, cleanstreets, fund, total, explanation from boqna';
$sql_result=mysql_query($sql);
if (!$sql_result) {
    echo 'There is a problem with selectin from database<br/>';
    $error=mysql_error();
    echo 'The error is :'.$error.'<br/';
}

echo '<table class="tableFormating" border="0" cellspacing="1" cellpadding="1">';
echo '<tr  bgcolor="white"><th>За месец</th>
    <th>Дата</th>
    <th>Смет</th>
    <th>Зелени площи</th>
    <th>Домоупр.</th>
    <th>Почист. улици</th>
    <th>Фонд</th>
    <th>Общо</th>
    <th>Пояснение</th>
    </tr>';

while ($array=mysql_fetch_array($sql_result, MYSQL_NUM)) {
    echo '<tr bgcolor="white">';
    for ($count=0; $count<9; $count++) {
        if ($count!=8 and $count!=0) {
            if ($array[$count]<0) {
                echo '<td align="right" bgcolor="red"><nobr>'.$array[$count].'</nobr></td>';
            }
            else {
                echo '<td align="right"><nobr>'.$array[$count].'</nobr></td>';
            }
            if ($count!=0 and $count!=1 and $count!=8) {
                $countin[$count-2]+=$array[$count];
            }
            
            }
            else {
                echo '<td><nobr>'.$array[$count].'</nobr></td>';
            }
    }
    echo '</tr>';
}
echo '<tr align="right" bgcolor="white"> <th>&nbsp;</th>
    <th>Общо:</th>
    <th>'.$countin[0].'</th>
    <th>'.$countin[1].'</th>
    <th>'.$countin[2].'</th>
    <th>'.$countin[3].'</th>
    <th>'.$countin[4].'</th>
    <th>'.$countin[5].'</th>
    <th>&nbsp;</th>
    </tr>';
echo '</table>';

if (!mysql_close($connect)) {
        die ('There is a problem with closing the connection<br/>');
}   
?>
</td>
</tr>
</table>
</body>
</html>

