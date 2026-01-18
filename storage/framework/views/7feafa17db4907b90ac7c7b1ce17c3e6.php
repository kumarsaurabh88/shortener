

<?php $__env->startSection('title', 'Manage Roles'); ?>

<?php $__env->startSection('content'); ?>
    <div>
        <div class="card">
            <h2>Manage User Roles</h2>
            <p style="color: #6b7280; margin-top: 0.5rem;">Assign roles to users in the system.</p>
        </div>

        <?php if(session('success')): ?>
            <div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem; border: 1px solid #c3e6cb;">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="card">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 2px solid #e5e7eb;">
                        <th style="text-align: left; padding: 0.75rem; font-weight: 600;">Name</th>
                        <th style="text-align: left; padding: 0.75rem; font-weight: 600;">Email</th>
                        <th style="text-align: left; padding: 0.75rem; font-weight: 600;">Current Role</th>
                        <th style="text-align: left; padding: 0.75rem; font-weight: 600;">Assign Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 0.75rem;"><?php echo e($user->name); ?></td>
                            <td style="padding: 0.75rem;"><?php echo e($user->email); ?></td>
                            <td style="padding: 0.75rem;">
                                <span class="badge badge-primary"><?php echo e($user->role->name); ?></span>
                            </td>
                            <td style="padding: 0.75rem;">
                                <form method="POST" action="<?php echo e(route('roles.update', $user->id)); ?>" style="display: flex; gap: 0.5rem; align-items: center;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <select name="role_id" style="padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.875rem;">
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($role->id); ?>" <?php echo e($user->role_id === $role->id ? 'selected' : ''); ?>>
                                                <?php echo e($role->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <button type="submit" class="btn btn-sm" style="padding: 0.5rem 1rem; background: #667eea; color: white; border: none; border-radius: 0.375rem; cursor: pointer; font-size: 0.875rem;">Update</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" style="padding: 1rem; text-align: center; color: #6b7280;">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <?php if($users->hasPages()): ?>
                <div style="margin-top: 1.5rem; display: flex; justify-content: center; gap: 0.5rem;">
                    <?php echo e($users->links()); ?>

                </div>
            <?php endif; ?>
        </div>

        <div style="margin-top: 1rem;">
            <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project\resources\views/roles/index.blade.php ENDPATH**/ ?>