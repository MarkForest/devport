<?php $__env->startSection('content'); ?>
    <input type="hidden" value="<?php echo e($link->id); ?>" name="link_id">
    <div class="panel-buttons">
        <button class="panel-button lucky">Im feeling lucky</button>
    </div>
    <div class="game">
        <div class="ball"></div>
        <div class="goal"></div>
    </div>
    <div class="panel-buttons right">
        <button class="panel-button history">History</button>
        <form action="/link/new" method="post">
            <?php echo e(csrf_field()); ?>

            <button type="submit" class="panel-button new">New Link</button>
        </form>
        <form action="/link/deactivate" method="post">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" value="<?php echo e($link->id); ?>" name="link_id">
            <button type="submit" class="panel-button deactivate">Deactivate</button>
        </form>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(function () {
            $('.lucky').on('click', () => {
                $('.lucky').prop('disabled', true);
                let link_id = $('input[name=link_id]').val();
                $.ajax({
                    type: 'post',
                    url: '/random',
                    data: {'_token': '<?php echo csrf_token() ?>', 'link_id': link_id},
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
                            }, 1500, 'linear', function () {
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
                                }, 2500);
                            });
                        } else {
                            $('.ball').animate({
                                'left': (ball_left + 450)+'px',
                                'bottom': (ball_bottom + 50)+'px',
                            }, 1500, 'linear', function () {
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
                                }, 2500);
                            });
                        }
                    }
                });
            });
            $('.history').on('click', () => {
                $('.history').prop('disabled', true);
                let link_id = $('input[name=link_id]').val();
                $.ajax({
                    type: 'post',
                    url: '/history',
                    data: {'_token': '<?php echo csrf_token() ?>', 'link_id': link_id},
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
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/markforest/PhpstormProjects/devport/resources/views/game.blade.php ENDPATH**/ ?>