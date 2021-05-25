import {OpenStreetMapProvider} from 'leaflet-geosearch';
const provider = new OpenStreetMapProvider();


document.addEventListener('DOMContentLoaded', () => {

    if(document.querySelector('#mapa')){

   
        const lat = 53.3901659;
        const lng = -2.9565194;

        const mapa = L.map('mapa').setView([lat, lng], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);

        let marker;

        // agregar el pin
        marker = new L.marker([lat, lng],{
            draggable: true,
            autoPan:true
        }).addTo(mapa);

        //Creando Geocode Service

        const geocodeService = L.esri.Geocoding.geocodeService({
            apikey: 'AAPK11a24f9a279a45788f8eb3da37ddaa52i0K2WPe75sE2EYcY_QKy0WUBPFmZYoAscNW_k4uP-9cGYtpZp75sXFVzsfZ10wyt' // reemplazamos con nuestra api key 
        });

        //Buscador de direcciones

        const search = document.querySelector('#formbuscador');

        search.addEventListener('blur', searchAddress);

        

        

        //Detect movement of the marker

        marker.on('moveend', function(e){
            //console.log('soltaste el pin');
            marker = e.target;

            /* para saber los metodos disponibles al hacer console.log(marker)
            vamos a la opcion _proto_ y estan todos los metodos disponibles*/

            const position = marker.getLatLng();

            //Centrar automaticamente

            mapa.panTo(new L.LatLng(position.lat, position.lng));
        
            //Reverse Geocoding, cuando el usuario reubica el pin
            geocodeService.reverse().latlng(position,16).run(function(error, resultado){
                //console.log(error);

                //console.log(resultado.address);

                marker.bindPopup(resultado.address.LongLabel);
                marker.openPopup();


                //LLenar los campos

                llenarInputs(resultado);

            })


        });

        function llenarInputs(resultado){
            document.querySelector('#address').value = resultado.address.Address || '';
            document.querySelector('#lat').value = resultado.latlng.lat || '';
            document.querySelector('#lng').value = resultado.latlng.lng || '';

        }

        function searchAddress(e){

            //console.log(provider)
            if(e.target.value.length > 1){
                provider.search({query: e.target.value + ' Liverpool UK '})
                    .then(resultado =>{
                        if(resultado[0]){
                            geocodeService.reverse().latlng(resultado[0].bounds[0],16).run(function(error, resultado){
                                //console.log(error);
                
                                console.log(resultado);
                
                                //marker.bindPopup(resultado.address.LongLabel);
                                //marker.openPopup();
                
                
                                //LLenar los campos
                
                                //llenarInputs(resultado);
                
                            })
                        }
                    })
                    .catch(error =>{
                        console.log(error);
                    })
            }
            
        }
    }
});