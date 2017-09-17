<?php
ob_start();
ob_implicit_flush(0);
session_start(); // rozpoczynanie sesji
if(@$_SESSION['zalogowany']==1) //jeżeli jesteśmy już zalogowani to przenosi nas na stronę główną
{
    header('Location: index.php ');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Rejestracja</title>
</head>

<body>
<div id="content">
    <h1 id="h1">Rejestracja!</h1>
    <div id="register">
<table>
        <form id="rejestracja" name="rejestracja" method="POST" action="regcheck.php" >

<tr><td>Login: ( Najlepiej taki sam jak w grze)</td><td> <input type="text" id="login" name="login" /></td></tr><br />
<tr><td>           Hasło: (musi być RÓŻNE od tego w grze)</td><td> <input type="password" id="password" name="password" /></td></tr><br />
<tr><td>            Powtórz hasło:</td><td> <input type="password" id="password2" name="password2" /></td></tr><br />
<tr><td>            Email:</td><td> <input type="text" id="email" name="email" /></td></tr><br />
<tr><td>	    nr ID w Arenie (musi być identyczny jak w grze)</td><td> <input type="text" id="nraa" name="nraa" /></td></tr><br />
<tr><td></td><td>
            <input type="submit" value="&nbsp;&nbsp;Rejestruj!&nbsp;&nbsp;" />
</td></tr>
        </form>
</table>
    </div>
    <br />
    Masz już konto? <a href="logowanie.php">Zaloguj się!</a>
    </div>
</body>
</html>