<?php
ob_start();
ob_implicit_flush(0);
session_start();
if(@$_SESSION['zalogowany']==1)
{
    header('Location: index.php ');
}
include('db_fns.php');
@$email=$_GET['email'];
@$id=$_GET['id'];
$em = mysql_query("SELECT * FROM users WHERE email = '$email'") or die (mysql_error());
$emi = mysql_fetch_assoc($em);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Potwierdzenie rejestracji</title>
</head>
<body>
<div id="content">
    <h1 id="h1">Potwierdzenie rejestracji!</h1>
    <br />
    <div id="lostpass">
       <?php
        if(@$_POST['form']!=true){
 if(isset($_GET['email']) && isset($_GET['id'])){
     if($emi['potwierdzenie']==0 && $emi['token']==$id){
         echo "<div id=\"ok\">";
         echo "Konto zostało aktywowane";
         echo "<br />";
         echo "<a href=\"logowanie.php\">Zaloguj się</a>";
         echo "</div>";
         $aktywacja=mysql_query("UPDATE users
SET potwierdzenie=1 WHERE email= '$email'");
             }
             elseif($emi['potwierdzenie']==1 && $emi['token']==$id){
                echo "<div id=\"blad\">";
         echo "Twoje konto zostało już aktywowane";
         echo "<br />";
         echo "<a href=\"logowanie.php\">Zaloguj się</a>";
         echo "</div>";
             }
        else {
            echo "<div id=\"blad\">";
         echo "Podano błędne dane";
         echo "<br />";
         echo "<a href=\"potwierdzenie.php\">Spróbuj ponownie</a>";
         echo "</div>";
        }
 }
 else {
     echo "
     <form name=\"potwierdzenie\" method=\"GET\" action=\"potwierdzenie.php\" >
            Podaj e-mail: <input type=\"text\" id=\"email\" name=\"email\" /><br />
            Podaj kod: <input type=\"text\" id=\"id\" name=\"id\" /><br />
             <input type=\"hidden\" name=\"form\" id=\"form\" value=\"true\" />
             <br />
            <input type=\"submit\" value=\"&nbsp;&nbsp;Aktywuj!&nbsp;&nbsp;\" />
        </form>";
 }
 
 }
 
    ?>
    </div>
    </div>
 
</body>
</html>