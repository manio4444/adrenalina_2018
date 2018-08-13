<?

$ini_file = 'system/config/f5edca7c704382e57df58a255b71f79ace1f4c22';
$ini = parse_ini_file($ini_file);

?>


<!DOCTYPE html>
<html lang="pl">
<head>
<title><?php echo $ini['title']; ?></title>
<meta charset="UTF-8" />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<link href='imgcss/reset.css' rel='stylesheet' type='text/css'>
<link href='imgcss/main.css' rel='stylesheet' type='text/css'>


</head>
<body>



<header>
<?php /*
if ($_GET['id1']=='Nauka-plywania') $menu_li = '
		<li><a href="Plywam-">Pływam</a></li>
		<li><a href="Instruktorzy-">Instruktorzy</a></li>
		<li><a href="Oferta">Oferta</a></li>
		<li><a href="Galeria">Galeria</a></li>
		<li><a href="Cennik-">Cennik </a></li>
		<li><a href="Lokalizacja-">Lokalizacja </a></li>
		<li><a href="Kontakt">Kontakt</a></li>';
else
$menu_li = '
		<li><a href="O-nas">O nas</a></li>
		<li><a href="Oferta">Oferta</a></li>
		<li><a href="Galeria">Galeria</a></li>
		<li><a href="Kontakt">Kontakt</a></li>';
*/

$menu_li = '
		<li><a href="Nauka-plywania">Pływam</a></li>
		<li><a href="Instruktorzy">Instruktorzy</a></li>
		<li><a href="Oferta">Oferta</a></li>
		<li><a href="Galeria">Galeria</a></li>
		<li><a href="Cennik">Cennik </a></li>
		<li><a href="Lokalizacja">Lokalizacja </a></li>
		<li><a href="Kontakt">Kontakt</a></li>';


/* sfghsfhfsdhsrhsrthrhrthfst */

if ($_GET['id1']=='')	echo '<div class="logo"></div>';
else echo '
<div class="header2">
	<div class="logo2"><a href="http://' . $_SERVER['HTTP_HOST'] . '"></a></div>
	<ul>' . $menu_li . '
	</ul>
</div>
';

if ($_GET['id1']=='Wyprawy')

echo '
<div class="tlo_blur"><div class="tlo"><div class="auto">

<div class="pytania">
<strong>Masz pytania?</strong>
<p>Napisz lub zadzwoń!</p>
<br />
+48 <strong>731 764 448</strong>
<p>kontakt@adrenalina24.pl</p>
</div>

</div></div></div>
';
?>
</header>



<section>


<div class="section_content">




<?php

$path = 'system/include/';
$id1 = sha1($_GET['id1']);
if (isset($_GET['id1']))
	if(file_exists($path . $id1)) {
		if ($ini['type_' . $_GET['id1']]=='wyswig') echo '<div class="section_txt">';
		include($path . $id1);
		if ($ini['type_' . $_GET['id1']]=='wyswig') echo '</div>';
	}
	else echo'<h1>Nie można znaleźć strony "' . $_GET['id1'] . '"</h1>';
else include($path . sha1('Glowna'));

?>




</div>
</section>











<footer>

<nav class="nav_foot">
<p>Idź do podstrony: </p>


<ul>
  <li><a href="Nauka-plywania">Nauka pływania</a> /</li>
  <li><a href="Nordic-Walking">Nordic Walking</a> /</li>
  <li><a href="Wyprawy">Wyprawy</a> /</li>
  <li><a href="Aktywny-senior">Aktywny senior</a> /</li>
  <li><a href="Dzialania-spoleczne">Działania społeczne</a></li>
</ul>

</nav>

		<p class="copy">
		&copy; Copyrights 2015 www.adrenalina24.pl<a href="system/index.php"> Logowanie</a>
		</p>


</footer>


<div id="pop-slap" style="display: none" data-hello-text="Bądź na bieżąco, polub nas na Facebook.com" data-close-text="Dziękuję, już lubię tą stronę." data-timeout="4" data-demo="false"><script type="text/javascript" src="http://webfrik.pl/script/popup-fb?chx=787&amp;fb_url=https://www.facebook.com/Adrenalina24pl-418395038364703/&amp;fb_theme=light"></script></div>
<div id="facebook_slider_widget" style="display: none"><script type="text/javascript" src="http://webfrik.pl/widget/facebook_slider.html?fb_url=https://www.facebook.com/Adrenalina24pl-418395038364703/&amp;fb_width=290&amp;fb_height=590&amp;fb_faces=true&amp;fb_stream=true&amp;fb_header=true&amp;fb_border=true&amp;fb_theme=light&amp;chx=787&amp;speed=FAST&amp;fb_pic=logo&amp;position=RIGHT"></script></div>

</body>
</html>
