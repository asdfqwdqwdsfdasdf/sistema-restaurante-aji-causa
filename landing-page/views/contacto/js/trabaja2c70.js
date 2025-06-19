(function ($) {
// USE STRICT
    "use strict";
        $(document).ready(function () {
    let exten = ['doc','docx','pdf'];
    if(document.getElementById("btncontactar") != null){
    const btncontactar = document.getElementById("btncontactar");
    //document.getElementById("txtnombres").focus();
    btncontactar.onclick = function (){
        let txtnombre = document.getElementById("txtnombre"),
            txtapellido = document.getElementById("txtapellido"),
            txtdireccion = document.getElementById("txtdireccion"),
            txttelefono = document.getElementById("txttelefono"),
            txtemailr = document.getElementById("txtemailr");
		    filecv = document.getElementById("filecv");
            const btnprogress = "<i class='fa fa-spinner fa-spin '></i> ";
		

         if(txtnombre.value.trim() == ''){          
            let contenido = "Los nombres son  requerido.";
             mensaje_error(txtnombre,contenido);
            return;
        }
        if(txtapellido.value.trim() == ''){          
            let contenido = "Los Apellidos es requerido.";
             mensaje_error(txtapellido,contenido);
            return;
        }
        if(txtdireccion.value.trim() == ''){          
            let contenido = "La dirección es requerido.";
             mensaje_error(txtdireccion,contenido);
            return;
        }
        if(txttelefono.value.trim() == ''){          
            let contenido = "El telefono es requerido.";
             mensaje_error(txttelefono,contenido);
            return;
        }
         if(txtemailr.value.trim() == ''){          
            let contenido = "El correo es requerido.";
             mensaje_error(txtemailr,contenido);
            return;
        }
        if(filecv.files.length == 0){
            let contenido = "El CV es requerido.";
            mensaje_error_file(filecv,contenido);
            return;
        }else{

            if(!exten.includes(extensionfile(filecv.files[0].name))){          
                let contenido = "El formato del archivo es incorrecto.";
                mensaje_error_file(filecv,contenido);
                return;
            }
            if(filecv.files[0].size > 524288){          
                let contenido = "El archivo es demaciado grande.";
                mensaje_error_file(filecv,contenido);
                return;
            }
        }    




       /*  if(txtamensaje.value.trim() == ''){          
            let contenido = "El Mensaje es requerido.";
             mensaje_error(txtamensaje,contenido);
            return;
		    }
*/
   
        this.disabled = true;
        this.innerHTML = btnprogress + this.innerHTML;
        const myForm = document.getElementById('frmcontacto');
        let formData = new FormData(myForm);
         requestSand({
            url: geturl()+'contacto/envioCorreosTrabaja',
            method: "POST",
            data: formData,
            dataType: "json",
            processData: false,
            loadstart : (e) =>{
            },
            success: (response) => {
                if(response.estado == '1'){
                    const msn = Swal.fire({
                        icon: 'success',
                        title: response.msg
                      })
                     
                  }else{
                    const msn = Swal.fire({
                        icon: 'error',
                        title: response.msg
                    })
                    console.log(response.msg);
                  }
                document.getElementById("btncontactar").disabled = false;
                document.getElementById("btncontactar").firstChild.remove();
                myForm.reset();

            },
            error: (e) => {
                console.log("No se ha podido obtener la información");
            },
            timeout: 20000
        })
        }
    }
    if(document.getElementById("filecv") != null){
        document.getElementById("filecv").onchange = function(){
            //console.log(this.files);
            if(this.nextElementSibling.nextElementSibling != null){
                this.nextElementSibling.nextElementSibling.remove();
            }
            if(!exten.includes(extensionfile(this.files[0].name))){          
                let contenido = "El formato del archivo es incorrecto.";
                mensaje_error_file(this,contenido);
                 return;
            }
            if(this.files[0].size > 524288){          
                let contenido = "El archivo es demaciado grande.";
                mensaje_error_file(this,contenido);
                 return;
            }
            //var archivo = document.getElementById("uploadPhotos");
        }
    }
    function mensaje_error(input,data){
        let label = input;
        //console.log(label,label.nextElementSibling);
        if(label.nextElementSibling.nextElementSibling == null){
          let span = document.createElement("span");
          span.className = "list-errores";
          span.innerHTML = data;
          label.parentElement.appendChild(span);
        }
        label.focus();
    }
    function mensaje_error_file(input,data){
        let label = input;
        //console.log(label,label.nextElementSibling);
        if(label.nextElementSibling.nextElementSibling == null){
          let span = document.createElement("span");
          span.className = "list-errores";
          span.innerHTML = data;
          label.parentElement.appendChild(span);
        }
        label.focus();
    }
    function extensionfile(fname){
        return fname.slice((Math.max(0, fname.lastIndexOf(".")) || Infinity) + 1);
    }

    const divContenido  = document.getElementById('frmcontacto');
        if(divContenido != null){
          divContenido.addEventListener('keypress', e => {
            const t = e.target;
            if(t.classList.contains("limp")){
               // console.log(t.nextElementSibling.nextElementSibling );
                if(t.nextElementSibling.nextElementSibling != null){
                    t.nextElementSibling.nextElementSibling.remove();
                }
            }
          });
        }
        if(document.getElementById('ckleido') != null){
            document.getElementById('ckleido').onclick  = function () {
                //console.log(this);
                if(this.classList.contains("limp")){
                    if(this.parentElement.nextElementSibling != null){
                        this.parentElement.nextElementSibling.remove();
                    }
                }
            } 
        }
           
              
        
	}); // End document ready

})(this.jQuery);	


 
