$(document).ready(function () {
    $('#submit').on('click',function (event) {
        event.preventDefault();
        var form = $(this);

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
                '_token' : '{{ csrf_token() }}',
                'radius': $('#radius').val(),
                'tags': $('#tags').val(),
                'checked': $('#che').val(),
                'searchDate': $('#search').val()
            }
        }).success(function (response) {
            // TODO: map stuff.
            response = JSON.parse(response);
            var lat = response.lat;
            var lng = response.lng;
            var radius = response.radius;

            var map = new google.maps.Map(document.getElementById('ma'), {
                zoom: 14,
                center: new google.maps.LatLng(lat, lng),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            console.log(JSON.parse(response));
        });

        form.unbind(event);
    });
});
