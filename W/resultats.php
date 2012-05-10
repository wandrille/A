<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> OAAAPUTAINCAMARCHE
        </title>
    </head>
    <body>
        <?php
        try {
            // On se connecte à MySQL
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO('mysql:host=localhost;dbname=app2', 'root', '',$pdo_options);
            ?> replace <?php
            if ($_POST['note']!= "null"){$note = $_POST['note'];}
            if ($_POST['cd']!= "null"){$cd = $_POST['cd'];}
            if ($_POST['pays']!= "null"){$pays = $_POST['pays'];}
            if ($_POST['type']!= "null"){$type = $_POST['type'];}
            if ($_POST['prix']!= "null"){$prix = $_POST['prix'];}
            /*if ($_POST['barrerech']!= "null"){ 
                $nom
                $ville
                $adresse
               }*/
            // On récupère tout le contenu de la bdd
            $reponse = $bdd->query('SELECT * FROM restaurant r, utilisateur u, type t, cd, pays p   
                WHERE t.nom_type = \''.$type.'\' AND r.id_type = t.id_type 
                    AND r.note = \''.$note.'\' AND r.prix >= \''.$prix.'\'
                        AND p.nom_pays = \''.$pays.'\' AND r.id_pays = p/id_pays ');
            // On affiche chaque entrée une à une
            while ($donnees = $reponse->fetch()) {
                echo $donnees['id_resto'];
                /*?>
                <p>
                    <strong>Restaurant</strong> : <?php echo $donnees['nom_resto']; ?><br />
                    Le possesseur de ce restaurant est : <?php echo
        $donnees['nom'].' '.$donnees['prenom']; ?>, et il l'a crée le <?php echo
        $donnees['date_creation']; ?> !<br />
                    Ce restaurant est de type <?php echo $donnees['nom_type']; ?> et
                    il est situé <?php //echo $donnees['nbre_joueurs_max']; ?> <br />
        <?php echo $donnees['nom'].' '.$donnees['prenom']; ?> a laissé ses
                    commentaires sur le restaurant <?php echo $donnees['nom_resto']; ?> : <em><?php echo
        $donnees['caracteristiques']; ?></em>
                </p>
                        <?php*/
                    }
                    $reponse->closeCursor(); // Termine le traitement de la requête
                } catch (Exception $e) {
                // En cas d'erreur précédemment, on affiche un message et on arrête tout
                    die('Erreur : ' . $e->getMessage());
                }
                ?>
    </body>
</html>

