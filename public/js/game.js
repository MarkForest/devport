$(function () {
    // Настраиваеем Ajax, для прохождения csrf защиты laravel
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Событие клика по кнопке 'Мне повезет'
    $('.lucky').on('click', () => {
        $('.lucky').prop('disabled', true);
        let link_id = $('input[name=link_id]').val();
        $.ajax({
            type: 'post',
            url: '/random',
            data: {'link_id': link_id},
            success: function (data) {
                data = JSON.parse(data);
                let random = parseInt(data.random);
                let ball_left = $('.ball').css('left');
                let ball_bottom = $('.ball').css('bottom');
                ball_left = parseInt(ball_left.replace('px', ''));
                ball_bottom = parseInt(ball_bottom.replace('px', ''));
                if (random % 2 != 0) {
                    $('.ball').animate({
                        'left': (ball_left + 450)+'px',
                        'bottom': (ball_left + 250)+'px'
                    }, 1000, 'linear', function () {
                        $('.page').css('filter', 'blur(15px)');
                        $('.modal-lose').fadeIn();
                        $('.modal-lose').css('display', 'flex');
                        setTimeout(()=>{
                            $('.modal-lose').fadeOut();
                            $('.page').css('filter', 'none');
                            $('.ball').css('left', ball_left+'px');
                            $('.ball').css('bottom', ball_bottom+'px');
                            $('.lucky').prop('disabled', false);
                            $('.copyright').text('Last Random: ' + data.random + ', Last Amount: ' + data.amount);
                        }, 3000);
                    });
                } else {
                    $('.ball').animate({
                        'left': (ball_left + 450)+'px',
                        'bottom': (ball_bottom + 50)+'px',
                    }, 1000, 'linear', function () {
                        $('.page').css('filter', 'blur(15px)');
                        $('.wins-amount').text('Amount: ' + data.amount);
                        $('.modal-wins').fadeIn();
                        $('.modal-wins').css('display', 'flex');
                        setTimeout(()=>{
                            $('.modal-wins').fadeOut();
                            $('.page').css('filter', 'none');
                            $('.ball').css('left', ball_left);
                            $('.ball').css('bottom', ball_bottom);
                            $('.lucky').prop('disabled', false);
                            $('.copyright').text('Last Random: ' + data.random + ', Last Amount: ' + data.amount);
                        }, 3000);
                    });
                }
            }
        });
    });

    // Событие клика по кнопки 'История'
    $('.history').on('click', () => {
        $('.history').prop('disabled', true);
        let link_id = $('input[name=link_id]').val();
        $.ajax({
            type: 'post',
            url: '/history',
            data: {'link_id': link_id},
            success: function (data) {
                data = JSON.parse(data);
                $('.page').css('filter', 'blur(15px)');
                if(data[0] != undefined) {
                    $('.history-first').text('Random: ' + data[0]['random'] + ', Amount: ' + data[0]['amount']);
                }
                if(data[1] != undefined) {
                    $('.history-second').text('Random: ' + data[1]['random'] + ', Amount: ' + data[1]['amount']);
                }
                if(data[2] != undefined) {
                    $('.history-third').text('Random: ' + data[2]['random'] + ', Amount: ' + data[2]['amount']);
                }

                $('.modal-history').fadeIn();
                $('.modal-history').css('display', 'flex');
                setTimeout(()=>{
                    $('.modal-history').fadeOut();
                    $('.page').css('filter', 'none');
                    $('.history').prop('disabled', false);
                }, 2500);
            }
        });
    })
});
