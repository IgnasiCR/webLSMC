function validarLogin(formulario){

        if(formulario.login.value==null || /^\s+$/.test(formulario.login.value)){
			
				alert("Campo \"Login\" vacío o con espacios en blanco.");
				formulario.login.focus();
				formulario.login.style.backgroundColor="#FF9999";
				return false;
				}
                                
        if(!/^^(\s*[A-ZÑÁÉÍÓÚ]{1}[a-zñáéíóú]+)\_{1}(\s*[A-ZÑÁÉÍÓÚ]{1}[a-zñáéíóú]+)$/.test(formulario.login.value)){
				formulario.login.focus();
				formulario.login.style.backgroundColor="#FF9999";
				alert("Coloque el nombre de usuario con el formato correcto, ejemplo: 'Nombre_Apellido'");
				return false;
				
			}
                                
        if(formulario.password.value==null || /^\s+$/.test(formulario.password.value)){
			
				alert("Campo \"Password\" vacío o con espacios en blanco.");
				formulario.password.focus();
				formulario.password.style.backgroundColor="#FF9999";
				return false;
				}
                                
    return true;
        
}