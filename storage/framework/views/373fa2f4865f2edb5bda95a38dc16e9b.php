

<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('content'); ?>
    <div style="max-width: 400px; margin: 3rem auto;">
        <div class="card">
            <h2 style="margin-bottom: 1.5rem; text-align: center;">Login</h2>

            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label style="display: flex; align-items: center;">
                        <input type="checkbox" name="remember" style="width: auto; margin-right: 0.5rem;">
                        Remember me
                    </label>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>

                <p style="text-align: center; margin-top: 1.5rem; color: #6b7280;">
                    Don't have an account? <a href="<?php echo e(route('register')); ?>" style="color: #667eea;">Register here</a>
                </p>

                <div style="background: #f0f4ff; padding: 1rem; border-radius: 0.5rem; margin-top: 1.5rem; font-size: 0.875rem; color: #4338ca;">
                    <strong>Demo Accounts:</strong>
                    <ul style="margin: 0.5rem 0 0 1.5rem;">
                        <li>SuperAdmin: admin@urlshortener.local / password</li>
                        <li>Admin: admin@demo.local / password</li>
                        <li>Member: member@demo.local / password</li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project\resources\views/auth/login.blade.php ENDPATH**/ ?>