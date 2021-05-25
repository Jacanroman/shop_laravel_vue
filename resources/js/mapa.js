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
            apikey: 'apikey' // reemplazamos con nuestra api key 
        });

        

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
                console.log(error);

                console.log(resultado.address);

                marker.bindPopup(resultado.address.LongLabel);
                marker.openPopup();

            })


        });

        
    }
});