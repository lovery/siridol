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
    die("mysql_connect: ".mysql_error()."<br/>");
}   

$result=mysql_select_db("test");
if (!$result) {
    die("mysql_select_db :".mysql_error()."<br/>");
}

for ($i=0; $i<9; $i++) {
    $name_img[$i][0]="down_arrow_origin.png";
    $name_img[$i][1]="up_arrow_origin.png";
}

switch ($_GET["sort"]) {
case 1: 
    if ($_GET["type"]=="asc") {
        $sqlpl=" order by Month, Date";
        $name_img[0][0]="down_arrow.png";
    }
    else {
        $sqlpl=" order by Month DESC, Date";
        $name_img[0][1]="up_arrow.png";
    }
    break;
case 2:
    if ($_GET["type"]=="asc") {
        $sqlpl=" order by Date, Month";
        $name_img[1][0]="down_arrow.png";
    }
    else {
        $sqlpl=" order by Date DESC, Month";
        $name_img[1][1]="up_arrow.png";
    }
    break;
case 3:
    if ($_GET["type"]=="asc") {
        $sqlpl=" order by Rubbish, Month, Date";
        $name_img[2][0]="down_arrow.png";
    }
    else {
        $sqlpl=" order by Rubbish DESC, Month, Date";
        $name_img[2][1]="up_arrow.png";
    }
    break;
case 4:
    if ($_GET["type"]=="asc") {
        $sqlpl=" order by Greenarea, Month, Date";
        $name_img[3][0]="down_arrow.png";
    }
    else {
        $sqlpl=" order by Greenarea DESC, Month, Date";
        $name_img[3][1]="up_arrow.png";
    }
    break;
case 5:
    if ($_GET["type"]=="asc") {
        $sqlpl=" order by homemanager, Month, Date";
        $name_img[4][0]="down_arrow.png";
    }
    else {
        $sqlpl=" order by homemanager DESC, Month, Date";
        $name_img[4][1]="up_arrow.png";
    }
    break;
case 6:
    if ($_GET["type"]=="asc") {
        $sqlpl=" order by cleanstreets, Month, Date";
        $name_img[5][0]="down_arrow.png";
    }
    else {
        $sqlpl=" order by cleanstreets DESC, Month, Date";
        $name_img[5][1]="up_arrow.png";
    }
    break;
case 7:
    if ($_GET["type"]=="asc") {
        $sqlpl=" order by fund, Month, Date";
        $name_img[6][0]="down_arrow.png";
    }
    else {
        $sqlpl=" order by fund DESC, Month, Date";
        $name_img[6][1]="up_arrow.png";
    }
    break;
case 8:
    if ($_GET["type"]=="asc") {
        $sqlpl=" order by Rubbish+Greenarea+homemanager+cleanstreets+fund, Month, Date";
        $name_img[7][0]="down_arrow.png";
    }
    else {
        $sqlpl=" order by Rubbish+Greenarea+homemanager+cleanstreets+fund DESC, Month, Date";
        $name_img[7][1]="up_arrow.png";
    }
    break;
case 9:
    if ($_GET["type"]=="asc") {
        $sqlpl=" order by explanation, Month, Date";
        $name_img[8][0]="down_arrow.png";
    }
    else {
        $sqlpl=" order by explanation DESC, Month, Date";
        $name_img[8][1]="up_arrow.png";
    }
    break;
};

printf("<table class='tableBorder'>\n");
printf("<tr>
    <th><nobr>За месец<a href=?sort=1&type=asc><img src=".$name_img[0][0]." /></a><a href=?sort=1&type=desc><img src=".$name_img[0][1]." /></a></nobr></th>
    <th><nobr>Дата<a href=?sort=2&type=asc><img src=".$name_img[1][0]." /></a><a href=?sort=2&type=desc><img src=".$name_img[1][1]." /></a></nobr></th>
    <th><nobr>Смет<a href=?sort=3&type=asc><img src=".$name_img[2][0]." /></a><a href=?sort=3&type=desc><img src=".$name_img[2][1]." /></a><nobr></th>
    <th>Зелени <nobr>площи<a href=?sort=4&type=asc><img src=".$name_img[3][0]." /></a><a href=?sort=4&type=desc><img src=".$name_img[3][1]." /></a></nobr></th>
    <th><nobr>Домоупр.<a href=?sort=5&type=asc><img src=".$name_img[4][0]." /></a><a href=?sort=5&type=desc><img src=".$name_img[4][1]." /></a></nobr></th>
    <th>Почист. <nobr>улици<a href=?sort=6&type=asc><img src=".$name_img[5][0]." /></a><a href=?sort=6&type=desc><img src=".$name_img[5][1]." /></a></nobr></th>
    <th><nobr>Фонд<a href=?sort=7&type=asc><img src=".$name_img[6][0]." /></a><a href=?sort=7&type=desc><img src=".$name_img[6][1]." /></a></nobr></th>
    <th><nobr>Общо<a href=?sort=8&type=asc><img src=".$name_img[7][0]." /></a><a href=?sort=8&type=desc><img src=".$name_img[7][1]." /></a></nobr></th>
    <th><nobr>Пояснение<a href=?sort=9&type=asc><img src=".$name_img[8][0]." /></a><a href=?sort=9&type=desc><img src=".$name_img[8][1]." /></a></nobr></th>
</tr>");

$sql="SELECT date_format(Month, '%Y.%m') as month, date_format(Date, '%Y.%m.%d') as data, Rubbish, Greenarea, homemanager, cleanstreets, fund, Rubbish+Greenarea+homemanager+cleanstreets+fund as total, explanation from boqna".$sqlpl;
$sql_result=mysql_query($sql);
if (!$sql_result) {
    die( "Mysql_query :".mysql_error()."<br/>");
}

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
    die( "Mysql_query :".mysql_error()."<br/>");
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

