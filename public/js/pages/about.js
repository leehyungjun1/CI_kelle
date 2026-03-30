if (KAKAO_KEY && KAKAO_KEY !== 'YOUR_KAKAO_JS_KEY') {
    var s = document.createElement('script');
    s.src = 'https://dapi.kakao.com/v2/maps/sdk.js?appkey=' + KAKAO_KEY + '&autoload=false';
    s.onload = function () {
        kakao.maps.load(function () {
            var map = new kakao.maps.Map(document.getElementById('kakaoMap'), {
                center: new kakao.maps.LatLng(CENTER_LAT, CENTER_LNG),
            level: 4
        });
            var marker = new kakao.maps.Marker({
                position: new kakao.maps.LatLng(CENTER_LAT, CENTER_LNG),
            map: map
        });
            new kakao.maps.InfoWindow({
                content: '<div style="padding:7px 12px;font-size:13px;font-weight:700;">한국평생교육관리센터</div>'
            }).open(map, marker);
        });
    };
    document.head.appendChild(s);
} else {
    document.getElementById('kakaoMap').innerHTML =
        '<div style="display:flex;align-items:center;justify-content:center;height:100%;color:#4a7ee6;font-size:13px;">' +
        '<i class="fa fa-map-marker" style="margin-right:6px;"></i>카카오맵 API 키를 입력해주세요.</div>';
}