// $('#rsvp_confirm').on('click', function () {
//     var choice = $('#rsvp1').val();
//     var paymentStatus = $('#payment_status').val();
//
//     $.ajax({
//         url: route,
//         method: 'get',
//         data: {'choice': choice, 'event_id': eventId, 'payment_status': paymentStatus}
//     }).success(function (response) {
//         $('div#rsvp-status').append(response);
//     });
// });
$('#circle_yes').on('click', function () {
    var choice = "going";
    var paymentStatus = "paid";
   

    $.ajax({
        url: route,
        method: 'get',
        data: {'choice': choice, 'event_id': eventId, 'payment_status': paymentStatus}
    }).success(function (response) {
        $('div#rsvp-status').html("You are going to this event!");
    });
});
$('#circle_no').on('click', function () {
    var choice = "not going";
    var paymentStatus = "paid";

    $.ajax({
        url: route,
        method: 'get',
        data: {'choice': choice, 'event_id': eventId, 'payment_status': paymentStatus}
    }).success(function (response) {
        $('div#rsvp-status').html("You are not going to this event");
    });
});
$('#circle_maybe').on('click', function () {
    var choice = "maybe";
    var paymentStatus = "paid";

    $.ajax({
        url: route,
        method: 'get',
        data: {'choice': choice, 'event_id': eventId, 'payment_status': paymentStatus}
    }).success(function (response) {
        $('div#rsvp-status').html("You might go to this event!");
    });
});
$('#send_email').on('click', function(){
    $.ajax({
        url: routemail,
        method: 'get'
    });
});
