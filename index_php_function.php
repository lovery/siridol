<?php
function print_html_td_money($num) {
	if ($num<0) {
		$class="tdNegative";
	}
	else {
		$class="tdNONegative";
	}
	printf("<td class='$class'>%.2f</td>\n", $num);
}

function print_html_tr_month_total($month, $rub, $green, $home, $clean,	$fund, $total) {
		printf("<tr class='tr_total'>\n");
		printf("<td class='nonegative' colspan=2><b>Общо за $month</b></td>\n");
		print_html_td_money($rub);
		print_html_td_money($green);
		print_html_td_money($home);
		print_html_td_money($clean);
		print_html_td_money($fund);
		print_html_td_money($total);
		printf("<td>&nbsp;</td>\n");
		printf("</tr>\n");
	}

function print_html_th($name_img, $print_sort_arrows) {
	if ($print_sort_arrows) {
		$month_arrows=
			"<a href=?sort=1&type=asc>".
			"<img src=".$name_img[0][0]." /></a>".
			"<a href=?sort=1&type=desc>".
			"<img src=".$name_img[0][1]." /></a>";

		$date_arrows=
			"<a href=?sort=2&type=asc>".
			"<img src=".$name_img[1][0]." /></a>".
			"<a href=?sort=2&type=desc>".
			"<img src=".$name_img[1][1]." /></a>";

		$rubbish_arrows=
			"<a href=?sort=3&type=asc>".
			"<img src=".$name_img[2][0]." /></a>".
			"<a href=?sort=3&type=desc>".
			"<img src=".$name_img[2][1]." /></a>";

		$greenarea_arrows=
			"<a href=?sort=4&type=asc>".
			"<img src=".$name_img[3][0]." /></a>".
			"<a href=?sort=4&type=desc>".
			"<img src=".$name_img[3][1]." /></a>";

		$homemanager_arrows=
			"<a href=?sort=5&type=asc>".
			"<img src=".$name_img[4][0]." /></a>".
			"<a href=?sort=5&type=desc>".
			"<img src=".$name_img[4][1]." /></a>";

		$cleanstreets_arrows=
			"<a href=?sort=6&type=asc>".
			"<img src=".$name_img[5][0]." /></a>".
			"<a href=?sort=6&type=desc>".
			"<img src=".$name_img[5][1]." /></a>";

		$fund_arrows=
			"<a href=?sort=7&type=asc>".
			"<img src=".$name_img[6][0]." /></a>".
			"<a href=?sort=7&type=desc>".
			"<img src=".$name_img[6][1]." /></a>";


		$total_arrows=
			"<a href=?sort=8&type=asc>".
			"<img src=".$name_img[7][0]." /></a>".
			"<a href=?sort=8&type=desc>".
			"<img src=".$name_img[7][1]." /></a>";

		$descr_arrows=
			"<a href=?sort=9&type=asc>".
			"<img src=".$name_img[8][0]." /></a>".
			"<a href=?sort=9&type=desc>".
			"<img src=".$name_img[8][1]." /></a>";
	}
	else {
		$month_arrows="";
		$date_arrows="";
		$rubbish_arrows="";
		$greenarea_arrows="";
		$homemanager_arrows="";
		$cleanstreets_arrows="";
		$fund_arrows="";
		$total_arrows="";
		$descr_arrows="";
	}

	printf("<tr>\n
		<th class='width_td'><nobr>За<br/>месец$month_arrows</nobr></th>\n
		<th class='width_td'><nobr>Дата$date_arrows</nobr></th>\n
		<th class='width_td'><nobr>Смет$rubbish_arrows</nobr></th>\n
		<th class='width_td'>Зелени <nobr>площи$greenarea_arrows</nobr></th>\n
		<th class='width_td'><nobr>Домоупр.$homemanager_arrows</nobr></th>\n
		<th class='width_td'>Почист. <nobr>улици$cleanstreets_arrows</nobr></th>\n
		<th class='width_td'><nobr>Фонд$fund_arrows</nobr></th>\n
		<th class='width_td'><nobr>Общо$total_arrows</nobr></th>\n
		<th><nobr>Пояснение$descr_arrows</nobr></th>\n
		</tr>\n");
}

function print_not_payed($array, $current_month, $what_to_print) {
	printf("<tr class='no_payer'>\n
		<td><nobr>$current_month</nobr></td>\n");
	if ($what_to_print == 1) {
		printf("<td colspan=7 align=center>Неплатено</td>\n");
	}
	else {
		printf("<td colspan=7 align=center>Има за доплащане</td>\n");
	}
	printf("<td><nobr>".$array['payer_name']."</td>\n
		</tr>");
}

function print_array_tr($array) {
	printf("<tr>\n
		<td>$array[month]</td>\n
		<td>$array[data]</td>\n");
	print_html_td_money($array['Rubbish']);
	print_html_td_money($array['Greenarea']);
	print_html_td_money($array['homemanager']);
	print_html_td_money($array['cleanstreets']);
	print_html_td_money($array['fund']);
	print_html_td_money($array['total']);
	printf("<td><nobr>$array[explanation]</nobr></td>\n
		</tr>\n");
}

function print_main_table($sql_result, $current_month, $name_img) {
	$is_rub = $is_green = $is_home = $is_clean = $is_fund = $is_total = 0;
	if (strcmp($current_month, '2010.07') != 0 && $_GET["sort"] == "1" ) {
		printf("<tr>\n<th colspan = 9 align = center>Отчет за $current_month</th>\n</tr>");
		print_html_th($name_img, 0);
	}
	while ($array = mysql_fetch_array($sql_result, MYSQL_ASSOC)) {
		if ($array['total'] == 0 ) {
			if (strcmp($current_month, date('Y.m')) <= 0) {
				print_not_payed($array, $current_month, 1);
			}
		}
		else {
			print_array_tr($array);
			$is_rub += $array['Rubbish'];
			$is_green += $array['Greenarea'];
			$is_home += $array['homemanager'];
			$is_clean += $array['cleanstreets'];
			$is_fund += $array['fund'];
			if (strpos($array['explanation'], "непълно плащане") != false) {
				print_not_payed($array, $current_month, 2);
			}
		}
	}
	if ($_GET["sort"] == "1") {
		print_html_tr_month_total($current_month, $is_rub, $is_green, $is_home, $is_clean, $is_fund, $is_total);
	}
}
?>
