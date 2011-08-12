ALTER TABLE `accountancy` ADD `id_house` INT(5);

ALTER TABLE `Id_house` CHANGE `ID` `id_h` INT(5) NOT NULL;
ALTER TABLE `Id_house` CHANGE `month` `strart_month_pay` DATE NOT NULL;
ALTER TABLE `Id_house` CHANGE `explanation` `payer_name` VARCHAR(150) NOT NULL;
