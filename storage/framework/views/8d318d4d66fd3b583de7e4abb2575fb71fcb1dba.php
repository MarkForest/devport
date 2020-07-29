<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/style.css">
    <title>Register</title>
</head>
<body>
    <div class="page">
        <div class="page__content">
            <h2 class="page__header">Register</h2>
            <div class="page__form">
                <form action="" method="post" class="form">
                    <div class="form__group">
                        <label for="user_name" class="form__label">Name</label>
                        <input type="text" class="form__control" name="user_name" value="<?php echo e(old('user_name')); ?>">
                    </div>
                    <div class="form__group">
                        <label for="phone_number" class="form__label">Phone Number</label>
                        <input type="tel" class="form__control" name="phone_number" value="<?php echo e(old('phone_number')); ?>">
                    </div>
                    <button class="form__submit bg_primary" type="submit">Register</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH /Users/markforest/PhpstormProjects/devport/resources/views/index.blade.php ENDPATH**/ ?>