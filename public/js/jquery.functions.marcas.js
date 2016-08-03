	function ActualizarDatos(){
		var idMarca = $('#idMarca').attr('value');
		var NombreMarca = $('#NombreMarca').attr('value');
		var DescripcionMarca = $('#DescripcionMarca').attr('value'); 
		var imagenMarca = $('#imagenMarca').attr('value'); 


		$.ajax({
			url: 'Capa_negocio/Marca/actualizar.php',
			type: "POST",
			data: "submit=&NombreMarca="+NombreMarca+"&DescripcionMarca="+DescripcionMarca+"&imagenMarca="+imagenMarca+"&idMarca="+idMarca,
			success: function(datos){
				alert(datos);
				ConsultaDatos();
				$("#formulario").hide();
				$("#tabla").show();
			}
		});
		return false;
	}
	
	function ConsultaDatos(){
		$.ajax({
			url: 'pintarTabla_Marca.php',
			cache: false,
			type: "GET",
			success: function(datos){
				location.reload(); 
			}
		});
	}
	

	function EliminarDato(idMarca){
		var msg = confirm("Desea eliminar este dato?")
		if ( msg ) {
			$.ajax({
				url: 'Capa_negocio/Marca/eliminar.php',
				type: "GET",
				data: "idMarca="+idMarca,
				success: function(datos){
					alert(datos);
					$("#fila-"+idMarca).remove();
					ConsultaDatos(); 
				}
			});
		}
		return false;
	}
	
	function GrabarDatos(){
		var NombreMarca = $('#NombreMarca').attr('value');
		var DescripcionMarca = $('#DescripcionMarca').attr('value'); 
		var imagenMarca = $("#imagenMarca").attr("value");
		

		$.ajax({
			url: 'Capa_negocio/Marca/nuevo.php',
			type: "POST",
			data: "submit=&NombreMarca="+NombreMarca+"&DescripcionMarca="+DescripcionMarca+"&imagenMarca="+imagenMarca,
			success: function(datos){
				ConsultaDatos();
				alert(datos);
				$("#formulario").hide();
				$("#tabla").show();
			}
		});
		return false;
	}

	function Cancelar(){
		$("#formulario").hide();
		$("#tabla").show();
		return false;
	}
	
