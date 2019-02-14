<?php
$cleanUrl = $_SERVER['SERVER_NAME'] . str_replace(basename(__FILE__), '', $_SERVER['SCRIPT_NAME']);
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
		<?php
		if (isset($_GET['id1']) && in_array($_GET['id1'], array(
			'Nauka-plywania',
			'Instruktorzy',
			'Oferta',
			'Galeria',
			'Cennik',
			'Lokalizacja',
		))) {
			$menu_li = '
			<li><a href="Nauka-plywania">Pływam</a></li>
			<li><a href="Instruktorzy">Instruktorzy</a></li>
			<li><a href="Oferta">Oferta</a></li>
			<li><a href="Galeria">Galeria</a></li>
			<li><a href="Cennik">Cennik</a></li>
			<li><a href="Lokalizacja">Lokalizacja</a></li>
			<li><a href="Kontakt">Kontakt</a></li>';
		} else if (isset($_GET['id1']) && in_array($_GET['id1'], array(
			'Wycieczki-szkolne',
			'Wycieczki-szkolne-galeria',
			'Wycieczki-szkolne-cennik',
		))) {
			$menu_li = '
			<li><a href="Wycieczki-szkolne">Oferta</a></li>
			<li><a href="Wycieczki-szkolne-galeria">Galeria</a></li>
			<li><a href="Wycieczki-szkolne-cennik">Cennik</a></li>
			<li><a href="Kontakt">Kontakt</a></li>';
		} else if (isset($_GET['id1']) && in_array($_GET['id1'], array(
			'Obozy-zimowe',
			'Obozy-zimowe-galeria',
			'Obozy-zimowe-cennik',
		))) {
			$menu_li = '
			<li><a href="Obozy-zimowe">Oferta</a></li>
			<li><a href="Obozy-zimowe-galeria">Galeria</a></li>
			<li><a href="Obozy-zimowe-cennik">Cennik</a></li>
			<li><a href="Kontakt">Kontakt</a></li>';
		} else if (isset($_GET['id1']) && in_array($_GET['id1'], array(
			'Obozy-letnie',
			'Obozy-letnie-galeria',
			'Obozy-letnie-cennik',
		))) {
			$menu_li = '
			<li><a href="Obozy-letnie">Oferta</a></li>
			<li><a href="Obozy-letnie-galeria">Galeria</a></li>
			<li><a href="Obozy-letnie-cennik">Cennik</a></li>
			<li><a href="Kontakt">Kontakt</a></li>';
		} else if (isset($_GET['id1']) && in_array($_GET['id1'], array(
			'Splywy-kajakowe',
			'Splywy-kajakowe-galeria',
			'Splywy-kajakowe-cennik',
		))) {
			$menu_li = '
			<li><a href="Splywy-kajakowe">Oferta</a></li>
			<li><a href="Splywy-kajakowe-galeria">Galeria</a></li>
			<li><a href="Splywy-kajakowe-cennik">Cennik</a></li>
			<li><a href="Kontakt">Kontakt</a></li>';
		}

		$menu_li = empty($menu_li) ? "" : "<ul>" . $menu_li . "</ul>";

		if (isset($_GET['id1']) && $_GET['id1']=='')	echo '<div class="logo"></div>';
		else echo '
		<div class="header2">
			<div class="logo2">
				<a href="http://' . $cleanUrl . '"></a>
			</div>
			' . $menu_li . '
		</div>';

	$circle_contact = '
		<div class="pytania">
			<strong>Masz pytania?</strong>
			<p>Napisz lub zadzwoń!</p>
			<br />
			+48 <strong>731 764 448</strong>
			<p>kontakt@adrenalina24.pl</p>
		</div>';

	if (isset($_GET['id1']) && in_array($_GET['id1'], array(
		'Nauka-plywania',
	))) {
		echo '
		<div class="page_bgn_banner page_bgn_banner--swimming"></div>
		<div class="auto">
			' . $circle_contact . '
		</div>';
	}

	if (isset($_GET['id1']) && in_array($_GET['id1'], array(
		'Wycieczki-szkolne',
	))) {
		echo '
		<div class="page_bgn_banner page_bgn_banner--trips"></div>
		<div class="auto">
			' . $circle_contact . '
		</div>';
	}


	if (isset($_GET['id1']) && in_array($_GET['id1'], array(
		'Obozy-zimowe',
	))) {
		echo '
		<div class="tlo_blur"><div class="tlo"></div>
		<div class="auto">
			' . $circle_contact . '
		</div></div>';
	}


	if (isset($_GET['id1']) && in_array($_GET['id1'], array(
		'Obozy-letnie',
	))) {
		echo '
		<div class="page_bgn_banner page_bgn_banner--summer"></div>
		<div class="auto">
			' . $circle_contact . '
		</div>';
	}


	if (isset($_GET['id1']) && in_array($_GET['id1'], array(
		'Splywy-kajakowe',
	))) {
		echo '
		<div class="page_bgn_banner page_bgn_banner--kayak"></div>
		<div class="auto">
			' . $circle_contact . '
		</div>';
	}

		?>
	</header>

	<section>
		<div class="section_content">

			<?php
			$path = 'database/content/';

			if (isset($_GET['id1'])) {
				$id1 = $_GET['id1'];
				if(!file_exists($path . $id1)) {
					echo'<h1>Nie można znaleźć strony "' . $_GET['id1'] . '"</h1>';
				} else {
					if ($ini['type_' . $_GET['id1']]=='wyswig') echo '<div class="section_txt">';
					include($path . $id1);
					if ($ini['type_' . $_GET['id1']]=='wyswig') echo '</div>';
				}
			} else {
				include($path . 'Glowna');
			}
				?>

			</div>
		</section>

		<footer>

			<nav class="nav_foot">
				<p>Idź do podstrony: </p>

				<ul>
					<li><a href="Nauka-plywania">Nauka pływania</a>&nbsp;&nbsp;&nbsp;&nbsp;/ </li>
					<li><a href="Wycieczki-szkolne">Wycieczki szkolne</a>&nbsp;&nbsp;&nbsp;&nbsp;/ </li>
					<li><a href="Obozy-zimowe">Obozy zimowe</a>&nbsp;&nbsp;&nbsp;&nbsp;/ </li>
					<li><a href="Obozy-letnie">Obozy letnie</a>&nbsp;&nbsp;&nbsp;&nbsp;/ </li>
					<li><a href="Splywy-kajakowe">Spływy Kajakowe</a></li>
				</ul>

			</nav>

			<p class="copy">
				&copy; Copyrights 2015 www.adrenalina24.pl<a href="system/index.php"> Logowanie</a>
			</p>

		</footer>

		<!-- <div id="pop-slap" style="display: none" data-hello-text="Bądź na bieżąco, polub nas na Facebook.com" data-close-text="Dziękuję, już lubię tą stronę." data-timeout="4" data-demo="false"><script type="text/javascript" src="http://webfrik.pl/script/popup-fb?chx=787&amp;fb_url=https://www.facebook.com/Adrenalina24pl-418395038364703/&amp;fb_theme=light"></script></div> -->
		<!-- <div id="facebook_slider_widget" style="display: none"><script type="text/javascript" src="http://webfrik.pl/widget/facebook_slider.html?fb_url=https://www.facebook.com/Adrenalina24pl-418395038364703/&amp;fb_width=290&amp;fb_height=590&amp;fb_faces=true&amp;fb_stream=true&amp;fb_header=true&amp;fb_border=true&amp;fb_theme=light&amp;chx=787&amp;speed=FAST&amp;fb_pic=logo&amp;position=RIGHT"></script></div> -->

	</body>
	</html>
