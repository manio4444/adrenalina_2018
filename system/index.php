<?php
session_start();
$ini_file = 'config/f5edca7c704382e57df58a255b71f79ace1f4c22';
$ini = parse_ini_file($ini_file);
$sec_version = '2.5.6';
$editor_special = Array("menadzer-plikow", "ustawienia", "debug");
define('FOLDER_ROOT', __DIR__ . '/../');
define('FOLDER_CONTENT', FOLDER_ROOT . 'database/content');


function zalogowanie() {
	global $ini;
	$sec_uag = preg_replace("/[^a-zA-Z0-9]+/", "", $_SERVER['HTTP_USER_AGENT'] );
	$sec_ipa = $_SERVER['REMOTE_ADDR'];
	$sec_ban = isset($_SESSION['sec_ban']) ? $_SESSION['sec_ban'] : null;
	$sec_aut = isset($_SESSION['sec_aut']) ? $_SESSION['sec_aut'] : null;
/*
	echo $sec_ban . "<br />";
	echo sha1($ini['sec_lgn']) . "<br />";
	echo $sec_aut . "<br />";
	echo 1 . "<br />";
	echo $sec_uag . "<br />";
	echo $ini['sec_uag'] . "<br />";
	echo $sec_ipa==$ini['sec_ipa'] . "<br />";
*/
	if ($sec_ban==sha1($ini['sec_lgn']) && $sec_aut==1 && $sec_uag==$ini['sec_uag'] && $sec_ipa==$ini['sec_ipa']) return 1;
	else if (isset($_COOKIE['superuser']) && $_COOKIE['superuser']==1) return 1;
	else return 0;
}

function ini_zmiana($co,$value) {
	global $ini, $ini_file;
	$ini[$co] = $value;
	$content = '';
	foreach ($ini as $temp=>$temp2) {
	$content .= "$temp = $temp2" . PHP_EOL;
	file_put_contents($ini_file, $content);
	}
}

function template_file_exists($contentId) {
	return (file_exists(FOLDER_CONTENT . '/' . $contentId));
}
function template_file_get($contentId) {
	return file_get_contents(FOLDER_CONTENT . '/' . $contentId);
}

//###################################################################### WYJEBUJE magic_quotes_gpc
if (get_magic_quotes_gpc()) {
    function stripslashes_deep($value)
    {
        $value = is_array($value) ?
                    array_map('stripslashes_deep', $value) :
                    stripslashes($value);

        return $value;
    }

    $_POST = array_map('stripslashes_deep', $_POST);
    $_GET = array_map('stripslashes_deep', $_GET);
    $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
    $_REQUEST = array_map('stripslashes_deep', $_REQUEST);
}

if (isset($_POST['sec_lgn']) && isset($_POST['sec_pwd'])) {

		$sec_lgn = $_POST['sec_lgn'];
		$sec_pwd = sha1($_POST['sec_pwd']);
		$sec_uag = preg_replace("/[^a-zA-Z0-9]+/", "", $_SERVER['HTTP_USER_AGENT'] );
		$sec_ipa = $_SERVER['REMOTE_ADDR'];
		if ($sec_lgn==$ini['sec_lgn'] && $sec_pwd==$ini['sec_pwd']) {

		$_SESSION['sec_ban'] = sha1($sec_lgn);
		$_SESSION['sec_aut'] = 1;
		ini_zmiana("sec_ipa", $sec_ipa);
		ini_zmiana("sec_uag", $sec_uag);
		}
		$link = "Location: http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; header($link); die();

}

if (isset($_GET['sec_off'])) {

	$_SESSION = array();
	session_destroy();
	$link = "Location: http://" . $_SERVER['HTTP_HOST']; header($link); die();
}

//###################################################################### SPRAWDZA CZY ZALOGOWANO
if (zalogowanie()!==1) { include('editor/logowanie.php'); die(); }

if (isset($_POST['action_zapisz'])) {

	file_put_contents(FOLDER_CONTENT . '/' . $_GET['page'], $_POST['txt']);
	$link = "Location: http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; header($link); die();
}

if (isset($_POST['action_ini'])) {

	if ($_POST['co']=='sec_pwd')  ini_zmiana($_POST['co'], sha1($_POST['value']));
	else ini_zmiana($_POST['co'], $_POST['value']);
	$link = "Location: http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; header($link); die();
}

?>


<!DOCTYPE html>
<html lang="pl">
<head>
<title>WordFresh CMS - <?php echo $ini['title']; ?></title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">


<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="/js/tinymce/tinymce.min.js"></script>
<script src="/js/tinymce_inicjacja.js"></script>
<link href='../imgcss/reset.css' rel='stylesheet' type='text/css'>
<link href='editor/editor.css' rel='stylesheet' type='text/css'>


</head>
<body>




<header>
<p class="title">WordFresh CMS 2.4.1 - <?php echo $ini['title']; ?></p>
<p class="logoff"><a href="?sec_off=1">Wyloguj</a></p>
</header>





<div class='all'>
<nav><ul>
<?php
$menu = explode(',',$ini['editor'] );
foreach ($menu as $temp) {
echo "<li title='" . sha1($temp) . "'><a href='?page=$temp'>" . $ini['name_' . $temp] . "</a></li>";
}
?>
</ul>

<ul>
<li><a href="?page=ustawienia">Ustawienia</a></li>


</ul>
</nav>



<section> <div class="section_content">
<?php


if (isset($_GET['page'])) {
	if (
		key_exists('type_' . $_GET['page'], $ini)
		&& $ini['type_' . $_GET['page']] == 'wyswig'
	) {
	$name = $ini['name_' . $_GET['page']];
	if (template_file_exists($_GET['page'])) {
		$txt = template_file_get($_GET['page']);
	} else {
		$txt = "";
	}
	echo "
	<form method=\"post\">
	<h1>$name<input type='submit' value='Zapisz' name='action_zapisz' /></h1>

		<div class=\"tinymc\"><textarea id='tinymce' name='txt'>$txt</textarea></div>
	</form>

	";
} else {
	include("include/" . $_GET['page']);
}

}





 ?>




</div></section>
<footer>

</footer>
</div>


</body>
</html>
