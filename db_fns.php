<?php
$connection = mysql_connect('localhost', 'eu4_taoeu4', '7kazik3')
    or die('Brak połączenia z serwerem MySQL');
    $db = @mysql_select_db('eu4_taoeu4', $connection)
    or die('Nie mogę połączyć się z bazą danych');
?>