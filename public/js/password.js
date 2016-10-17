$(document).ready(function(){
    $('#rrr').hide();
    $('#sub').submit(function (event) {
        var form = $(this);
        event.preventDefault();
        var abb = [];
        $.each($("input[name='event_type']:checked"),
            function () {
                abb.push($(this).val());
            });
        $('#che').val(abb);
        form.unbind(event);
        form.trigger('submit');
    });
    $('#fff').on('click',function(){
          $.ajax({
            url:'/password',
            type:'POST',
            data:{
                '_token' : $('#token').val(),
                'current_pass': $('#current').val(),
                'new_pass' : $('#new').val(),
                're_new_pass' : $('#re').val()

            }
        }).success(function(response){
            response = JSON.parse(response);
            var result=response.result;
              $('#rrr').slideDown('500');
            $('#rrr').html(result);


        });
    });
});