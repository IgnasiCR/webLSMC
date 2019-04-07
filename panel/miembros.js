function cargaUsuarios(boton){
					
					var filaUsuarios=boton.parentNode.parentNode.parentNode;
					var hijosUsuarios=filaUsuarios.children;
					var misUsuarios=document.getElementsByClassName("misUsuarios")[0];
				
					misUsuarios.login.value=hijosUsuarios[0].innerHTML;
                                        misUsuarios.login.setAttribute("readonly", "readonly");
                                        misUsuarios.nombre.value=hijosUsuarios[1].innerHTML;
                                        misUsuarios.apellidos.value=hijosUsuarios[2].innerHTML;
					misUsuarios.password.value=hijosUsuarios[3].innerHTML;
					misUsuarios.rol.value=hijosUsuarios[4].innerHTML;
                                        misUsuarios.puesto.value=hijosUsuarios[5].innerHTML;
                                        misUsuarios.salario.value=hijosUsuarios[6].innerHTML;
					
					// Activar botón de actualizar.
					
					misUsuarios.actualizaUsuarios.style.display='inline';
					misUsuarios.anadeUsuarios.style.display='none';
					
				}
                                
function validarUsuarios(formulario){

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
                                
        if(formulario.nombre.value==null || /^\s+$/.test(formulario.nombre.value)){
			
				alert("Campo \"Nombre\" vacío o con espacios en blanco.");
				formulario.nombre.focus();
				formulario.nombre.style.backgroundColor="#FF9999";
				return false;
				}
                                
        if(formulario.apellidos.value==null || /^\s+$/.test(formulario.apellidos.value)){
			
				alert("Campo \"Apellidos\" vacío o con espacios en blanco.");
				formulario.apellidos.focus();
				formulario.apellidos.style.backgroundColor="#FF9999";
				return false;
				}
                                
        if(formulario.rol.value==null || /^\s+$/.test(formulario.rol.value)){
			
				alert("Campo \"Rol\" vacío o con espacios en blanco.");
				formulario.rol.focus();
				formulario.rol.style.backgroundColor="#FF9999";
				return false;
				}
                                
    return true;
        
}                                