<!DOCTYPE html>
<?php
include reservclient_recuptab.php;
include reservclient_chgtjour.php;
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <meta charset="utf-8" />

<html>
    <head>
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
		<script src="http://jquery-ui.googlecode.com/svn/trunk/ui/i18n/jquery.ui.datepicker-fr.js"></script>

        <script>
        var places = new Array();
        var unavailableDates = new Array();
        var chaineNue = <?php $tab ?>;
        var places = chaineNue.split(' ');
        
            difference = 0;
            var jour1;
            var nbrPersonnesPrefere = '';
  
	        $(document).ready(function() {
	        	
	        	document.getElementById("invites").style.display = "none"
            	document.getElementById("moment").style.display = "none"
            	document.getElementById("date").style.display = "none"
            	document.getElementById("jourSemaine").style.display = "none"

	        	var j;
	        	var k;
	        	for (var i=0;i<21;i=i+3){
	        		j = parseInt(i + 1);
	        		k = parseInt(i + 2);
					if(places[i] == '0' && places[j] == '0' && places[k] == '0'){
						var date2 = $.datepicker._determineDate($('#date').data('datepicker'), + (1 + i/3)  , new Date());
						var dateStr2 = $.datepicker.formatDate('d-m-yy', date2, {dayNames: $.datepicker.regional['fr'].dayNames, monthNames: $.datepicker.regional['fr'].monthNames, dayNamesShort: $.datepicker.regional['fr'].dayNamesShort, monthNamesShort: $.datepicker.regional['fr'].monthNamesShort});
						unavailableDates = unavailableDates.concat(dateStr2);
						}
	        	}
						
	         	
	            $("#datepicker").datepicker({
	            	minDate: 1,
	                maxDate: +7,
	                hideIfNoPrevNext: true,
	                altField: "#date",
	                altFormat: "!",
	                dateFormat: "!",
	                beforeShowDay: jourOuvrable,
	                onSelect : function(){
	                	document.getElementById("invites").style.display = "block"
            			document.getElementById("moment").style.display = "block"

	                    jour2 = document.getElementById("date").value;
	                    difference = (jour2 - jour1)/864000000000 ;

						var date = $.datepicker._determineDate($('#date').data('datepicker'), + (difference + 1)  , new Date());
						var dateStr = $.datepicker.formatDate('DD d MM yy', date, {dayNames: $.datepicker.regional['fr'].dayNames, monthNames: $.datepicker.regional['fr'].monthNames, dayNamesShort: $.datepicker.regional['fr'].dayNamesShort, monthNamesShort: $.datepicker.regional['fr'].monthNamesShort});
						document.getElementById("titre").innerHTML = dateStr;
						document.getElementById("dateReservee").innerHTML = dateStr;
						momentsdispos();
						placesdispos();
		            }
		         });			           
	         
		         jour1 = document.getElementById("date").value;

   	         });


			function jourOuvrable(date) {
			  dmy = date.getDate() + "-" + (date.getMonth()+1) + "-" + date.getFullYear();
			  if ($.inArray(dmy, unavailableDates) < 0) {
			    return [true,"",""];
			  } else {
			    return [false,"",""];
			  }
			}


            function momentsdispos(){
				
				nbreplacesMat = places[difference*3];
				nbreplacesMid = places[difference*3 + 1];
				nbreplacesSoi = places[difference*3 + 2];
	           	soi=document.getElementById("soi");
				mid=document.getElementById("mid");
				mat=document.getElementById("mat");

				if(nbreplacesSoi == 0){
					soi.style.display = "none";
					soi.disabled = true;}
				else{soi.style.display = "list-item";
					soi.disabled = false;
					soi.selected = true;}
				
				if(nbreplacesMid == 0){
					mid.style.display = "none";
					mid.disabled = true;}
				else{mid.style.display = "list-item";
					mid.disabled = false;
					mid.selected = true;}

				if(nbreplacesMat == 0){
					mat.style.display = "none";
					mat.disabled = true;}
				else{mat.style.display = "list-item";
					mat.disabled = false;
					mat.selected = true;}
			}

			function placesdispos(){
				if(mat.selected){moment=0;
				document.getElementById("momentReserve").innerHTML = "prendre le petit-déjeuner";}
				if(mid.selected){moment=1;
				document.getElementById("momentReserve").innerHTML = "déjeuner";}
				if(soi.selected){moment=2;
				document.getElementById("momentReserve").innerHTML = "dîner";}
				soi=document.getElementById("soi");
				mid=document.getElementById("mid");
				mat=document.getElementById("mat");

				nbreplaces = parseInt(places[difference*3 + parseInt(moment)]);
				for(var i=1;i<=35;i++){
					if(i<=nbreplaces){
						document.getElementById(i).style.display = "list-item";
						document.getElementById(i).disabled=false;}
						
					else{
						document.getElementById(i).style.display="none";
						document.getElementById(i).disabled=true;}
				}
			
				document.getElementById(nbreplaces).selected = true;
				document.getElementById("personnes").innerHTML = nbreplaces;
				document.getElementById("jourSemaine").value = nbreplaces;

				
			}
			
			function modifierPersonnes(nbr){
				document.getElementById("personnes").innerHTML = nbr;
				document.getElementById("jourSemaine").value = nbr;

			}

        </script>

    </head>
    <body style="font-size:62.5%;">

        <p><input type="text" id="date"></p>
        
        <TABLE BORDER="0">
<TR><TD> <div id="datepicker"></div> </TD>
<TD>        <div id="titre"></div>

        <form method="post" action="reservclient_submit.php">
       

            <label for="moment"></label>	
            <select name="moment" id="moment" onChange="placesdispos()">
                <option id="mat" value="0">Petit Déjeuner</option>
                <option id="mid" value="1">Déjeuner</option>
                <option id="soi" value="2">Dîner</option>
            </select>

            <label for="invites"></label>	
            <select name="invites" id="invites" onChange="modifierPersonnes(this.value)">
                <?php
                for ($i = 1; $i <= 35; $i++) {
                    ?> <option id="<?php echo $i ?>" value=" <?php echo $i ?>"><?php echo $i; ?></option>
                     <?php
                }
                ?>
            </select>
            
            <input type="text" id="jourSemaine">


</TD></TR>
</TABLE>

Vous souhaitez réserver une table de <span id="personnes">…</span> personnes le <span id="dateReservee">…</span> pour <span id="momentReserve">…</span>.

<br />

<input type="submit" value="Réserver">

           </form>


    </body>
</html>
