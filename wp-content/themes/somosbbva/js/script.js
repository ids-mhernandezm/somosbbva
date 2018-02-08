function swap_search(){
		if($('#icon').css('display') === 'block'){
			document.getElementById("buscador").style.display="block";
		 	document.getElementById("icon").style.display="none";
		 	document.getElementById("input").focus();
		}else{
			document.getElementById("icon").style.display="block";
		 	document.getElementById("buscador").style.display="none";
		} 
	}

$(document).on('ready',function() {

	pantalla();
	function pantalla(){
	  pant = $(window).width();
	  // console.info( 'la pantalla mide ' + pant + 'px' );
	  if(pant < 993){
	  	$('.fondo').css("height",'auto');
        $('.separador').css("text-align",'center'); 
        $('.margenA').css("margin-left",'0px'); 
	  }
	  else{
	  	$('.fondo').css("height",'240');
		$('.separador').css("text-align",'left');	 	
	  }
	  if (pant < 769) {
	  	$('.lista-redes').css('marginLeft','-30px');
        $('.margenA').css("margin-left",'20px');    
	  	$('.menu-mobile .col-xs-2 img').css('float','right');
        $('.btn-lower-space').css('margin-top','30px');
        $('.credenciales p').css('font-size','12px');
        $('.bordeEstruc').css('border','none');
          
	  }else{
	  	$('.lista-redes').css('marginLeft','-12px');
	  	$('.credenciales p').css("font-size",'14px');
        $('.margenB').css('margin-left','14px');
        $('.bordeEstruc').css('border','3px solid #09549A');
	  }
	}

$(window).resize(
  	function(){
  		pantalla();
  	})
});

