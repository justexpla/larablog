jQuery('document').ready(function ($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let currentPage = 1;
    $('#load-more').bind('click', function (e) {

        let userId = parseInt($(this).data('user'));
        let data = {
            user_id: userId,
            page: currentPage
        };

        let ajaxUrl = function(userId) {
            if (userId) {
                return `/user/${userId}/load`
            } else {
                return '/post/load'
            }
        }

        $.ajax({
            url: ajaxUrl(userId),
            data: data,
            type: "POST",
            success: function (responce) {
                currentPage += 1;
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

    $('#commentary-form button[type=submit]').click(function (e) {
        e.preventDefault();
        let data = $('#commentary-form').serializeArray();
        $.ajax({
            url: $('#commentary-form').attr('action'),
            method: 'POST',
            data: data,
            success: function (responce) {
                console.log(responce)
                $('.commentary-section .parent-comment').last().append(responce);
                $('#commentary-form')[0].reset();
            }
        })
    })
})
