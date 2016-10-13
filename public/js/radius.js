$('#submit').on('click',function () {

    $.ajax({
        url: '/radius',
        type: 'POST',
        data: {
            'radius': $('#radius').val(),
            'tags': $('#tags').val(),
            'checked': $('#che').val(),
            'searchDate': $('#search').val()
        },
        success: {
            alert("Dfsf");
        }
    });


});