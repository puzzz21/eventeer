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

$('#del').on('click',function(){
   $.ajax({
    url:'deleteGrp',
           dataType: 'JSON',
       data: {
           'id' : $('#idVal').val()
       }
   }    
   ).success(function (response) {
    var obj=response;

       document.getElementById("fff").innerHTML =
           obj.group_name + "<br>" +
           obj.id ;
      // var res= JSON.parse(reponse);
      //
      //  var group_name = res.group_name;
      //  $('#gn').html(group_name);
           
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