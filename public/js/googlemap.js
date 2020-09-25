
  var map;
  var marker;
  var geocoder;
  var address;

  function initMap() {


    geocoder = new google.maps.Geocoder();
    address = document.getElementById('address').innerHTML;

    geocoder.geocode(

      { 'address': address }, //住所


      function(results, status) {

          if (status === google.maps.GeocoderStatus.OK) {

              map = new google.maps.Map(document.getElementById('gmap'), {
                center: results[0].geometry.location,
                zoom: 15, //ズーム
                map: google.maps.MapTypeId.ROADMAP,
                panControl: true,
                zoomControl: true,
                mapTypeControl: true,
                scaleControl: true,
                streetViewControl: true,
                overviewMapControl: true,
                scrollwheel: true
              });

              marker = new google.maps.Marker({
                position: results[0].geometry.location,
                map: map
              });

              // infoWindow = new google.maps.InfoWindow({
              // content: '<h4>アルサーガパートナーズ</h4>'
              // });

              marker.addListener('click', function() {
                infoWindow.open(map, marker);
              });

          } else {
            // alert(status);
          }

      }

    );
}
