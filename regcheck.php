<?php
include 'db_fns.php';
$login = htmlspecialchars(stripslashes(strip_tags(trim($_POST['login']))), ENT_QUOTES);
$password = $_POST['password'];
$password2 = $_POST['password2'];
$pass = sha1($password);
$email = htmlspecialchars(stripslashes(strip_tags(trim($_POST['email']))), ENT_QUOTES);
$email_c = substr_count($email, '@');
$email_d = substr_count($email, '.');
$nraa = $_POST['nraa'];
$log = mysql_query("SELECT * FROM users WHERE login='$login'") or die (mysql_error());
$logi = mysql_fetch_assoc($log);
$em = mysql_query("SELECT * FROM users WHERE email='$email'") or die (mysql_error());
$emi = mysql_fetch_assoc($em);
$blad=0;
$temat="tao.eu4.pl - Potwierdzenie rejestracji";
 
$headers = 'From: tao.eu4.pl';
$tok=uniqid('');
$token=sha1($tok);
$tresc="Kliknij w link aby potwierdzić rejestrację http://tao.eu4.pl/potwierdzenie.php?email=".$email."&id=".$token.", badź wpisz kod ręcznie przez stronę http://tao.eu4.pl/potwierdzenie.php Twój kod to ".$token;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Rejestracja</title>
</head>
<body>
    <div id="regcheck">
<?php
         echo "<div id=\"blad\">";
if($logi['login'] == $login && $login!="")
    {
        echo("Podana nazwa użytkownika jest już w naszej bazie!");
        echo ("<br> \n");
        $blad++;
    }
if(strlen($login) < 5 || strlen($login) > 32)
    {
        echo "Login musi zawierać od 5 do 32 znaków ";
        echo "<br />";
        $blad++;
    }
if(!preg_match('/[A-Za-z0-9_-]/', $login) && $password!="")
    {
        echo "Login zawiera niedozwolone znaki";
        echo "<br />";
        $blad++;
    }
if(strlen($password) < 5 or strlen($password) > 32)
    {
        echo "Hasło musi zawierać od 5 do 32 znaków";
        echo "<br />";
        $blad++;
    }
if($password!=$password2)
    {
    echo "Podane hasła są różne";
    echo "<br />";
    $blad++;
    }
if(!preg_match('/[A-Za-z0-9_-]/', $password) && $password!="")
    {
        echo "Hasło zawiera niedozwolone znaki";
        echo "<br />";
        $blad++;
    }
if($email=="")
    {
        echo "Musisz podać email!";
        echo "<br />";
        $blad++;
    }
elseif($email_c!=1 || $email_d<1)
    {
        echo "Podany email jest nieprawidłowy";
        echo "<br />";
        $blad++;
    }
 
if($emi['email'] == $email && $email!="")
    {
        echo("Podana email jest już w naszej bazie!");
        echo ("<br> \n");
        $blad++;
    }
    if($blad!=0){
    echo "<a href=\"javascript:history.back()\">";
    echo "Wróć do rejestracji";
    echo "</a>";
    }
 
    if($blad==0){
        $ins = mysql_query("INSERT INTO users VALUES ('','".$login."','".$pass."','".$email."','".$token."','".$nraa."','')");
	$profil = mysql_query("INSERT INTO profil VALUES ('','".$login."','','','','','','','','','','','','','','','','','','','','','','','','')");
        echo "<div id=\"ok\">";
        echo "Użytkownik został utworzony. Teraz na podane konto zostanie przesłany e-mail w celu potwierdzenia rejestracji.";
        mail($email, $temat, $tresc,$headers);
        echo "<br />";
        echo "<a href=\"logowanie.php\">"."Przejdź do strony logowania"."</a>";
        echo "</div>";
    }
    ?>
    </div>
</body>
</html>