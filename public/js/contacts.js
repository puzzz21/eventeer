$('#group').submit(function () {
    $.ajax({
        url: 'addgroup',
        type: 'GET',
        data: {
            '_token': $('#token').val(),
            'group_name': $('#group_name').val()
        }
    }).success(function () {

    });
});

$('.del').on('click', function () {
    var that = $(this);
    var parent = that.parent().parent();

    $.ajax({
        url: 'deleteGrp',
        data: {'id': that.attr('data-value')}
    }).success(function (response) {
        if (response.success) {
            parent.remove();
            var table = $('#contact-table');
            var grandparent = table.parent();

            if (table.children().length == 0) {
                grandparent.empty();

                grandparent.append($('<div/>', {
                    class: 'form-group text-center',
                    html: 'No Groups available.'
                }));
            }
        }
    });
});

$('#add').on('click', function (event) {
    var form = $(this);
    event.preventDefault();
    var abb = [];
    $.each($("input[name='email']:checked"),
        function () {
            abb.push($(this).val());
        });
    $('#selectedEmails').val(abb);
    $('#groupID').val($('#group_id').val());
    $('#groupNAME').val($('#group_name').val());
    form.unbind(event);
    form.trigger('submit');
    $.ajax({
        url: '/addEmail',
        type: 'GET',
        data: {
            '_token': $('#token').val(),
            'selectedEmails': $('#selectedEmails').val(),
            'groupID': $('#groupID').val(),
            'groupNAME': $('#groupNAME').val()
        }
    });

});

// $('#group-update').submit(function(){
//     $.ajax({
//         url:'updateC',
//         type:'GET',
//         data:{
//             '_token': $('#token').val(),
//             'group_id':$('#group_id').val(),
//             'group_name': $('#group_name').val()
//         }
//     }).success(function(){
//
//     });
// });