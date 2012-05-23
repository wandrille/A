<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <meta charset="utf-8" />


    <head>

        <script type="text/javascript">


<?php
try {
    // On se connecte à MySQL
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=localhost;dbname=app2', 'root', '', $pdo_options);
    ?>


                    <!--Etoiles de notation-->
                    function trouverimg()
                    {
                        var i,imgs;
                        // Rechercher toutes les images de la page HTML
                        imgs=document.getElementsByName('change');
                        for(i=0;i<imgs.length;i++)
                        {
                            // Chercher toutes les images qui ont une classe qui s'appelle change
                            if(/change/.test(imgs[i].className))
                            {
                                // Ajouter la fonction roll a l'image dans les cas onmouseover, onmouseout et onclick
                                // l'image elle meme est un object
                                imgs[i].onmouseover=function(){roll(this);};
                                imgs[i].onmouseout=function(){rollout(this);};
                                imgs[i].onfocus=function(){roll(this);};
                                imgs[i].onblur=function(){rollout(this);};
                                imgs[i].onclick=function(){click(this);};

                            }
                        }
                        document.getElementById('stable').onmouseover=function(){roll(this);};
                        document.getElementById('stable').onmouseout=function(){rollout(this);};
                        document.getElementById('stable').onfocus=function(){roll(this);};
                        document.getElementById('stable').onblur=function(){rollout(this);};
                        document.getElementById('stable').onclick=function(){click(this);};
                    }
    		
                    var chiffre_click = 3;

                    function roll(o)
                    {			
                        //rechercher la 8eme lettre de la classe
                        var chiffre_over = o.className.charAt(7);

                        // Remplacer avec la chaine selected pour les étoiles sous le clic, avec blanck pour celles apres 
    			
                        var i,imgs;
                        imgs=document.getElementsByName('change');

                        for(i=0;i<chiffre_over;i++)
    				
                        {imgs[i].src = imgs[i].src.replace('blank','selected');}
    				
    		
                        for(i=chiffre_over;i<5;i++)
    				
                        {imgs[i].src = imgs[i].src.replace('selected','blank');}
                    }
    		
                    function rollout(o)
                    {
                        // Revenir aux etoiles d'origine en se basant sur le chiffre clic, 3 au debut 
    			
                        var i,imgs;
                        imgs=document.getElementsByName('change');

                        for(i=0;i<chiffre_click;i++)
    				
                        {imgs[i].src = imgs[i].src.replace('blank','selected');}
    				
    		
                        for(i=chiffre_click;i<5;i++)
    				
                        {imgs[i].src = imgs[i].src.replace('selected','blank');}
                    }

    		
                    function click(o)
                    {
                        // Remplacer la valeur du chiffre clic par celle de l'etoile cliquee
                        if(/0/.test(o.className)) {chiffre_click = 0;}
                        else if(/1/.test(o.className)) {chiffre_click = 1;}
                        else if(/2/.test(o.className)) {chiffre_click = 2;}
                        else if(/3/.test(o.className)) {chiffre_click = 3;}
                        else if(/4/.test(o.className)) {chiffre_click = 4;}
                        else {chiffre_click = 5;}
                    }
                
                    function masqueravis() {
                        document.getElementById("note").style.display = "none"
                    }

                    window.onload=function(){
                        trouverimg();
                        masqueravis();
                    }


                    <!--Champ principal-->

                    function remplir(newValue) {
                        // Modifier les champs de recherche avancée en fonction du texte tapé dans la barre de recherche
       	
                        <!--Code postal-->
                        var verifCodePostal = new RegExp("(^| )[0-9]{5}( |$)");
                        var codePostalNonElague = verifCodePostal.exec(newValue);
                        var codePostalElague = new RegExp("[0-9]{5}");
                        if(codePostalElague.test(codePostalNonElague)){
                            document.getElementById("codePostal").value=codePostalElague.exec(codePostalNonElague);
                        } else{
                            document.getElementById("codePostal").value=null;
                        }


                        <!--Note-->
                        var verifNote = new RegExp("(^| )[0-5]( |$)");
                        var noteNonElague = verifNote.exec(newValue);
                        var verifNoteElague = new RegExp("[0-5]");
                        if(verifNoteElague.test(noteNonElague)){
                            chiffre_click = verifNoteElague.exec(noteNonElague) ;
                            rollout();
                        }else{
                            chiffre_click = 3;
                            rollout();
                        }
                    
                    
                        <!--Prix-->
                        var verifPrix = new RegExp("((^| )(100|[1-9][0-9]|[6-9])(€| |$)( |$))|((^| )([1-5])(€)( |$))");
                        var prixNonElague;
                        if(verifPrix.test(newValue)){
                            var prixNonElague = verifPrix.exec(newValue);
                            var verifPrixElague = new RegExp("100|[1-9][0-9]|[1-9]");
                            document.getElementById("prixmoyen").value=verifPrixElague.exec(prixNonElague);
                            document.getElementById("prixmoyen").innerHTML=verifPrixElague.exec(prixNonElague);
                            document.getElementById("prix").value=verifPrixElague.exec(prixNonElague);
                            document.getElementById("prix").innerHTML=verifPrixElague.exec(prixNonElague);
                        }
                        else{
                            document.getElementById("prixmoyen").value=25;
                            document.getElementById("prix").innerHTML=25;
                        }
                    
        	
                        <!--Type-->
    			    
    <?php
    // On récupère tout le contenu de la table 
    $reponse = $bdd->query('SELECT * FROM type');
    // On affiche chaque entrée une à une
    while ($donnees = $reponse->fetch()) {
        ?>
                         var verifType<?php echo $donnees['id_type']; ?> = new RegExp("(^| )(<?php echo $donnees['nom_type']; ?>)( |$)","i");
    <?php } $reponse->closeCursor(); ?>
    			
                                    if(1 == 0){}
    <?php
    // On récupère tout le contenu de la table 
    $reponse = $bdd->query('SELECT * FROM type');
    // On affiche chaque entrée une à une
    while ($donnees = $reponse->fetch()) {
        ?>else if(verifType<?php echo $donnees['id_type']; ?>.test(newValue)){
                         document.getElementById("Type<?php echo $donnees['id_type']; ?>").selected=true;}
    <?php } $reponse->closeCursor(); ?>
                                else {document.getElementById("Type").selected=true;}


                                <!--Pays-->
    <?php
    // On récupère tout le contenu de la table 
    $reponse = $bdd->query('SELECT * FROM pays');
    // On affiche chaque entrée une à une
    while ($donnees = $reponse->fetch()) {
        ?>
                     var verifPays<?php echo $donnees['id_pays']; ?> = new RegExp("(^| )(<?php echo $donnees['nom_pays']; ?>)( |$)","i");
    <?php } $reponse->closeCursor(); ?>
                                if(1 == 0){}
    <?php
    // On récupère tout le contenu de la table 
    $reponse = $bdd->query('SELECT * FROM pays');
    // On affiche chaque entrée une à une
    while ($donnees = $reponse->fetch()) {
        ?>
                     else if(verifPays<?php echo $donnees['id_pays']; ?>.test(newValue)){
                         document.getElementById("Pays<?php echo $donnees['id_pays']; ?>").selected=true;}
    <?php } $reponse->closeCursor(); ?>
                                else {document.getElementById("Pays").selected=true;}

                            }    
                
                            function doublon() {
                                <!--Code postal-->
                                var codePostalFinal = document.getElementById("codePostal").value;
                                document.getElementById("recherche").value = document.getElementById("recherche").value.replace(codePostalFinal,'');
                    
                                <!--Pays-->
                                var paysFinal = document.getElementById("pays").value;
                                var paysRegExp = new RegExp(paysFinal,"i");
                                document.getElementById("recherche").value = document.getElementById("recherche").value.replace(paysRegExp.exec(document.getElementById("recherche").value),"");
                    
                                <!--Type-->
                                var typeFinal = document.getElementById("type").value;
                                var typeRegExp = new RegExp(typeFinal,"i");
                                document.getElementById("recherche").value = document.getElementById("recherche").value.replace(typeRegExp.exec(document.getElementById("recherche").value),"");
                    
                                <!--Note-->
                                document.getElementById("note").value=chiffre_click;
                                var noteRegExp = new RegExp("(^| )[0-5]( |$)");
                                if(noteRegExp.test(document.getElementById("recherche").value)){
                                    document.getElementById("recherche").value = document.getElementById("recherche").value.replace(chiffre_click,'');}
                    
                                <!--Prix-->
                                var verifPrix = new RegExp("((^| )(100|[1-9][0-9]|[6-9])(€| |$)( |$))|((^| )([1-5])(€)( |$))");
                                var verifPrixElague = new RegExp("100|[1-9][0-9]|[1-9]");
                                if(verifPrix.test(document.getElementById("recherche").value)){
                                    document.getElementById("recherche").value = document.getElementById("recherche").value.replace(verifPrixElague.exec(document.getElementById("recherche").value),'');
                                    var euro = new RegExp("(^| )(€)( |$)");}
                                if(euro.test(document.getElementById("recherche").value)){
                                    document.getElementById("recherche").value = document.getElementById("recherche").value.replace('€','');}
                    
                                <!--Espaces superflus-->
                                document.getElementById("recherche").value = document.getElementById("recherche").value.replace('       ','');
                                document.getElementById("recherche").value = document.getElementById("recherche").value.replace('      ','');
                                document.getElementById("recherche").value = document.getElementById("recherche").value.replace('     ','');
                                document.getElementById("recherche").value = document.getElementById("recherche").value.replace('    ','');
                                document.getElementById("recherche").value = document.getElementById("recherche").value.replace('   ','');
                                document.getElementById("recherche").value = document.getElementById("recherche").value.replace('  ','');

                                <!--Autorisation-->
                                return true;   	
                            }	  
                
    <?php
} catch (Exception $e) {
    // En cas d'erreur précédemment, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}
?>
  	
        </script>





        <script type="text/javascript">

        function showValue(newValue)
        {if(newValue == 100){
                document.getElementById("prix").innerHTML="au moins 100";
            }
            else {
                document.getElementById("prix").innerHTML=newValue;
            }
        }
        </script>

        <script type="text/javascript">
        function showValue2(newValue) {
            document.getElementById("range").innerHTML=newValue; 
        }
        </script>


        <script language="Javascript1.2" type="text/javascript">

        function codeTouche(evenement)
        {
            for (prop in evenement)
            {
                if(prop == 'which') return(evenement.which);
            }
            return(evenement.keyCode);
        }

        function pressePapierNS6(evenement,touche)
        {
            var rePressePapierNS = /[cvxz]/i;

            for (prop in evenement) if (prop == 'ctrlKey') isModifiers = true;
            if (isModifiers) return evenement.ctrlKey && rePressePapierNS.test(touche);
            else return false;
        }

        function scanToucheCodePostal(evenement)
        {
            var reCarSpeciaux = /[\x00\x08\x0D\x03\x16\x18\x1A]/;
            var reCarValides = /\d/;

            var codeDecimal  = codeTouche(evenement);
            var car = String.fromCharCode(codeDecimal);
            var autorisation = reCarValides.test(car) || reCarSpeciaux.test(car) || pressePapierNS6(evenement,car);

            return autorisation;
        }

        </script>


    </head>

    <body>

        <?php
        try {
            // On se connecte à MySQL
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO('mysql:host=localhost;dbname=app2', 'root', '', $pdo_options);
            ?>


            <!--FORMULAIRE-->
            <form method="get" action="resultats.php" onSubmit="return doublon()">

                <!--Recherche-->
                <input type="text" name="recherche" id="recherche" placeholder="Rechercher" maxlength="60" style="width:230px;" onkeyup="remplir(this.value)"/>
                <input type="submit" value="Rechercher">
                    <br />

                    <!--Pays-->
                    <label for="pays"></label>	
                    <select name="pays" id="pays">
                        <option id="Pays" value="">Pays</option>
                        <?php
                        // On récupère tout le contenu de la table 
                        $reponse = $bdd->query('SELECT * FROM pays ORDER BY nom_pays');
                        // On affiche chaque entrée une à une
                        while ($donnees = $reponse->fetch()) {
                            ?>
                            <option id="Pays<?php echo $donnees['id_pays']; ?>" value="<?php echo $donnees['nom_pays'] ?>"><?php echo $donnees['nom_pays'] ?></option>
                            <?php
                        }
                        $reponse->closeCursor(); // Termine le traitement de la requête
                        ?>            

                    </select>


                    <!--Code Postal-->
                    <input type="text" name="code postal" placeholder="Code postal" maxlength="5" id="codePostal" style="width:66px;" onKeyPress="return scanToucheCodePostal(event);"/>


                    <!--Type de nourriture-->
                    <label for="type"></label>
                    <select name="type" id="type">
                        <option id="Type" value="">Type</option>
                        <?php
                        // On récupère tout le contenu de la table 
                        $reponse = $bdd->query('SELECT * FROM type ORDER BY nom_type');
                        // On affiche chaque entrée une à une
                        while ($donnees = $reponse->fetch()) {
                            ?>
                            <option id="Type<?php echo $donnees['id_type']; ?>" value="<?php echo $donnees['nom_type'] ?>"><?php echo $donnees['nom_type'] ?></option>
                            <?php
                        }
                        $reponse->closeCursor(); // Termine le traitement de la requête
                        ?>

                    </select>
                    <br />
                    <br />


                    <!--Prix-->
                    Prix : 
                    <input id="prixmoyen" type="range" name="prix" value="25" min="1" max="100" onchange="showValue(this.value)"/>
                    <span id="prix">25</span>€
                    <br />


                    <!--Note-->
                    Avis : <img src="blanc.png" id="stable" class="change_0" alt="home" /><img src="selected_star.png" name="change" class="change_1" alt="home" /><img src="selected_star.png" name="change" class="change_2" alt="home" /><img src="selected_star.png" name="change" class="change_3" alt="home" /><img src="blank_star.png" name="change" class="change_4" alt="home" /><img src="blank_star.png" name="change" class="change_5" alt="home" />
                    <input id="note" type="range" name="note" value="3" min="0" max="5"/>





                    <?php
                } catch (Exception $e) {
                    // En cas d'erreur précédemment, on affiche un message et on arrête tout
                    die('Erreur : ' . $e->getMessage());
                }
                ?>

        </form>


    </body>
</html>
