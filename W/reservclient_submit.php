<?php

try {
    // On se connecte à MySQL
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=localhost;dbname=app2', 'root', '', $pdo_options);
    $reponse = $bdd->query("SELECT r.table_reserv_client FROM restaurant r WHERE r.id_resto = '$resto_session'");
    $tab = explode(" ", $reponse);


//on récupère le jour d'aujourd'hui
    $time = time('Y/m/d');
    $jours = Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
    $numJour = date('w', $time);
    $jour = $jours[$numJour];
    echo"$jour";

//on fait la différence entre le jour d'aujourd'hui et celui ou le client reserve
    $nbJours = $_POST['nbj'];
    $place = $_POST ['invites'];
    $tab[$nbJours] = $tab[$nbJours] - $place;

    //on recrée la chaine de caractère
    $chaine = '';
    for ($i = 0; $i < 20; $i++) {
        $chaine = $chaine . $tab[$i] . ' ';
    }

    // on met à jour la bdd
    $sql = "INSERT INTO retaurant(table_reserv_client) VALUES (:tabrescl)";
    $requ = $bdd->prepare($sql);
    $requ->execute(array(':tabrescl' => $chaine));


    $reponse->closeCursor(); // Termine le traitement de la requête
} catch (Exception $e) {
    // En cas d'erreur précédemment, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}
?>
