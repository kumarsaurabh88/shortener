

<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
    <div style="max-width: 900px; margin: 0 auto;">
        <div style="text-align: center; padding: 3rem 2rem;">
            <h1 style="font-size: 3rem; margin-bottom: 1rem; color: white;">
                🔗 URL Shortener
            </h1>
            <p style="font-size: 1.25rem; margin-bottom: 2rem; color: rgba(255, 255, 255, 0.9);">
                Create short, shareable links with role-based access control
            </p>

            <?php if(auth()->guard()->check()): ?>
                <div style="display: flex; gap: 1rem; justify-content: center;">
                    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-primary">Go to Dashboard</a>
                    <a href="<?php echo e(route('urls.index')); ?>" class="btn btn-secondary">View URLs</a>
                </div>
            <?php else: ?>
                <div style="display: flex; gap: 1rem; justify-content: center;">
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-primary">Login</a>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-secondary">Register</a>
                </div>
            <?php endif; ?>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem; margin-top: 3rem;">
            <div class="card">
                <h3>👥 Role-Based Access</h3>
                <p style="color: #6b7280; margin: 1rem 0;">
                    Different roles with specific permissions and capabilities for managing URLs.
                </p>
            </div>

            <div class="card">
                <h3>🏢 Multi-Company</h3>
                <p style="color: #6b7280; margin: 1rem 0;">
                    Support for multiple companies, each with their own users and short URLs.
                </p>
            </div>

            <div class="card">
                <h3>🔒 Secure</h3>
                <p style="color: #6b7280; margin: 1rem 0;">
                    Private short URLs that are not publicly discoverable, authentication required.
                </p>
            </div>

            <div class="card">
                <h3>📊 Analytics</h3>
                <p style="color: #6b7280; margin: 1rem 0;">
                    Track clicks and engagement on your short URLs in real-time.
                </p>
            </div>

            <div class="card">
                <h3>💌 Invitations</h3>
                <p style="color: #6b7280; margin: 1rem 0;">
                    Invite team members to your company with appropriate roles and permissions.
                </p>
            </div>

            <div class="card">
                <h3>⚡ Easy to Use</h3>
                <p style="color: #6b7280; margin: 1rem 0;">
                    Simple and intuitive interface for managing your URL shortener.
                </p>
            </div>
        </div>

        <?php if(!auth()->check()): ?>
            <div class="card" style="margin-top: 3rem; background: #f0f4ff; border-left: 4px solid #667eea;">
                <h3 style="color: #667eea; margin-bottom: 1rem;">🎯 Get Started</h3>
                <p style="color: #4338ca; margin: 1rem 0;">
                    Demo accounts are available for testing. Login with one of the provided accounts to explore the application.
                </p>
                <div style="background: white; padding: 1rem; border-radius: 0.5rem; margin-top: 1rem; font-size: 0.875rem;">
                    <strong>Demo Credentials:</strong>
                    <ul style="margin: 0.5rem 0 0 1.5rem; color: #374151;">
                        <li><strong>SuperAdmin:</strong> admin@urlshortener.local / password</li>
                        <li><strong>Admin:</strong> admin@demo.local / password</li>
                        <li><strong>Member:</strong> member@demo.local / password</li>
                    </ul>
                </div>
                <a href="<?php echo e(route('login')); ?>" class="btn btn-primary" style="margin-top: 1rem;">Login with Demo Account</a>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project\resources\views/home.blade.php ENDPATH**/ ?>