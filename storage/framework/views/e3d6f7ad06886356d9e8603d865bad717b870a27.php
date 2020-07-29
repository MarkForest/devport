<?php $__env->startSection('content'); ?>
    <div class="page__content">
        <div class="page__header">
            <h2 class="page__header_text">
                <?php echo e($user->name); ?>

            </h2>
            <a href="/logout" class="link link_contrast">Log Out</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Link</th>
                    <th>Is Active</th>
                    <th>Created At</th>
                    <th>Life Days</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>

                <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><input class="input_link" type="text" readonly value="<?php echo e($domain.'/link/'.$link->link); ?>" id="input_<?php echo e($link->link); ?>"></td>
                        <td><?php echo e($link->is_active ? 'Yes' : 'No'); ?></td>
                        <td><?php echo e($link->created_at); ?></td>
                        <td>
                            <?php
                                $current = time();
                                $life_date = strtotime('+ 7 day', strtotime($link->created_at));
                                $diff = intval(date('days', ($life_date - $current)));
                            ?>
                            <?php echo e($diff); ?>

                        </td>

                        <td>
                            <?php if($link->is_active): ?>
                                <a href="/link/<?php echo e($link->link); ?>" class="link-open link" target="_blank">Open</a>
                                <a onclick="copyFunction('input_<?php echo e($link->link); ?>')" class="link-copy link">Copy</a>
                            <?php else: ?>
                                Deactivated
                            <?php endif; ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        function copyFunction(selector) {
            console.log(selector);
            var copyText = document.getElementById(selector);

            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/

            document.execCommand("copy");

            alert("Copied the text: " + copyText.value);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/markforest/PhpstormProjects/devport/resources/views/cabinet.blade.php ENDPATH**/ ?>