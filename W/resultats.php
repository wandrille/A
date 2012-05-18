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
            $bdd = new PDO('mysql:host=localhost;dbname=app2', 'root', '', $pdo_options);
            ?> procedure commencee <br/> <?php
        //à améliorer
        if (isset($_GET['cd'])) {
            $cd = $_GET['cd'];
        }
        if (isset($_GET['pays'])) {
            $pays = $_GET['pays'];
        }
        if (isset($_GET['type'])) {
            $type = $_GET['type'];
        }
        $note = $_GET['note'];
        $prix = $_GET['prix'];
            ?> <br/> <?php
        // On récupère tout le contenu de la bdd
        $requete = "SELECT id_resto,nom_resto FROM restaurant r, type t, cd, pays p, ville v 
            WHERE r.note >= '$note' AND r.prix_moyen >= '$prix'";
        if (isset($pays)) {
            $requete .=  "AND (r.id_pays = p.id_pays AND p.nom_pays = '$pays')";
        }
        if (isset($type)) {
            $requete .=  "AND (r.id_type = t.id_type AND t.nom_type = '$type')";
        }
        if (isset($cd)) {
            $requete .=  "AND (r.id_cd = cd.id_cd AND cd.nom_cd = '$cd')";
        }
        if (isset($_GET['recherche'])) {
            $recherche = explode("+",$_GET['recherche']);
            foreach ($recherche as $mot)
            {
                //echo $mot;
                //$cle = htmlspecialchars($mot);
                //echo $cle;
                $requete .= "AND ((r.nom_resto LIKE '%$mot%') OR (r.id_ville = v.id_ville AND v.nom_ville LIKE '%$mot%'))";
            }
        }


        $reponse = $bdd->query($requete);
        // On affiche chaque entrée une à une
        while ($donnees = $reponse->fetch()) {
            echo $donnees['id_resto'];
            echo $donnees['nom_resto'];

            /* ?>
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
              <?php */
        }
        $reponse->closeCursor(); // Termine le traitement de la requête
    } catch (Exception $e) {
        // En cas d'erreur précédemment, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
    }
        ?>
        <br/>
        procedure terminee
    </body>
</html>

