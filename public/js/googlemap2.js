function makeMap(lat, lng) {
    var canvas = document.getElementById('map-canvas'); // 地図を表示する要素を取得

    var latlng = new google.maps.LatLng(lat, lng);  // 中心の位置（緯度、経度）

    var mapOptions = {  // マップのオプション
        zoom: 17,
        center: latlng,
    };
    var map = new google.maps.Map(canvas, mapOptions); //作成
    return map;
  }

  //ページのロードが完了したら地図を読み込む
  window.onload = function(){
      makeMap(35.446806, 139.636163);
  };
