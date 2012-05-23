<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Recherche
        </title>
    </head>
    <body>

        <?php
        $note = $_GET['note'];
        $prix = $_GET['prix'];
        $prixmax = $prix + 5;
        $prixmin = $prix - 5;
        $requete = "SELECT DISTINCT id_resto,nom_resto FROM restaurant r, type t, cd, pays p, ville v 
            WHERE r.note >= '$note' AND (r.prix_moyen >= '$prixmin' AND r.prix_moyen <= '$prixmax')";
        if (!empty($_GET['pays'])) {
            $pays = $_GET['pays'];
            $requete .= "AND (r.id_pays = p.id_pays AND p.nom_pays = '$pays')";
        }
        if (!empty($_GET['type'])) {
            $type = $_GET['type'];
            $requete .= "AND (r.id_type = t.id_type AND t.nom_type = '$type')";
        }
        if (!empty($_GET['cd'])) {
            $cd = $_GET['cd'];
            $requete .= "AND (r.id_cd = cd.id_cd AND cd.nom_cd = '$cd')";
        }
        if (!empty($_GET['recherche'])) {
            $recherche = explode(" ", $_GET['recherche']);
            foreach ($recherche as $mot) {
                $cle = htmlspecialchars($mot);
                $requete .= "AND (r.nom_resto LIKE '%$cle%' OR (r.id_ville = v.id_ville AND v.nom_ville LIKE '%$cle%') OR r.caracteristiques = '%$cle%')";
            }
        }
        $requete .= " LIMIT 0,20";
        try {
            // On se connecte à MySQL
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO('mysql:host=localhost;dbname=app2', 'root', '', $pdo_options);
            $reponse = $bdd->query($requete);
            
            while ($donnees = $reponse->fetch()) {
                echo $donnees['id_resto'];
                echo $donnees['nom_resto'];
            }
            $reponse->closeCursor(); // Termine le traitement de la requête
        } catch (Exception $e) {
            // En cas d'erreur précédemment, on affiche un message et on arrête tout
            die('Erreur : ' . $e->getMessage());
        }
        ?>
    </body>
</html>

