<?php $__env->startSection('content'); ?>
    <div class="page__content">
        <h2 class="page__header">Register</h2>
        <div class="page__form">
            <?php echo $__env->make('auth._errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <form action="/register" method="post" class="form">
                <?php echo e(csrf_field()); ?>

                <div class="form__group">
                    <label for="user_name" class="form__label">Name</label>
                    <input type="text" class="form__control" name="name" value="<?php echo e(old('user_name')); ?>">
                </div>
                <div class="form__group">
                    <label for="phone_number" class="form__label">Phone Number</label>
                    <input type="text" class="form__control" name="phone_number" value="<?php echo e(old('phone_number')); ?>">
                </div>
                <button class="form__submit bg_primary" type="submit">Register</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/markforest/PhpstormProjects/devport/resources/views/auth/register.blade.php ENDPATH**/ ?>