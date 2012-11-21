$(document).ready(function() {
	$('#txtpensamento').limit('140','#charsLeft');

//libera
	$('#txtpensamento').click(function() {
		$('#msgerro').fadeOut();
		$('#sucesssend').fadeOut();
	});

//send
$("#msgerro").hide();
                  $("#btnenviar").click(function(){
		  $.post("app/controller.php",{
                        textThink:$("#txtpensamento").val(),
                        userFace:$("#userFace").val(),
                        nameFace:$("#nameFace").val(),
                        uidFace:$("#uidFace").val(),
                        locationFace:$("#locationFace").val()
				},
		  function(data){

		     $("#msgerro").fadeIn();
		     $("#msgerro").html(data);

		  }
		  ,"html");
              });
});



$(document).ready(function() {
	$('#cvbtblue').hide();
	$('#cvbtgreen').hide();
	$('#cvbtyellow').hide();
	
	$('.selectcolor').click(function() {
		 	var exp =   $(this).attr("id");
			var arr = exp.split('/');

			$(".ocut").hide();
			$("#txtcover").val("coversquare/" + arr[1]);
			$('#cv'+arr[0]).fadeIn();
			
	});
});

//slider
 $(document).ready(function() {
		var carousel = $("#carousel").featureCarousel({
          trackerSummation:false,
          trackerIndividual:false,
		  largeFeatureWidth:461,
          largeFeatureHeight:272,
		  smallFeatureWidth:230,
          smallFeatureHeight:136,
		  smallFeatureOffset:30,
          sidePadding:3
        });

        $("#prev").click(function () {
          carousel.prev();
        });
        $("#pause").click(function () {
          carousel.pause();
        });
        /*$("#but_start").click(function () {
          carousel.start();
        });*/
        $("#next").click(function () {
          carousel.next();
        });

});


$(document).ready(function() {
	
		 $('.carousel-feature').click(function() {
		
		 	/*var exp =   $(this).attr("id");
			var arr = exp.split('/');*/

			$("#idcom").val($(this).attr("id"));
			
			
		});

          $(".compar").click(function(){
	
		  $.post("app/compartilhar.php",{
                        textThink:$("#caption").val(),
                        image:$("#picture").val(),
						idcom:$("#idcom").val()
				},
		  function(data){

		     $("#msgerro").fadeIn();
		     $("#msgerro").html(data);

		  }
		  ,"html");
              });
});


$(document).ready(function() {
	
		 

          $(".compar").click(function(){

		  $.post("index.php",{
			  			textThink:$("#caption").val(),
                        image:$("#picture").val(),
						idcom:$("#idcom").val(),
                        acao:'publish'
				},
		  function(data){

		     $("#msgerro").fadeIn();
		     $("#msgerro").html(data);

		  }
		  ,"html");
              });
});