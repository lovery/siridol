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

	printf("<tr>\n".
		"<th class='width_td'><nobr>За<br/>месец$month_arrows</nobr></th>\n".
		"<th class='width_td'><nobr>Дата$date_arrows</nobr></th>\n".
		"<th class='width_td'><nobr>Смет$rubbish_arrows</nobr></th>\n".
		"<th class='width_td'>Зелени <nobr>площи$greenarea_arrows</nobr></th>\n".
		"<th class='width_td'><nobr>Домоупр.$homemanager_arrows</nobr></th>\n".
		"<th class='width_td'>Почист. <nobr>улици$cleanstreets_arrows</nobr></th>\n".
		"<th class='width_td'><nobr>Фонд$fund_arrows</nobr></th>\n".
		"<th class='width_td'><nobr>Общо$total_arrows</nobr></th>\n".

		"<th><nobr>Пояснение$descr_arrows</nobr></th>\n".
		"<th><nobr>ID_houses</nobr></th>\n".
		"</tr>\n");
}

function print_not_payed($is_payed, $array_id_house, $size_id_house, $current_month) {
	$i=0;
	while ($i < $size_id_house) {
		if (!isset($is_payed[$array_id_house[$i]['ID']])) {
			if ($current_month >= $array_id_house[$i]['month']) {
				printf("<tr>\n".
					"<td><nobr>$current_month</nobr></td>\n".
					"<td colspan=7 align=center>Неплатено</td>\n".
					"<td><nobr>".
					$array_id_house[$i]['explanation'].
					"</th>\n".
					"</tr>");
			}
		}
		$i++;
	}


}
?>
