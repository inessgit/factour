$(document).ready(function(){
	$("#page-icheck-all div.icheckbox_minimal-grey ins").click(function(){
		console.log("Go-go-go");
		if(  ($('#page-icheck-all div.icheckbox_minimal-grey').hasClass('checked') ) ){
			$('#candidat-menu-page label.page-icheck div.icheckbox_minimal-grey').addClass('checked');
		}
		else{
			$('#candidat-menu-page label.page-icheck div.icheckbox_minimal-grey').removeClass('checked');						
		}
		// $('.page-check').prop('checked', false);
	});


	
})

function addToMenu(candidatMenuDivId, objectType, afterMenuId, MenuId) {
	// console.log( $('#'+ candidatMenuDivId));
    $('#'+ candidatMenuDivId).each(function(){
    	// Parcourrir la liste des  div.icheckbox_minimal-grey
       	if($(this).hasClass('checked')){
       		var objectId = $(this).children( "input[type='checkbox']" ).attr('value');
		var after = $("#"+afterMenuId).find(":selected").val();
		var menu = $("#"+MenuId).find(":selected").val();
		var lienFinal = '{{ path("ajax_add_menu_new", {"type":"letype", "objectId":"lid","afterMenuId":"lapres", "menuId":""lemenu})|escape("js") }}';
		lienFinal = lienFinal.replace('lid', objectId);
		lienFinal = lienFinal.replace('lapres', after);     		
		lienFinal = lienFinal.replace('letype', objectType);
		lienFinal = lienFinal.replace('lemenu', menu);	
		alert(lienFinal);	
		/*if(objectType == "page"){
       			lienFinal = lienFinal.replace('letype', 'page');
       		}*/
       		//Requette ajax pour ajouter l'objet au menu
		$.ajax({
		    type: "GET",
		    url: lienFinal,
		    success: function(data){
			alert(data);
		    }
		});
       	}
   	});
}
