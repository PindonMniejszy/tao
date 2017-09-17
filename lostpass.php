<?php
ob_start();
ob_implicit_flush(0);
session_start();
if(@$_SESSION['zalogowany']==1)
{
    header('Location: index.php ');
}
include('db_fns.php');
@$email = $_POST['email'];
$em = mysql_query("SELECT * FROM users WHERE email = '$email'") or die (mysql_error());
$emi = mysql_fetch_assoc($em);
$temat="e-tutorials.pl - Przypomnienie hasła";
$tresc="Nowe hasło:";
$headers = 'From: admin@e-tutorials.pl';
$token=uniqid('');
$pass=sha1($token);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Przypomnienie hasła</title>
</head>
<body>
<div id="content">
    <h1 id="h1">Przypomnienie hasła!</h1>
    <br />
    <div id="lostpass">
       <?php
        if(@$_POST['form']==true){
 if($email==$emi['email'] && $email!="")
{
    echo "<div id=\"ok\">";
       echo "Na Twoje konto przesłany został email wraz z nowym hasłem. <a href=\"logowanie.php\">Zaloguj się</a>";
    echo "</div>";
    mail($email, $temat, $tresc.$token,$headers);
    $newpass=mysql_query("UPDATE users
SET password= '$pass' WHERE email= '$email'");
    }
else{
       echo "<div id=\"blad\">";
       echo "Podanego emaila nie ma w naszej bazie danych!";
    echo "</div>";
}
        }
    ?>
 
    <br />
    <form name="lostpassword" method="POST" action="lostpass.php" >
            Podaj e-mail: <input type="text" id="email" name="email" /><br />
             <input type="hidden" name="form" id="form" value="true" />
             <br />
            <input type="submit" value="&nbsp;&nbsp;Przypomnij!&nbsp;&nbsp;" />
        </form>
 
    <br />
    Nie masz konta? <a href="rejestracja.php">Zarejestruj się!</a>
    </div>
    </div>
</body>
</html>