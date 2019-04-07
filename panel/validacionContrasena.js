function validarContrasena(formulario){

        if(formulario.contrasenaVieja.value==null || /^\s+$/.test(formulario.contrasenaVieja.value)){
			
				alert("Campo \"Contraseña Antigua\" vacío o con espacios en blanco.");
				formulario.contrasenaVieja.focus();
				formulario.contrasenaVieja.style.backgroundColor="#FF9999";
				return false;
				}

        if(formulario.contrasenaNueva1.value==null || /^\s+$/.test(formulario.contrasenaNueva1.value)){
			
				alert("Campo \"Contraseña Nueva\" vacío o con espacios en blanco.");
				formulario.contrasenaNueva1.focus();
				formulario.contrasenaNueva1.style.backgroundColor="#FF9999";
				return false;
				}
                                
        if(!/^(?=(.*[0-9]))(?=.*[\!@#$%^&*()\\[\]{}\-_+=~`|:;"'<>,./?])(?=.*[a-z])(?=(.*[A-Z]))(?=(.*)).{8,16}$/.test(formulario.contrasenaNueva1.value)){
				formulario.contrasenaNueva1.focus();
				formulario.contrasenaNueva1.style.backgroundColor="#FF9999";
				alert("La contraseña escogida no cumple con los requisitos mínimos.");
				return false;
				
			}
                        
         if(formulario.contrasenaNueva2.value==null || /^\s+$/.test(formulario.contrasenaNueva2.value)){
			
				alert("Campo \"Contraseña Nueva\" vacío o con espacios en blanco.");
				formulario.contrasenaNueva2.focus();
				formulario.contrasenaNueva2.style.backgroundColor="#FF9999";
				return false;
				}
                                
        if(!/^(?=(.*[0-9]))(?=.*[\!@#$%^&*()\\[\]{}\-_+=~`|:;"'<>,./?])(?=.*[a-z])(?=(.*[A-Z]))(?=(.*)).{8,16}$/.test(formulario.contrasenaNueva1.value)){
				formulario.contrasenaNueva2.focus();
				formulario.contrasenaNueva2.style.backgroundColor="#FF9999";
				alert("La contraseña escogida no cumple con los requisitos mínimos.");
				return false;
				
			}                
                                
    return true;
        
}