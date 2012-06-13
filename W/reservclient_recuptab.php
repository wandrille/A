<?php
try {
    // On se connecte à MySQL
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=localhost;dbname=app2', 'root', '', $pdo_options);
    $reponse = $bdd->query("SELECT r.table_reserv_client FROM restaurant r WHERE r.id_resto = '$resto_session'");
    $tab = $reponse;
    $reponse->closeCursor(); // Termine le traitement de la requête
} catch (Exception $e) {
    // En cas d'erreur précédemment, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}
?>
