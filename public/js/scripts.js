jQuery('document').ready(function ($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let currentPage = 1;
    $('#load-more').bind('click', function (e) {
        console.log('button pressed!');
        var data = {
            page: currentPage
        };
        $.ajax({
            url: '/post/load',
            data: data,
            type: "POST",
            success: function (responce) {
                currentPage += 1;
                console.log(data)
                for(var i in responce) {
                    $('.container').append(responce[i]);
                    if(responce.length < 20) {
                        $('.load-more-container').remove();
                    } else {
                        $('.load-more-container').appendTo('.container');
                    }
                }
            }
        })
    })
})
