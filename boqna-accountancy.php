<html>
<head>
<meta http-equiv="accounting" charset="UTF-8"/>
<link rel="stylesheet" type="text/css" href="boqna-accountancy.css">
<title>
Счетоводство на комплекса
</title>
</head>
<body bgcolor="#EEEEEE">
<?php

function print_html_num_td($num) {
    if ($num<0) {
        printf("<td class=tdNegative>");
    }
    else {
        printf("<td class=tdNONegative>");
    }
    printf("$num</td>\n");
}

$connect=mysql_connect("localhost", "root", "happypass");
if (!$connect) {
        die ("There is a problem with connect to the MySQL Server<br/>");
}   

$result=mysql_select_db("test");
if (!$result) {
    printf( "There is a problem with loading the database<br/>");
}

$sql=" SELECT date_format(Month, '%Y.%m') as month, date_format(Date, '%Y.%m.%d') as data, Rubbish, Greenarea, homemanager, cleanstreets, fund,Rubbish+Greenarea+homemanager+cleanstreets+fund as total, explanation from boqna";
$sql_result=mysql_query($sql);
if (!$sql_result) {
    printf( "There is a problem with selecting from database<br/>");
    $error=mysql_error();
    die( "The error is :".$error."<br/>");
}

printf("<table class='tableBorder'>\n");
printf("<tr>
    <th>За месец</th>
    <th>Дата</th>
    <th>Смет</th>
    <th>Зелени площи</th>
    <th>Домоупр.</th>
    <th>Почист. улици</th>
    <th>Фонд</th>
    <th>Общо</th>
    <th>Пояснение</th>
    </tr>");

while ($array=mysql_fetch_array($sql_result, MYSQL_ASSOC)) {
    printf("<tr>\n");
    printf("<td>$array[month]</td>\n");
    printf("<td>$array[data]</td>\n");
    print_html_num_td($array[Rubbish]);
    print_html_num_td($array[Greenarea]);
    print_html_num_td($array[homemanager]);
    print_html_num_td($array[cleanstreets]);
    print_html_num_td($array[fund]);
    print_html_num_td($array[total]);
    printf("<td><nobr>$array[explanation]</nobr></td>\n");
    printf("</tr>\n");
}

$total_sql=mysql_query("select trub, tgreen, thome, tclean, tfund, trub+tgreen+thome+tclean+tfund as total from (select sum(Rubbish) as trub, sum(Greenarea) as tgreen, sum(homemanager) as thome, sum(cleanstreets) as tclean, sum(fund) as tfund from boqna) as tab");
if (!$total_sql) {
    printf( "There is a problem with selecting from database<br/>");
    $error=mysql_error();
    die( "The error is :".$error."<br/>");
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

if (!mysql_close($connect)) {
        die ("There is a problem with closing the connection<br/>");
}   
?>
</body>
</html>

