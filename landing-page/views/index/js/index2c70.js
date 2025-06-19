

window.onload = function(){
   //mostrarModal();
   if(document.getElementById("btncontactar") != null){
      const btncontactar = document.getElementById("btncontactar");
      //document.getElementById("txtnombres").focus();
      btncontactar.onclick = function (){
          let txtnombre = document.getElementById("txtnombre"),
              txtemailr = document.getElementById("txtemailr");
              const btnprogress = "<i class='fa fa-spinner fa-spin '></i> ";
        
          if(txtemailr.value.trim() == ''){          
               let contenido = "El correo es requerido.";
                mensaje_error(txtemailr,contenido);
               return;
           }
           if(txtnombre.value.trim() == ''){          
              let contenido = "El nombre es requerido.";
               mensaje_error(txtnombre,contenido);
              return;
          }
  
     
          this.disabled = true;
          this.innerHTML = btnprogress + this.innerHTML;
          const myForm = document.getElementById('frmcontacto');
          let formData = new FormData(myForm);
           requestSand({
              url: geturl()+'contacto/envioCorreosSuscribete',
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
function mostrarModal(){
   $("#basicModal").modal("toggle");
}