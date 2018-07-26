<?php

/*
foreach ($_SESSION as $temp=>$temp2) {
echo "\$_SESSION['$temp'] = $temp2<br />";
}
*/

?>
<!DOCTYPE html>
<html lang="pl">
<head>
<title>Logowanie</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
body {
background: white url('editor/pic1.jpg') no-repeat center center fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
}

body, select, input, textarea {
font-family: 'Lato', verdana, arial, sans-serif;
font-size:16px;
font-weight: lighter;
}

body { color:#000; }

input { outline: 0; border:0px; }
input[type="submit"] { padding: 2px; background: #CFCFCF; border: 1px solid #CFCFCF; font-size:80%;}
input[type="submit"]:hover { background-color: #8CC954; }

.logowanie {
width: 300px;
margin: 10% auto;
background-color: yellow;
-webkit-border-radius: 6px;
-moz-border-radius: 6px;
border-radius: 6px;
text-align:center;
padding-bottom:15px;
background-color: #222;
font-size:20px;
color: #aaa;
}

.logowanie_top {
background-color: #8CC954;
border-bottom: 5px solid #659F31;
color: #fff;
font-size: 140%;
margin-bottom:10px;
padding:7px;
-webkit-border-top-left-radius: 6px;
-webkit-border-top-right-radius: 6px;
-moz-border-radius-topleft: 6px;
-moz-border-radius-topright: 6px;
border-top-left-radius: 6px;
border-top-right-radius: 6px;
}

.logowanie input { padding:8px; width:70%; }
.logowanie input, .logowanie p { margin: 7px 0; }
</style>


</head>
<body>
<img src="images/bg.jpg" class="bg">
<div class="logowanie">
<div class="logowanie_top">Logowanie</div>
<form action="" method="POST">

<input type="text" name="sec_lgn" /><br />
<input type="password" name="sec_pwd" />
<?php
if (isset($_COOKIE['logowanie'])) echo "<p>" . $_COOKIE['logowanie'] . "</p>";
else if ($sec_upr==2) echo "<p>Sesja wygasła</p>";
 ?>
<input type="submit" value="LOGOWANIE" />


</form>


</div>
</body>
</html>