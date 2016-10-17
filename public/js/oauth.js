function getContacts() {
    var data = {
        'client_id': 'CLIENT_ID', // use your client_id.
        'scope': 'https://www.google.com/m8/feeds'
    };

    gapi.auth.authorize(data, function () {
        var token = gapi.auth.getToken();
        var url = "https://www.google.com/m8/feeds/contacts/default/full?access_token=" + token.access_token + "&alt=json";

        $.ajax({
            url: url,
            dataType: "json"
        }).success(function (data) {
            var modal = $('#contactModal');

            modal.on('show.bs.modal', function (event) {
                var parent = $('div#contents');
                var key = 'gd$email';

                for (var i=0; i<data.feed.entry.length; i++) {
                    var j = i+1;

                    parent.append($('<div class="form-group text-left">' + j + '.' + ' ' + data.feed.entry[i][key][0].address + '<div/>'));
                }

                // aru kaam gar
            });

            modal.modal('show');
        });
    });
}
