<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/style.css">
    <title>DevPort</title>
</head>
<body>
    <div class="page">
        <?php echo $__env->yieldContent('content'); ?>
        <div class="copyright">
            <span class="copyright_contrast">
                Марченко Анатолий
            </span>
            <a href="tel:+380674939720">+38(067)-493-97-20</a>
        </div>
    </div>
    <div class="modal-wins">
        <h1 class="wins-text">WIN</h1>
        <h1 class="wins-amount"></h1>
        <div class="modal-wins__form">

        </div>
    </div>
    <div class="modal-lose">
        <h1 class="lose-text">LOSE</h1>
        <h1 class="lose-amount">Amount: 0</h1>
        <div class="modal-lose__form">

        </div>
    </div>
    <div class="modal-history">
        <h1 class="history-first"></h1>
        <h1 class="history-second"></h1>
        <h1 class="history-third"></h1>
    </div>
    <script src="/js/jquery-3.5.1.min.js"></script>
    <?php echo $__env->yieldContent('script'); ?>
</body>
</html>
<?php /**PATH /Users/markforest/PhpstormProjects/devport/resources/views/layouts/master.blade.php ENDPATH**/ ?>