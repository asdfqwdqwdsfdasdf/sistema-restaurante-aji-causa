(function ($) {
    // USE STRICT
    "use strict";

        $(document).ready(function () {
            let image = geturl()+'views/layout/default/img/logo-mapa2.png'; 
            function initMap() {
                var map;
                var bounds = new google.maps.LatLngBounds();
                var mapOptions = {
                    mapTypeId: 'roadmap',
                    
                };
                map = new google.maps.Map(document.getElementById("map"), mapOptions);
                map.setTilt(50);
                var markers = [
                    ['La Molina', -12.0696833, -76.9508105],
                    ['Miraflores', -12.1280591,-77.0100369]
                ];
            
                //var image = 'views/layout/default/img/logo-mapa2.png';   
                                    
                // Info window content
                var infoWindowContent = [
                    ['<div class="info_content">' +
                    '<h3>La Molina</h3>' +
                    '<p>Av Javier Prado Este 6326 La Molina, Lima, Perú Teléfono 01 3487802</p>' + '</div>'],
                    ['<div class="info_content">' +
                    '<h3>Miraflores</h3>' +
                    '<p>Av Alfredo Benavides 2392 Miraflores, Lima, Perú Teléfono 01 4492145</p>' +
                    '</div>']
                ];
            
                // Add multiple markers to map
                var infoWindow = new google.maps.InfoWindow(), marker, i;
                
                // Place each marker on the map  
                for( i = 0; i < markers.length; i++ ) {
                    var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                    bounds.extend(position);
                    marker = new google.maps.Marker({
                        position: position,
                        map: map,
                        title: markers[i][0],
                        icon: image,
                        animation: google.maps.Animation.BOUNCE
                    });
                    
                    // Add info window to marker    
                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                            infoWindow.setContent(infoWindowContent[i][0]);
                            infoWindow.open(map, marker);
                        }
                    })(marker, i));
            
                    // Center the map to fit all markers on the screen
                    map.fitBounds(bounds);
                }
            

                /************************** */
                var citymap = {
                    molina: {
                      center: {lat: -12.0696833, lng:  -76.9508105},
                      population: 2714
                    },
                    miraflores: {
                      center: {lat: -12.1280591, lng: -77.0100369},
                      population: 4005
                    }
                  };
                          // Create the map.
     /*   var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: {lat: -12.0988712, lng: -76.9804237},
            //mapTypeId: 'terrain'
          });*/
  
          for (var city in citymap) {
            // Add the circle for this city to the map.
            var cityCircle = new google.maps.Circle({
              strokeColor: '#00FF407A',
              strokeOpacity: 0.8,
              strokeWeight: 2,
              fillColor: '#00FF407A',
              fillOpacity: 0.35,
              map: map,
              center: citymap[city].center,
              radius: Math.sqrt(citymap[city].population) * 100,
              icon: image,
              animation: google.maps.Animation.BOUNCE
            });
          }

                /******************************* */
                // Set zoom level
                var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
                    this.setZoom(12);
                    google.maps.event.removeListener(boundsListener);
                });
                
            }

            function init2(){
                var citymap = {
                    molina: {
                      center: {lat: -12.0696833, lng:  -76.9508105},
                      population: 2714
                    },
                    miraflores: {
                      center: {lat: -12.1280591, lng: -77.0100369},
                      population: 4005
                    }
                  };
                          // Create the map.
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: {lat: -12.0988712, lng: -76.9804237},
            //mapTypeId: 'terrain'
          });
  
          // Construct the circle for each value in citymap.
          // Note: We scale the area of the circle based on the population.
          for (var city in citymap) {
            // Add the circle for this city to the map.
            var cityCircle = new google.maps.Circle({
              strokeColor: '#FF0000',
              strokeOpacity: 0.8,
              strokeWeight: 2,
              fillColor: '#FF0000',
              fillOpacity: 0.35,
              map: map,
              center: citymap[city].center,
              radius: Math.sqrt(citymap[city].population) * 100,
              icon: image,
              animation: google.maps.Animation.BOUNCE
            });
          }
  
            }
            // Load initialize function
            google.maps.event.addDomListener(window, 'load', initMap);
            

 
    //Google map end



           /* var selector_map = $('#google_map');
            var img_pin = selector_map.attr('data-pin');
            var data_map_x = selector_map.attr('data-map-x');
            var data_map_y = selector_map.attr('data-map-y');
            var scrollwhell = selector_map.attr('data-scrollwhell');
            var draggable = selector_map.attr('data-draggable');
            var map_zoom = selector_map.attr('data-zoom');

            if (img_pin == null) {
                img_pin = 'views/layout/default/img/logo-ft.png';
            }
            if (data_map_x == null || data_map_y == null) {
                data_map_x = 40.007749;
                data_map_y = -93.266572;
            }
            if (scrollwhell == null) {
                scrollwhell = 0;
            }

            if (draggable == null) {
                draggable = 0;
            }

            if (map_zoom == null) {
                map_zoom = 5;
            }

            var style = [
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [
                    {
                        "color": "#e9e9e9"
                    },
                    {
                        "lightness": 17
                    }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [
                    {
                        "color": "#f5f5f5"
                    },
                    {
                        "lightness": 20
                    }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [
                    {
                        "color": "#ffffff"
                    },
                    {
                        "lightness": 17
                    }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [
                    {
                        "color": "#ffffff"
                    },
                    {
                        "lightness": 29
                    },
                    {
                        "weight": 0.2
                    }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [
                    {
                        "color": "#ffffff"
                    },
                    {
                        "lightness": 18
                    }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [
                    {
                        "color": "#ffffff"
                    },
                    {
                        "lightness": 16
                    }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [
                    {
                        "color": "#f5f5f5"
                    },
                    {
                        "lightness": 21
                    }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [
                    {
                        "color": "#dedede"
                    },
                    {
                        "lightness": 21
                    }
                    ]
                },
                {
                    "elementType": "labels.text.stroke",
                    "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#ffffff"
                    },
                    {
                        "lightness": 16
                    }
                    ]
                },
                {
                    "elementType": "labels.text.fill",
                    "stylers": [
                    {
                        "saturation": 36
                    },
                    {
                        "color": "#333333"
                    },
                    {
                        "lightness": 40
                    }
                    ]
                },
                {
                    "elementType": "labels.icon",
                    "stylers": [
                    {
                        "visibility": "off"
                    }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [
                    {
                        "color": "#f2f2f2"
                    },
                    {
                        "lightness": 19
                    }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.fill",
                    "stylers": [
                    {
                        "color": "#fefefe"
                    },
                    {
                        "lightness": 20
                    }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [
                    {
                        "color": "#fefefe"
                    },
                    {
                        "lightness": 17
                    },
                    {
                        "weight": 1.2
                    }
                    ]
                }
            ];

            var latitude = data_map_x,
                longitude = data_map_y;

            var locations = [
                ['<div class="infobox"><h4>Hello</h4><p>Now that you visited our website, how' +
                ' <br>about checking out our office too?</p></div>'
                    , latitude, longitude, 2]
            ];

            if (selector_map !== undefined) {
                var map = new google.maps.Map(document.getElementById('google_map'), {
                    zoom: Number(map_zoom),
                    zoomControl: false,  
                    disableDoubleClickZoom: true,
                    scrollwheel: scrollwhell,
                    navigationControl: true,
                    mapTypeControl: false,
                    scaleControl: false,
                    draggable: draggable,
                    styles: style,
                    center: new google.maps.LatLng(latitude, longitude),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
            }

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {

                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    icon: img_pin
                });

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
*/

    if(document.getElementById("btncontactar") != null){
    const btncontactar = document.getElementById("btncontactar");
    //document.getElementById("txtnombres").focus();
    btncontactar.onclick = function (){
        let txtnombre = document.getElementById("txtnombre"),
            txtemailr = document.getElementById("txtemailr"),
            txttelefono = document.getElementById("txttelefono"),
		    txtamensaje = document.getElementById("txtamensaje");
            const btnprogress = "<i class='fa fa-spinner fa-spin '></i> ";
		

         if(txtnombre.value.trim() == ''){          
            let contenido = "El nombre es requerido.";
             mensaje_error(txtnombre,contenido);
            return;
        }

         if(txtemailr.value.trim() == ''){          
            let contenido = "El correo es requerido.";
             mensaje_error(txtemailr,contenido);
            return;
        }

         if(txttelefono.value.trim() == ''){          
            let contenido = "El telefono es requerido.";
             mensaje_error(txttelefono,contenido);
            return;
        }
        
         if(txtamensaje.value.trim() == ''){          
            let contenido = "El Mensaje es requerido.";
             mensaje_error(txtamensaje,contenido);
            return;
		    }

   
        this.disabled = true;
        this.innerHTML = btnprogress + this.innerHTML;
        const myForm = document.getElementById('frmcontacto');
        let formData = new FormData(myForm);
         requestSand({
            url: geturl()+'contacto/envioCorreos',
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


 
