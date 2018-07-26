<?php 
//include('app/sec.php');
//include("app/funkcje.php");




if ($_POST['status'] && $_GET['menu']=="realizacje" && $_GET['id']) {
//DODAĆ CHECKING CZY SĄ UPRAWNIENIA DO OPERACJI (wysłać do funkcji kod uprawnienia)
$status = $_POST['status'];
$id = $_GET['id'];
mysql_query("UPDATE `realizacje` SET `status` = '$status' WHERE `realizacje`.`id` = '$id';");
$status = status($status);
setcookie('info', "Zmieniono status na <a class='td_status'>$status</a>", time() + 1);
}

if ($_POST['statusy']) {

	foreach ($_POST as $temp=>$temp2) {
		//echo "#$temp#" . substr($temp, 0, 3) . "#$temp2" . substr($temp, 4) . "<br />";
		if (substr($temp, 0, 3)=="rlz" && $temp2=="on") {
			$id = substr($temp, 3);
			//echo $id . "-id<br />";
			$status = $_POST['statusy'];
			mysql_query("UPDATE `realizacje` SET `status` = '$status' WHERE `realizacje`.`id` = '$id';");
			$zmiany=1;
		}
	}
if ($zmiany==1) { $status = status($status); setcookie('info', "Zmieniono statusy zaznaczonych realizacji na <a class='td_status'>$status</a>", time() + 1); }
}

if ($_GET['menu']=="ceny" && $_POST['cena'] && $_POST['id']) {

	$cena = $_POST['cena'];
	$id = $_POST['id'];
	$temp = mysql_fetch_assoc(mysql_query("SELECT `id_pola`, `nazwa` FROM `wartosci` WHERE `id` = '$id'"));
	$temp2 = $temp['id_pola'];
	$temp = $temp['nazwa'];
	$temp2 = mysql_fetch_assoc(mysql_query("SELECT `nazwa` FROM `pola` WHERE `id` = '$temp2'"));
	$temp2 = $temp2['nazwa'];
	
	mysql_query("UPDATE `wartosci` SET `cena_default` = '$cena' WHERE `wartosci`.`id` = '$id';");
	setcookie('info', "Zmieniono cene: <a class='n'>$temp2 - $temp</a> na <a class='n'>$cena</a>", time() + 1);

}

if ($_GET['menu']=="realizacje" && $_POST['cena'] && $_GET['id']) {

	$cena = $_POST['cena'];
	$id = $_POST['id'];
	//$temp = mysql_fetch_assoc(mysql_query("SELECT `id_pola`, `nazwa` FROM `wartosci` WHERE `id` = '$id'"));
	//$temp2 = $temp['id_pola'];
	//$temp = $temp['nazwa'];
	//$temp2 = mysql_fetch_assoc(mysql_query("SELECT `nazwa` FROM `pola` WHERE `id` = '$temp2'"));
	//$temp2 = $temp2['nazwa'];
	
	mysql_query("UPDATE `zmienne` SET `cena` = '$cena' WHERE `id` = '$id';");
	setcookie('info', "Zmieniono cene: <a class='n'>$id$temp2 - $temp</a> na <a class='n'>$cena</a>", time() + 1);

}


if ($_POST['sec_lgn'] && $_POST['sec_pwd']) {

		$sec_lgn = $_POST['sec_lgn'];
		$sec_pwd = sha1($_POST['sec_pwd']);
		$sec_uag = $_SERVER['HTTP_USER_AGENT'];
		$sec_ipa = $_SERVER['REMOTE_ADDR'];
		$sql = mysql_query("SELECT `id`, `nazwa` FROM `uzytkownicy` WHERE `login` = '$sec_lgn' AND `pass` = '$sec_pwd'");
		if (mysql_num_rows($sql)==0) setcookie('logowanie', "Zły login lub hasło", time() + 1);
		else {
		$sql = mysql_fetch_assoc($sql);
		$id = $sql['id'];
		$sec_naz = $sql['nazwa'];
		$_SESSION['sec_ban'] = sha1($id);
		$_SESSION['sec_aut'] = 1;
		mysql_query("UPDATE `uzytkownicy` SET `ip` = '$sec_ipa' WHERE `id` = $id;");
		mysql_query("UPDATE `uzytkownicy` SET `user_agent` = '$sec_uag' WHERE `id` = $id;");
		setcookie('info', "Zalogowano jako: <a class='n'>$sec_naz</a>", time() + 1);
		}

}

if ($_POST['sec_off']) {

	$_SESSION = array();
	session_destroy();


}

if ($_GET['menu']=="realizacje" && $_POST['notatka'] && $_GET['id']) {

	$notatka = $_POST['notatka'];
	$id = $_GET['id'];
	$datetime = data(1);
	mysql_query("INSERT INTO `notatki` (`id_realizacji`, `id_uzytkownika`, `wartosc`, `data`, `waznosc`) VALUES ('$id', '$sec_id', '$notatka', '$datetime', 1);");
	
	setcookie('info', "Dodano nową notatkę", time() + 1);

}

if ($_GET['menu']=="realizacje" && $_POST['notatka_waznosc']) {

	$id = $_POST['notatka_waznosc'];
	$waznosc = mysql_fetch_assoc(mysql_query("SELECT `waznosc` FROM `notatki` WHERE `id` = $id"));
	if ($waznosc['waznosc']==1) { $waznosc = 0; $info = "Notatka usunięta"; }
	else if ($waznosc['waznosc']==0) { $waznosc = 1; $info = "Notatka przywrócona"; }

	$id_uzytkownika = 445;  //DODAĆ SPRAWDZAJKĘ ID USERA
	mysql_query("UPDATE `notatki` SET `waznosc` = '$waznosc' WHERE `id` = $id;");
	setcookie('info', "$info", time() + 1);

}















$link = "Location: http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI];
header($link);
die();







?>




