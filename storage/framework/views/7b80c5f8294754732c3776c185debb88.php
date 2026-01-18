

<?php $__env->startSection('title', 'Register'); ?>

<?php $__env->startSection('content'); ?>
    <div style="max-width: 400px; margin: 3rem auto;">
        <div class="card">
            <h2 style="margin-bottom: 1.5rem; text-align: center;">Create Account</h2>

            <form method="POST" action="<?php echo e(route('register')); ?>">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>" required autofocus>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">Register</button>

                <p style="text-align: center; margin-top: 1.5rem; color: #6b7280;">
                    Already have an account? <a href="<?php echo e(route('login')); ?>" style="color: #667eea;">Login here</a>
                </p>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project\resources\views/auth/register.blade.php ENDPATH**/ ?>