jQuery('document').ready(function ($) {
    /**
     * Добавление CSRF-токена к AJAX-запросам
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /**
     * Дозагрузка постов
     * @type {number}
     */
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
                    if(responce.length < 20) {          //чет как то не хорошо TODO: по новой миша
                        $('.load-more-container').remove();
                    } else {
                        $('.load-more-container').appendTo('.container');
                    }
                }
            }
        })
    })

    /**
     * Кнопка "ответить"
     */
    $('.commentary-reply-button').click(function (e) {
        e.preventDefault();

        if ($('.comment-form-container .parent-comment').length) {
            $('.comment-form-container .parent-comment').remove();
        }

        let parentId = parseInt($(this).data('commentary-id'));
        $('#commentary-form #commentary-parent-id').val(parentId);

        let replyComment = $(`.parent-comment[data-commentary-id=${parentId}]`).clone().addClass('replied-comment').removeClass('parent-comment');
        replyComment.find('.comment-control-section').remove();
        replyComment.find('.child-comment').remove();
        replyComment.find('.parent-comment').removeClass('parent-comment').addClass('mb-1');
        replyComment.find('.media-body').removeClass('border-bottom');

        $('#commentary-form').before(replyComment);
        $('.comment-form-title').text('Ответ на комментарий');

        $("html, body").animate({ scrollTop: $(".comment-form-container").offset().top }, 100);
    });

    /**
     * AJAX-добавление комментария
     */
    $('#commentary-form button[type=submit]').click(function (e) {
        e.preventDefault();
        let data = $('#commentary-form').serializeArray();
        $.ajax({
            url: $('#commentary-form').attr('action'),
            method: 'POST',
            data: data,
            success: function (responce) {
                console.log(responce);
                $('.replied-comment').remove();
                if(responce.parent_id === undefined) {
                    console.log('test')
                    $('.commentary-section .parent-comment').last().after(responce.htmlOutput);
                } else {
                    $(`div[data-commentary-id=${responce.parent_id}]`).append(
                        `<div class="ml-4 child-comment">${responce.htmlOutput}</div>`);
                }
                $('#commentary-form')[0].reset();

                $("html, body").animate({ scrollTop: $(`.parent-comment[data-commentary-id=${responce.commentary_id}]`).offset().top - ($(window).height() / 2)  }, 100);

                let commentaryCount = parseInt($(".commentary-count").text());
                $(".commentary-count").text(commentaryCount + 1)

                if($('.no-comments-message').length) {
                    $('.no-comments-message').remove();
                }
            },
            error: function (xhr, status) {
                let responce = JSON.parse(xhr.responseText);

                if (xhr.status == 403) {
                    $('#commentary-content + .invalid-feedback').text('Нет доступа');
                }
                if(xhr.status == 422) {
                    $('#commentary-content + .invalid-feedback').text(responce.errors.content).show();
                }
            }
        })
    })

    $('.add-to-blacklist-form_button').click(function (e) {
        e.preventDefault();
        $(this).parent('form.add-to-blacklist-form').submit();
    })
})
