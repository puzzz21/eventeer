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
                'searchDate': $('#search').val()
            }
        }).success(function (response) {
            response = JSON.parse(response);

            var lat = response.lat;
            var lng = response.lng;
            var radius = response.radius;

            var map = new google.maps.Map(document.getElementById('ma'), {
                zoom: 14,
                center: new google.maps.LatLng(lat, lng),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
        });
    });
});
