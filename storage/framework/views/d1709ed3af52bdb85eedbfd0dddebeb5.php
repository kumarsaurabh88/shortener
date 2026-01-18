

<?php $__env->startSection('title', 'Create Short URL'); ?>

<?php $__env->startSection('content'); ?>
    <div style="max-width: 600px;">
        <div class="card">
            <h2>Create Short URL</h2>
            <p style="color: #6b7280; margin-bottom: 1.5rem;">Enter a long URL to create a short link</p>

            <form method="POST" action="<?php echo e(route('urls.store')); ?>">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <label for="original_url">Original URL *</label>
                    <input type="url" id="original_url" name="original_url" 
                           placeholder="https://example.com/very/long/url" 
                           value="<?php echo e(old('original_url')); ?>" required>
                    <?php $__errorArgs = ['original_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div style="color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn btn-primary">Create Short URL</button>
                    <a href="<?php echo e(route('urls.index')); ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>

        <div class="card" style="background: #f9fafb; border-left: 4px solid #667eea;">
            <h4 style="margin-bottom: 1rem;">💡 Tips:</h4>
            <ul style="margin-left: 1.5rem; color: #6b7280;">
                <li>Make sure the URL starts with http:// or https://</li>
                <li>You can share your short links with anyone</li>
                <li>Short URLs are not publicly discoverable</li>
                <li>You can delete URLs anytime</li>
            </ul>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project\resources\views/urls/create.blade.php ENDPATH**/ ?>