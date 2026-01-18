

<?php $__env->startSection('title', 'Invite User'); ?>

<?php $__env->startSection('content'); ?>
    <div style="max-width: 600px;">
        <div class="card">
            <h2>Invite User</h2>
            <p style="color: #6b7280; margin-bottom: 1.5rem;">
                <?php if(auth()->user()->isSuperAdmin()): ?>
                    Invite a new Admin to join the platform
                <?php else: ?>
                    Invite a new Member to join your company
                <?php endif; ?>
            </p>

            <form method="POST" action="<?php echo e(route('invitations.store')); ?>">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" 
                           placeholder="user@example.com" 
                           value="<?php echo e(old('email')); ?>" required>
                    <?php $__errorArgs = ['email'];
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

                <div class="form-group">
                    <label for="role">Role *</label>
                    <select id="role" name="role" required>
                        <option value="">Select a role...</option>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($role->name); ?>" <?php if(old('role') === $role->name): echo 'selected'; endif; ?>>
                                <?php echo e($role->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['role'];
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
                    <button type="submit" class="btn btn-primary">Send Invitation</button>
                    <a href="<?php echo e(route('invitations.index')); ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>

        <div class="card" style="background: #f9fafb; border-left: 4px solid #667eea;">
            <h4 style="margin-bottom: 1rem;">📝 How it works:</h4>
            <ol style="margin-left: 1.5rem; color: #6b7280;">
                <li>Enter the email of the person you want to invite</li>
                <li>Select their role in the organization</li>
                <li>They'll receive an invitation email</li>
                <li>Once they accept, their account will be created</li>
            </ol>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project\resources\views/invitations/create.blade.php ENDPATH**/ ?>