<?php

include reservclient_recuptab . php;

$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new PDO('mysql:host=localhost;dbname=app2', 'root', '', $pdo_options);

$lasttime = $bdd->query("SELECT r.lastdate FROM restaurant r WHERE r.id_resto = '$resto_session'");
$date1 = date('z', $lasttime);



$thistime = time();
$date2 = date('z', $thistime);

$diffjour = $date2 - $date1;
// on récupère les deux tables coté client et proprio
$chainerestaur = $bdd->query("SELECT r.table_reserv_proprio FROM restaurant r WHERE r.id_resto = '$resto_session'");
$tabrestaur = explode(" ", $chainerestaur);
$chaineclient = $bdd->query("SELECT r.table_reserv_client FROM restaurant r WHERE r.id_resto = '$resto_session'");
$tabclient = explode(" ", $chaineclient);

//première condition: est ce qu'on est à moins d'une semaine de la dernière réservation ? 
//=> on va devoir réutiliser les deux tables: client et proprio
if (abs($diffjour) < 7) {
    $numJour1 = date('w', $lasttime);
    $numJour2 = date('w', $thistime);
    $diffnum = $numJour2 - $numJour1;
//commande au cas ou le diffnum est négatif 
    if ($diffnum < 0) {
        $diffnum = $diffnum + 7;
    } else {
        
    }
//la boucle for va créer la nouvelle table en fonction de l'ancienne client 
    for ($i = 0; $i < 6; $i++) {
        $j = $i * 3;
        $h = ($i + $diffnum) * 3;
        if (($i + $diffnum) * 3 + 2 < 21) {
//on commence par remplir avec les éléments encore valides de la table client
            $tab[$j] = $tabclient[$h];
            $tab[$j + 1] = $tabclient[$h + 1];
            $tab[$j + 2] = $tabclient[$h + 2];
        } else {
//puis on finit de la remplir avec la table restaurateur
            $h1 = $h % 21;
            $h2 = ($h + 1) % 21;
            $h3 = ($h + 2) % 21;
            $tab[$j] = $tabrestaur[$h1];
            $tab[$j + 1] = $tabrestaurt[$h2];
            $tab[$j + 2] = $tabrestaur[$h3];
        }
    }
} else {
    //c'est le cas où il n'y a plus de réservations clients possibles qui sont encore effectives
    //on n'appellera donc que la table coté restaurateur
    $numJour1 = date('w', $lasttime);
    $numJour2 = date('w', $thistime);
    $diffnum = $numJour2 - $numJour1;

    if ($diffnum < 0) {
        $diffnum = $diffnum + 7;
    } else {
        
    }

    //la boucle for va créer la nouvelle table en fonction la table restaurateur uniquement
    for ($i = 0; $i < 6; $i++) {
        $j = $i * 3;
        $h = ($i + $diffnum) * 3;
        $h1 = $h % 21;
        $h2 = ($h + 1) % 21;
        $h3 = ($h + 2) % 21;
        $tab[$j] = $tabrestaur[$h1];
        $tab[$j + 1] = $tabrestaurt[$h2];
        $tab[$j + 2] = $tabrestaur[$h3];
    }
}

//on recrée la chaine de caractère de la table client mise à jour
$chaine = '';
for ($i = 0; $i < 20; $i++) {
    $chaine = $chaine . $tab[$i] . ' ';
}

// on met à jour la bdd
$sql = "INSERT INTO retaurant(table_reserv_client) VALUES (:tabrescl)";
$requ = $bdd->prepare($sql);
$requ->execute(array(':tabrescl' => $chaine));

//la base de données a été modifiée, on change la date qui l'indique tout de suite après.
$lasttime = $thistime;
$sql = "INSERT INTO retaurant(lastdate) VALUES (:lasttime)";
$requ = $bdd->prepare($sql);
$requ->execute(array(':lasttime' => $lasttime));
?>
