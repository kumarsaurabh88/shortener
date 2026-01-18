

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <div>
        <div class="card">
            <h2>Welcome, <?php echo e(auth()->user()->name); ?>! 👋</h2>
            <p style="color: #6b7280; margin-top: 0.5rem;">
                Role: <span class="badge badge-primary"><?php echo e(auth()->user()->role->name); ?></span>
                <?php if(auth()->user()->company): ?>
                    | Company: <strong><?php echo e(auth()->user()->company->name); ?></strong>
                <?php endif; ?>
            </p>
        </div>

        <?php if(auth()->user()->isSuperAdmin()): ?>
            <div class="card">
                <h3>SuperAdmin Dashboard</h3>
                <p style="color: #6b7280; margin: 1rem 0;">
                    As a SuperAdmin, you can:
                </p>
                <ul style="margin-left: 1.5rem; color: #374151;">
                    <li>Invite new Admins to companies</li>
                    <li>Manage all invitations</li>
                    <li>View system statistics</li>
                </ul>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-top: 1.5rem;">
                    <div style="background: #f0f4ff; padding: 1rem; border-radius: 0.5rem; text-align: center;">
                        <div style="font-size: 2rem; font-weight: bold; color: #667eea;">-</div>
                        <div style="color: #6b7280; font-size: 0.875rem;">Total Companies</div>
                    </div>
                    <div style="background: #f0f4ff; padding: 1rem; border-radius: 0.5rem; text-align: center;">
                        <div style="font-size: 2rem; font-weight: bold; color: #667eea;">-</div>
                        <div style="color: #6b7280; font-size: 0.875rem;">Total Users</div>
                    </div>
                    <div style="background: #f0f4ff; padding: 1rem; border-radius: 0.5rem; text-align: center;">
                        <div style="font-size: 2rem; font-weight: bold; color: #667eea;">-</div>
                        <div style="color: #6b7280; font-size: 0.875rem;">Total URLs</div>
                    </div>
                </div>
            </div>
        <?php elseif(auth()->user()->isAdmin()): ?>
            <div class="card">
                <h3>Admin Dashboard</h3>
                <p style="color: #6b7280; margin: 1rem 0;">
                    As an Admin, you can:
                </p>
                <ul style="margin-left: 1.5rem; color: #374151;">
                    <li>View short URLs from other companies</li>
                    <li>Invite Members to your company</li>
                    <li>Manage company invitations</li>
                </ul>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-top: 1.5rem;">
                    <div style="background: #f0f4ff; padding: 1rem; border-radius: 0.5rem; text-align: center;">
                        <div style="font-size: 2rem; font-weight: bold; color: #667eea;"><?php echo e($stats['company_urls'] ?? 0); ?></div>
                        <div style="color: #6b7280; font-size: 0.875rem;">Your Company URLs</div>
                    </div>
                    <div style="background: #f0f4ff; padding: 1rem; border-radius: 0.5rem; text-align: center;">
                        <div style="font-size: 2rem; font-weight: bold; color: #667eea;"><?php echo e($shortUrls->count()); ?></div>
                        <div style="color: #6b7280; font-size: 0.875rem;">URLs from Other Companies</div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="card">
                <h3>Member Dashboard</h3>
                <p style="color: #6b7280; margin: 1rem 0;">
                    As a Member, you can:
                </p>
                <ul style="margin-left: 1.5rem; color: #374151;">
                    <li>Create and manage your own short URLs</li>
                    <li>View short URLs created by other members</li>
                    <li>Track URL statistics</li>
                </ul>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-top: 1.5rem;">
                    <div style="background: #f0f4ff; padding: 1rem; border-radius: 0.5rem; text-align: center;">
                        <div style="font-size: 2rem; font-weight: bold; color: #667eea;"><?php echo e($stats['my_urls'] ?? 0); ?></div>
                        <div style="color: #6b7280; font-size: 0.875rem;">My URLs</div>
                    </div>
                    <div style="background: #f0f4ff; padding: 1rem; border-radius: 0.5rem; text-align: center;">
                        <div style="font-size: 2rem; font-weight: bold; color: #667eea;"><?php echo e($shortUrls->count()); ?></div>
                        <div style="color: #6b7280; font-size: 0.875rem;">Other URLs</div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="card">
            <h3>Quick Actions</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 1rem;">
                <?php if(auth()->user()->isSuperAdmin()): ?>
                    <a href="<?php echo e(route('roles.index')); ?>" class="btn btn-primary">👥 Manage Roles</a>
                <?php elseif(auth()->user()->isMember()): ?>
                    <a href="<?php echo e(route('urls.create')); ?>" class="btn btn-primary">+ Create Short URL</a>
                <?php endif; ?>
                <a href="<?php echo e(route('urls.index')); ?>" class="btn btn-secondary">View All URLs</a>
                <?php if(!auth()->user()->isSuperAdmin()): ?>
                    <a href="<?php echo e(route('invitations.create')); ?>" class="btn btn-secondary">Invite User</a>
                    <a href="<?php echo e(route('invitations.index')); ?>" class="btn btn-secondary">Manage Invitations</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project\resources\views/dashboard.blade.php ENDPATH**/ ?>