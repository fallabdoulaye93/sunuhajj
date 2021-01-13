jQuery(function($){

				
    $.datepicker.regional['fr-CH'] = {
        closeText: 'Fermer',
        prevText: 'Mois précédent',
        nextText: 'Mois suivant',
        currentText: 'Courant',
        monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
        'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
        monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun',
        'Jul','Aoû','Sep','Oct','Nov','Déc'],
        dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
        dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
        dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
        weekHeader: 'Sm',
        dateFormat: 'dd-mm-yy',
        firstDay: 1,
        isRTL: false,
		//color: "#134B84",
        showMonthAfterYear: false,
        yearSuffix: ''};
    $.datepicker.setDefaults($.datepicker.regional['fr-CH']);
});

    $.datepicker.setDefaults({
    yearRange: '1927:2030',
	//color: "#134B84",
   // defaultDate: -365*20  
	});

$(function() {
        $( "#from" ).datepicker({
            changeYear: true  // afficher un selecteur d'année
        });
		$( "#to" ).datepicker({
            changeYear: true  // afficher un selecteur d'année
        });
		$( "#date_transaction" ).datepicker({
            changeYear: true  // afficher un selecteur d'année
        });
		$( "#date_reception" ).datepicker({
            changeYear: true  // afficher un selecteur d'année
        });
		$( "#date_vente" ).datepicker({
            changeYear: true  // afficher un selecteur d'année
        });
    $( "#datenais" ).datepicker({
        changeYear: true  // afficher un selecteur d'année
    });
    });   
