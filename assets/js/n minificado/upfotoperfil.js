$("document").ready(function(){
var $uploadCrop,
		tempFilename,
		rawImg,
		imageId;
		function readFile(input) {
 			if (input.files && input.files[0]) {
              		var reader = new FileReader();
	           	reader.onload = function (e) {
					$('#upload-demo-perfil').addClass('ready');
					$('#modal-perfil').modal('show');
		            rawImg = e.target.result;
	            }
	            reader.readAsDataURL(input.files[0]);
	        }
	        else {
		        swal("Desculpe esse navegador nao suporta esta tecnologia");
		    }
		}

		$uploadCrop = $('#upload-demo-perfil').croppie({
			viewport: {
				width: 150,
				height: 150,
			enforceBoundary: false,
			enableExif: true
			},
		
		});
		$('#modal-perfil').on('shown.bs.modal', function(){
			// alert('Shown pop');
			$uploadCrop.croppie('bind', {
        		url: rawImg
        	}).then(function(){
        		console.log('jQuery bind complete');
        	});
		});
		$('#upperfil').on('change', function () { imageId = $(this).data('id'); tempFilename = $(this).val();
		$('#cancelCropBtn-perfil').data('id', imageId); readFile(this); });
		$('#cortarImageBtn-perfil').on('click', function (ev) {
			$uploadCrop.croppie('result', {
				type: 'base64',
				format: 'jpg',
				size: {width: 250, height: 250}
			}).then(function (resp) {
				$('#id_fp').attr('src', resp);
				$('#tupperfil').val(resp);
				$('#modal-perfil').modal('hide');
				 
			});
		});
						});
		
