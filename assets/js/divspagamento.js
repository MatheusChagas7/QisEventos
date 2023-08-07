$(document).ready(function(){	
	
		$('#basico').click(function(){
		$('#p1').fadeIn(0);
		$('#divpagamento').fadeOut(0);
		$('#p2').fadeOut(0);
		$('#p3').fadeOut(0);
		$('#buyerData').fadeOut(0);
	});

		$('#medio').click(function(){
		$('#p2').fadeIn(0);
		$('#divpagamento').fadeOut(0);
		$('#p1').fadeOut(0);
		$('#p3').fadeOut(0);
		$('#buyerData').fadeOut(0);
	});
	
		$('#master').click(function(){
		$('#p3').fadeIn(0);
		$('#divpagamento').fadeOut(0);
		$('#p2').fadeOut(0);
		$('#p1').fadeOut(0);
		$('#buyerData').fadeOut(0);
	});
	
	$('#bp1').click(function(){
	document.getElementById("precop").innerHTML = "1,99";
	document.getElementById('pagp').value = '2A9051AD4747B11004682FBE98E8639E'
		});
		
			$('#bp2').click(function(){
	document.getElementById("precop").innerHTML = "11,94";
	document.getElementById('pagp').value = '7287F6E4B5B589688426EF98C9975D75'
		});
		
			$('#bp3').click(function(){
	document.getElementById("precop").innerHTML = "23,88";
	document.getElementById('pagp').value = '2DE1FCCCE7E7111BB4A70FBCFA7057F6'
		});
				
				
				
				
					$('#bm1').click(function(){
	document.getElementById("precom").innerHTML = "3,99";
	document.getElementById('pagm').value = '1477EC861A1A73ECC4845FABA97A1DFE'
		});
		
			$('#bm2').click(function(){
	document.getElementById("precom").innerHTML = "23,94";
	document.getElementById('pagm').value = 'CB98E4CA1111332CC492DF9376C1968E'
		});
		
			$('#bm3').click(function(){
	document.getElementById("precom").innerHTML = "47,88";
	document.getElementById('pagm').value = '871CBBFFACAC22D664198FA8D4DC77A0'
		});	
		
	});
	

	

                                               
                        