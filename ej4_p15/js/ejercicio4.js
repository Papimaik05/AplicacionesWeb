$(document).ready(function() {

	 $("#validEmail").hide();
	 $("#validUser").hide();

	$("#campoEmail").change(function(){
		const campo = $("#campoEmail"); // referencia jquery al campo
		campo[0].setCustomValidity(""); // limpia validaciones previas

		// validación html5, porque el campo es <input type="email" ...>
		const esCorreoValido = campo[0].checkValidity();
		 if (esCorreoValido && correoValidoComplu(campo.val())) {
			// el correo es válido y acaba por @ucm.es: marcamos y limpiamos quejas
		
			// tu código aquí: coloca la marca correcta
			validar=document.getElementById("validEmail");
			validar.innerHTML="&#x2714";
			$("#validEmail").show();
			campo[0].setCustomValidity("");
		 } else {			
		 	// correo invalido: ponemos una marca y nos quejamos

			// tu código aquí: coloca la marca correcta
		 	validar=document.getElementById("validEmail");
		 	validar.innerHTML="&#x26a0";
		 	$("#validEmail").show();
			campo[0].setCustomValidity(
		 		"El correo debe ser válido y acabar por @ucm.es");
		 }
	});

	
	$("#campoUser").change(function(){
		var url = "comprobarUsuario.php?user=" + $("#campoUser").val();
		$.get(url,usuarioExiste);
  });


  function correoValidoComplu(correo) {
	const dominio = "@ucm.es";
	const index = correo.indexOf(dominio);
	if (index === -1) {
	  return false; // el dominio no está presente en el correo
	}
	const subcadena = correo.substring(0, index); // extrae la subcadena antes del dominio
	return subcadena.length > 0; // devuelve true si la subcadena tiene longitud mayor que cero
  }
  

  function usuarioExiste(data,status) {
	// Tu codigo aquí
		if (status == "success") {
			if (data == 'disponible') {
				validar=document.getElementById("validUser");
				validar.innerHTML="&#x2714";
				$("#validUser").show();
			}
			else if (data == 'existe') {
				validar=document.getElementById("validUser");
				validar.innerHTML="&#x26a0";
				$("#validUser").show();
				alert("Ese nombre ya está reservado");
			}
			else{
				$("#validUser").hide();
			}
		}
	}
})