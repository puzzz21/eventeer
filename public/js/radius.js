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
            // document.getElementById("abc").value = response;

            var parent = $('#eventThumbnail');
            response = JSON.parse(response);

            var lat = response.lat;
            var lng = response.lng;
            var radius = response.radius;
            var a= response.a;

            var re = new RegExp(/^.*\//);
            var url = re.exec(window.location.href);

            parent.empty();

            for (var j=0; j<=a.length; j++) {
                if (typeof a[j] != 'undefined') {
                    var eventDiv = $('<div/>', {
                        class: 'col-sm-3'
                    }).append("<img src=" + url + "/public/upload/" + a[j].logo + " style='height:250px;width:450px;'/><p><strong>" + a[j].event_name + "</strong></p><p>" + a[j].venue + "</p><p>" + a[j].event_start_datetime + "</p><a href=" + url + "/events/" + a[j].id + "><button class='btn btn-primary'>Details...</button></a>");

                    parent.append(eventDiv);
                }
            }

            // $("#abc").val(y);
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

                        window.location.href = "http://localhost:9000/events/" + locations[i][0];
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
