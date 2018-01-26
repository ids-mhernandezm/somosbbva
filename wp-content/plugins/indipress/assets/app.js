if(jQuery){
	jQuery(document).ready(function(){
	
		jQuery(document).on("click", ".deleteProduct", function(){
			var target = jQuery(this).attr("data-target");
			var current = jQuery(this);
			
			jQuery.post("admin-post.php", {action: "deletecomponent", item: target }, function(response){
				if(response.message == "error"){
					alert("Intentalo nuevamente.");
				}else{	
					
					if(jQuery(current).closest("tr").length > 0 )
					{
						jQuery(current).closest("tr").fadeOut("slow");	
						console.log("TR FOUND");
					}
					else
					{
						jQuery(current).closest("li").fadeOut("slow");
						console.log("LI FOUND");
					}
				}
			}, "json");
		});
	
		jQuery(document).on("click", ".deletecat", function(){
			var target = jQuery(this).attr("data-target");
			var current = jQuery(this);
			
			jQuery.post("admin-post.php", {action: "deletecategory", item: target }, function(response){
				if(response.message == "error"){
					alert("Intentalo nuevamente.");
				}else{	
					
					if(jQuery(current).closest("tr").length > 0 )
					{
						jQuery(current).closest("tr").fadeOut("slow");	
						console.log("TR FOUND");
					}
					else
					{
						jQuery(current).closest("li").fadeOut("slow");
						console.log("LI FOUND");
					}
					
				}
			}, "json");
		});
		
		jQuery(document).on("click", ".deletefromproducts", function(){
			var target = jQuery(this).attr("data-target");
			var current = jQuery(this);
			
			jQuery.post("admin-post.php", {action: "deletefromproducts", item: target }, function(response){
				if(response.message == "error"){
					alert("Intentalo nuevamente.");
				}else{	
					
					if(jQuery(current).closest("tr").length > 0 )
					{
						jQuery(current).closest("tr").fadeOut("slow");	
						console.log("TR FOUND");
					}
					else
					{
						jQuery(current).closest("li").fadeOut("slow");
						console.log("LI FOUND");
					}
					
				}
			}, "json");
		});
	
	});
}

function addRow(id, name){
	var	html  = '<tr>';
		html += '<td>'+ id +'</td>';
		html += '<td>'+ name +'</td>';
		html += '<td class="text-center"><button class="btn btn-danger btn-sm deleteProduct" data-target="'+ id +'"> <i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar </button></td>';
		html += '</tr>';
	return html;
};

function addRowLi(id, name){
	var	html  = '<li>';
		html += '<li class="list-group-item">' + name + '<button class="btn btn-danger btn-sm pull-right deleteProduct" data-target="'+ id +'"> <i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar </button></li>';
		html += '</li>';
	return html;
};


function addPicture(id, name){
	var	html  = '<li>';
		html += '<img src="' + name +'" width="50"><button class="btn btn-danger btn-sm pull-right btn-dpi deleteProduct" data-target="'+ id + '"> <i class="fa fa-trash-o" aria-hidden="true"></i>  Eliminar </button>';
		html += '</li>';
	return html;	
}