if (varjs=='en') {
	alertEn();
}else{
	alertEs();
}
	function alertEn(){
    $('.espanol').html("<p>This information is only available in Spanish</p>");
    $('.ingles').html("<p></p>");
  }
  function alertEs(){
    $('.ingles').html("<p>Esta información solo está disponible en Inglés</p>");
    $('.espanol').html("<p></p>");
  }
	function mostrarInstitucion(ins){
		$('.institucion').val($('option:first').val());
			$('.anio, .insti , .institucion').css('display','none');
				$('#institucion'+ins.value).stop().delay(200).fadeIn();
	}
	function mostrarAnio(an1){
		$('.anio , .insti').val($('option:first').val());
	      $('.anio , .insti ').css('display','none');
				$('#anio'+an1.value).stop().delay(200).fadeIn();
		}
	function mostrarPdf(pdf){
		$('.insti').css('display','none');	
					$('#insti'+pdf.value).stop().delay(300).fadeIn();
		}
	function mostrarCombo(val){
		$('.anio , .insti').val($('option:first').val());
		$('.anio, .insti').css('display','none');
					console.log("Si entra "+val.value);	
					$('#'+val.value).stop().delay(300).fadeIn();
	}
	function mostrarComboPdf(val){
		$('.insti').css('display','none');
					console.log("Si entra "+val.value);	
					$('#'+val.value).stop().delay(300).fadeIn();
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

