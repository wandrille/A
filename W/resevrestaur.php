<?php

$test = array();
print_r($_POST);
for ($j = 0; $j < 20; $j++) {
    $je ='cb'.$j;
    if (isset($_POST[$je]) && !empty($_POST[$je])) {
        $test[$j] = $_POST[$je];
    } else {
        $test[$j] = 0;
    }
}
$list = "";
for ($i = 0; $i < 20; $i++) {
    $list .= " $test[$i]";
    echo $test[$i];
}
echo $test;
echo $list;

$db = mysql_connect('localhost', '', '');
mysql_select_db('poupipou', $db);

$sql = "INSERT INTO restaurant(table_reserv_proprio,table_reserv_client)
VALUES('$list','$list') WHERE restaurant.id_resto = '$resto_session' AND restaurant.proprietaire ='$id_session'";
// ATTENTION !!! pour les critères de recherche en fonction des ids de connexion ....
mysql_query($sql)
        or die('Erreur SQL !' . $sql . '' . mysql_error());

echo 'merci beaucoup, vos infos ont �t� enregistr�es.';
mysql_close();
?>
