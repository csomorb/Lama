<div class="bloc-journal" id="content">
<?php
try {
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=lama', 'root', '');
}
catch(Exception $e) {
	// En cas d'erreur, on affiche un message et on arrête tout
	die('Erreur : '.$e->getMessage());
}
$reponse = $bdd->query('SELECT * FROM journal ORDER BY numero DESC');
while ($donnees = $reponse->fetch()) {
	echo "<div class=\"flex_journal\">";
	echo "\t<div class=\"gr1\">";
	echo "\t\t<div class=\"article\">";
	echo "\t\t\t<div class=\"gr2\">";
	echo "\t\t\t\t<div class=\"date\"><p>".$donnees['date']."</p></div>\n";
	echo "\t\t\t\t<div class=\"text\"><p>".$donnees['text']."</p></div>\n";
	echo "\t\t\t\t<div class=\"nu\"><p>#".$donnees['numero']."</p></div>\n";
	echo "\t\t\t</div>\n";
	echo "\t\t</div>\n";
	echo "\t</div>\n";
	echo "</div>\n";
	$req = $bdd->query('SELECT * FROM photo_journal WHERE id_journal ='.$donnees['id']);
	while ($donnees2 = $req->fetch()) {
		echo "<div class=\"flex_journal\">";
		echo "\t<a class=\"lightbox_trigger\" href=\"img/journal/".$donnees2['nom']."\">";
		echo "\t<img src=\"img/journal/".$donnees2['nom']."\" alt=\"".$donnees2['alt']."\" class=\"art_".$donnees['id']."\"></a>\n";
		echo "</div>\n";
	}
}
$reponse->closeCursor(); // Termine le traitement de la requête
?>
</div>
<div id='page_navigation'></div> 
<input type='hidden' id='current_page' />  
<input type='hidden' id='show_per_page' /> 
<input type='hidden' id='number_page' /> 
<script src="script/jquery-2.1.4.min.js"></script>	
<script>
jQuery(document).ready(function($) {
	$('.lightbox_trigger').click(function(e) {
		e.preventDefault();
		var image_href = $(this).attr("href");
		var image_class_groupe =  $(this).children().attr("class");
		if ($('#lightbox').length > 0) {
			$('#content_lightbox').html('<img src="' + image_href + '" arti="'+image_class_groupe +'" class="current"/>');
			$('#lightbox').show();
			$('#lightbox_suivant_lien').show();
			$('#lightbox_precedent_lien').show();
		}
		else { 
		var lightbox = 
		'<a href=#prec id="lightbox_precedent_lien"><img src="img/point_noir.png" class="lightbo_precedent"/></a><div id="lightbox">' +
		'<div id="content_lightbox">' + 
			'<img src="' + image_href +'" arti="'+image_class_groupe+'" class="current" />' +
		'</div>' +	
		'</div><a href=#next id="lightbox_suivant_lien"><img src="img/point_noir.png" class="lightbo_suivant"/></a>';
		$('body').append(lightbox);
		}
	});
	

	$(document).on('click','#lightbox_suivant_lien',(function(e){
		e.preventDefault();
		var image_href = $('.current').attr("src");
		var image_class = $('.current').attr("arti");
		var image_suvante = $('[src="'+image_href+'"]:not([class="current"])').parent().parent().next().children().children().attr("src");
		if(typeof image_suvante === 'undefined'){
			image_suvante = $('[src="'+image_href+'"]:not([class="current"])').parent().parent().prev().children().children().attr("src");
			var img_reserve = image_suvante;
			while(typeof image_suvante !== 'undefined'){
				img_reserve = image_suvante;
				image_suvante = $('[src="'+img_reserve+'"]:not([class="current"])').parent().parent().prev().children().children().attr("src");
			}
			image_suvante  = img_reserve;
			if (typeof image_suvante === 'undefined')
				image_suvante = image_href;
		}	
		$('#content_lightbox').html('<img src="' + image_suvante + '" class="current"/>');
	}));
	
	$(document).on('click','#lightbox_precedent_lien',(function(e){
		e.preventDefault();
		var image_href = $('.current').attr("src");
		var image_class = $('.current').attr("arti");
		var image_prev = $('[src="'+image_href+'"]:not([class="current"])').parent().parent().prev().children().children().attr("src");
		if(typeof image_prev === 'undefined'){
			image_prev = $('[src="'+image_href+'"]:not([class="current"])').parent().parent().next().children().children().attr("src");
			var img_reserve = image_prev;
			while(typeof image_prev !== 'undefined'){
				img_reserve = image_prev;
				image_prev = $('[src="'+img_reserve+'"]:not([class="current"])').parent().parent().next().children().children().attr("src");
			}
			image_prev  = img_reserve;
			if (typeof image_prev === 'undefined')
				image_prev = image_href;			
		}	
		$('#content_lightbox').html('<img src="' + image_prev + '" class="current"/>');
	}));
		
	$(document).on('click','#lightbox', function() {
			$('#lightbox').hide();
			$('#lightbox_suivant_lien').hide();
			$('#lightbox_precedent_lien').hide();
	});
});

$(document).ready(function(){   
    var show_per_page = 30;    
    var number_of_items = $('#content').children().size();   
    var number_of_pages = Math.ceil(number_of_items/show_per_page);   
    $('#current_page').val(0);  
    $('#show_per_page').val(show_per_page);  
    $('#number_page').val(number_of_pages);   
    var navigation_html = '<a class="previous_link" href="javascript:previous();"><img src="img/prev.png" class="fleche_journal"></a>';  
    var current_link = 0;  
    while(number_of_pages > current_link){  
        navigation_html += '<a class="page_link" href="javascript:go_to_page(' + current_link +')" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>';  
        current_link++;  
    }  
    navigation_html += '<a class="next_link" href="javascript:next();"><img src="img/next.png" class="fleche_journal"></a>';  
    $('#page_navigation').html(navigation_html);   
    $('#page_navigation .page_link:first').addClass('active_page');   
    $('#content').children().css('display', 'none');   
    $('#content').children().slice(0, show_per_page).css('display', 'block'); 
    fadeprev(); 
});  
  
function previous(){  
    new_page = parseInt($('#current_page').val()) - 1;  
    if($('.active_page').prev('.page_link').length==true){  
        go_to_page(new_page);  
    }  
}  

function fadeprev(){
	if ($('#current_page').val() == 0){
		$('.previous_link').hide();
	}
	else
		$('.previous_link').show();	
}

function fadenext(){
	if ($('#current_page').val() == $('#number_page').val()-1){
		$('.next_link').hide();
	}
	else
		$('.next_link').show();	
}
  
function next(){  
    new_page = parseInt($('#current_page').val()) + 1;    
    if($('.active_page').next('.page_link').length==true){  
        go_to_page(new_page);  
    }  
  
}  
function go_to_page(page_num){   
    var show_per_page = parseInt($('#show_per_page').val());  
    start_from = page_num * show_per_page;   
    end_on = start_from + show_per_page;   
    $('#content').children().css('display', 'none').slice(start_from, end_on).css('display', 'block');  
    $('.page_link[longdesc=' + page_num +']').addClass('active_page').siblings('.active_page').removeClass('active_page');    
    $('#current_page').val(page_num);  
    fadeprev();
    fadenext();
} 
</script>
