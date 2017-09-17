<?php
session_start();
if(@$_GET['wyloguj']=='tak')
{
    session_unset();
    session_destroy();
       // $uo_de_2=mysql_query("DELETE FROM users_online WHERE login = '".$_SESSION['login']."'");
}
else{
if(@$_SESSION['zalogowany']==1)
{
ob_start();
ob_implicit_flush(0);
include('logi/db_fns.php');
//$table='users';

$zap="SELECT * FROM `users` WHERE login='$login'";
$idzap=mysql_query($zap);
$wiersz=mysql_fetch_array($idzap);
$zap2="SELECT * FROM `profil` WHERE login='$login'";
$idzap2=mysql_query($zap2);
$profil=mysql_fetch_array($idzap2);
}
else
{

}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/style_new.css" />
<title>Strona</title>
</head>
<body>


<div id="page">

<div id="header">header 2</div>

<div id="column">
	<div id="left">
	<a href="index.php">strona główna</a><br>
<?
if(@$_SESSION['zalogowany']==1)
{
echo ("oto Twój herb <img src=\"http://arena-albionu.pl/herb/".$wiersz[5].".png\"></br>");
    echo "<a href=\"?wyloguj=tak\">"."Wyloguj się"."</a></br>";
    echo "<a href=\"index.php?inc=chnpass\">"."Zmień hasło!"."</a></br>";
    echo "<a href=\"index.php?inc=zmienprofil\">"."Edytuj swoje zawody<br>oraz szukaj współpracowników"."</a></br></br></br><a href=\"http://www.kurkor.republika.pl/index.html\" target=\"new\">opowiadania KurKor</a></br><a href=\"http://www.kurkor.republika.pl/historia/index.html\" target=\"new\">historia KurKor</a>";
}
else{
echo "jesteś nie zalogowany";
}
?>
	</div>

	<div id="center"><?php
if(@$_SESSION['zalogowany']==1)
{

$url=$inc.".php";
 if(!isset($inc)) {
            include("logi/naglowek.php");
        }
        else {
if(file_exists("logi/$url"))
{
include ("logi/$url");
}
else{
print ("Błędna strona, wyloguj się poczym zaloguj powtórnie");
}
}

}
else
/* */
{

$url=$inc.".php";
 if(!isset($inc)) {
            include ("logi/logowanie.php");
        }
        else {
if(file_exists("logi/$url"))
{
include ("logi/$url");
}
else{
print ("Błędna strona, wyloguj się poczym zaloguj powtórnie");
}
}

}



?></div>
	<div id="right">
<?
   if(@$_SESSION['zalogowany']==1)
{
$rycerze="SELECT * FROM `profil`";
$lista_rycerze=mysql_query($rycerze);
$ilu_rycerzy=mysql_num_rows($lista_rycerze);
echo "<b>Lista zarejestrowanych ($ilu_rycerzy):</b><br><br>";
while($lista=mysql_fetch_array($lista_rycerze))
echo "<img src=\"http://arena-albionu.pl/herb/".$lista[27].".png\"> $lista[2] $lista[1] <br>";

}
else
{ echo "prawy";}


?>
	</div>
</div>

<div id="footer">stopa</div>

</div>

</body>
</html>
