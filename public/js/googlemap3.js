
function mapApiClientReady(){

  $(function(){

    //HTML内に記載の住所情報を取得
    var addressData = $('.address');

    currentInfoWindow = null;
    dataMaxLength = addressData.length;
    vPointCount = 0;
    vPointCountTotal = dataMaxLength;

    //データ件数分の座標データを取得する。
    addressData.each(function(i,_val){
      var addressTxt = _val.innerHTML;
      var timer = setTimeout(function(){
        getCoordinate(addressTxt);
      },500 * i);
    });
  });

}
/**
 * 住所から座標データを取得する
 * @param {String} _address 住所
 */
function getCoordinate(_address){
  //googlemap APIのGeocoderインスタンスを生成
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({'address': _address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {

      var lat = results[0].geometry.location.lat();
      var lng = results[0].geometry.location.lng();

      mapData.push({
        point:{
          lat:lat,
          lng:lng
        },
        icon:iconImg,
        address:_address,
        id:''
      });

      vAveLat += lat;
      vAveLng += lng;
      vPointCount++;

      //取得した座標データを元に地図を描画する
      if(vPointCountTotal == vPointCount){
        showMap();
      }

    }
  });
}

function showMap(){
  var y=0;
  var x=0;
  var mapOptions = {
    zoom: 15,
    center: new google.maps.LatLng((vAveLat/mapData.length)+y,(vAveLng/mapData.length)+x),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    panControl: true,
    zoomControl: true,
    mapTypeControl: false,
    scaleControl: true,
    streetViewControl: false,
    overviewMapControl: false,
    scrollwheel: false
  }

  var map = new google.maps.Map(document.getElementById("gmap3"), mapOptions);

  for (var i = 0; i < mapData.length; i++) {
    fAddBallon(mapData[i]);
  }


  /**
   * ピンをクリックした時のバルーンの表示設定
   * @param {Object} _data 地図の座標や住所のデータ
   */
  function fAddBallon(_data){
    console.log(_data);
    var id = _data.id;
    var lat = _data.point.lat;
    var lng = _data.point.lng;
    var icon = _data.icon;
    var address = _data.address;

    //所在地を表示する
    var beachMarker = new google.maps.Marker({
      position: new google.maps.LatLng(lat,lng),
      map: map,
      icon: icon
    });

    var contentString = '<div class="balloon">'+
        address +
        '</div>';



    var infowindow = new google.maps.InfoWindow({
      content: contentString
    });
    google.maps.event.addListener(beachMarker, 'click', function() {
      if (currentInfoWindow) {
        currentInfoWindow.close();
      }
      infowindow.open(map,beachMarker);
      currentInfoWindow = infowindow;
      console.log('d');
      $(".gm-style-iw").css("min-width","230px")
    });
  }
}
