$(document).ready(function () {
    $('#submit').on('click', function (event) {
        var abb = [];

        $.each($("input[name='event_type']:checked"),
            function () {
                abb.push($(this).val());
            });
        $('#che').val(abb);


        $.ajax({
            url: '/radSearch',
            type: 'POST',
            data: {
                '_token': $('#token').val(),
                'radius': $('#radius').val(),
                'tags': $('#tags').val(),
                'checked': $('#che').val(),
                'searchDate': $('#search').val(),
                'lat': $('#lat').val(),
                'lng': $('#lng').val()
            }
        }).success(function (response) {
            response = JSON.parse(response);

            var lat = response.lat;

            var lng = response.lng;
            var radius = response.radius;

            var a= response.a;

            var locations=[];
            for(var i=0; i<a.length;i++) {
                locations.push([a[i]['id'], a[i]['event_name'], a[i]['venue'], a[i]['latitude'], a[i]['longitude']]);
            }

            var map = new google.maps.Map(document.getElementById('ma'), {
                zoom: 14,
                center: new google.maps.LatLng(lat,lng),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][3], locations[i][4]),
                    map: map
                });

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {

                        window.location.href = "http://localhost:8000/events/" + locations[i][0];
                    }
                })(marker, i));

                google.maps.event.addListener(marker, 'mouseover', (function (marker, i) {
                    return function () {
                        infowindow.setContent(locations[i][1] + "<br/>" + locations[i][2]);
                        infowindow.open(map, marker);

                    }
                })(marker, i));
                google.maps.event.addListener(marker, 'mouseout', (function (marker, i) {
                    return function () {
                        infowindow.close();
                    }
                })(marker, i));
            }
        });
    });
});
