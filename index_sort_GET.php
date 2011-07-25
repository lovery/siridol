<?php

for ($i = 0; $i < 9; $i++) {
	$name_img[$i][0] = "down_arrow_origin.png";
	$name_img[$i][1] = "up_arrow_origin.png";
}

if (empty($_GET["sort"])) {
        $_GET["sort"] = 1;
        $_GET["type"] = "asc";
}

switch ($_GET["sort"]) {
case 1:
        if ($_GET["type"] == "asc") {
                $sqlpl = " order by total < 0, payer_name, on_date";
               $name_img[0][0] = "down_arrow.png"; }
        else {
                $sqlpl = " order by total < 0 DESC, payer_name DESC, on_date";
                $name_img[0][1] = "up_arrow.png"; }
        break;
case 2:
        if ($_GET["type"] == "asc") {
                $sqlpl = " order by on_date, Month, explanation";
                $name_img[1][0] = "down_arrow.png"; }
        else {
                $sqlpl = " order by on_date DESC, Month, explanation";
                $name_img[1][1] = "up_arrow.png"; }
        break;
case 3:
	if ($_GET["type"] == "asc") {
		$sqlpl = " order by Rubbish, Month, on_date, explanation";
		$name_img[2][0] = "down_arrow.png"; }
	else {
		$sqlpl = " order by Rubbish DESC, Month, on_date, explanation";
		$name_img[2][1] = "up_arrow.png"; }
		break;
case 4:
	if ($_GET["type"] == "asc") {
		$sqlpl = " order by Greenarea, Month, on_date, explanation";
		$name_img[3][0] = "down_arrow.png"; }
	else {
		$sqlpl = " order by Greenarea DESC, Month, on_date, explanation";
		$name_img[3][1] = "up_arrow.png"; }
		break;
case 5:
	if ($_GET["type"] == "asc") {
		$sqlpl = " order by homemanager, Month, on_date, explanation";
		$name_img[4][0] = "down_arrow.png"; }
	else {
		$sqlpl = " order by homemanager DESC, Month, on_date, explanation";
		$name_img[4][1] = "up_arrow.png"; }
		break;
case 6:
	if ($_GET["type"] == "asc") {
		$sqlpl = " order by cleanstreets, Month, on_date, explanation";
		$name_img[5][0] = "down_arrow.png"; }
	else {
		$sqlpl = " order by cleanstreets DESC, Month, on_date, explanation";
		$name_img[5][1] = "up_arrow.png"; }
		break;
case 7:
	if ($_GET["type"] == "asc") {
		$sqlpl = " order by fund, Month, on_date, explanation";
		$name_img[6][0] = "down_arrow.png"; }
	else {
		$sqlpl = " order by fund DESC, Month, on_date, explanation";
		$name_img[6][1] = "up_arrow.png"; }
		break;
case 8:
	if ($_GET["type"] == "asc") {
		$sqlpl = " order by Rubbish+Greenarea+homemanager+cleanstreets+fund, Month, on_date, explanation";

		$name_img[7][0] = "down_arrow.png"; }
	else {
		$sqlpl = " order by Rubbish+Greenarea+homemanager+cleanstreets+fund DESC, Month, on_date, explanation";
		$name_img[7][1] = "up_arrow.png"; }
		break;
case 9:
	if ($_GET["type"] == "asc") {
		$sqlpl = " order by explanation, Month, on_date";
		$name_img[8][0] = "down_arrow.png"; }
	else {
		$sqlpl = " order by explanation DESC, Month, on_date";
		$name_img[8][1] = "up_arrow.png"; }
		break;
};

printf("<table class='tableBorder'>\n");
print_html_th($name_img, 1);

