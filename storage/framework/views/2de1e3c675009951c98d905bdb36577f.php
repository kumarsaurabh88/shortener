

<?php $__env->startSection('title', 'Short URLs'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <h2 style="margin-bottom: 1rem;">Short URLs</h2>

        <?php if($shortUrls->isEmpty()): ?>
            <div style="text-align: center; padding: 2rem; color: #6b7280;">
                <p style="font-size: 3rem; margin-bottom: 1rem;">📭</p>
                <p>No short URLs to display</p>
                <?php if(auth()->user()->isMember()): ?>
                    <a href="<?php echo e(route('urls.create')); ?>" class="btn btn-primary" style="margin-top: 1rem;">Create one now</a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>Short Code</th>
                            <th>Original URL</th>
                            <th>Created By</th>
                            <th>Clicks</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $shortUrls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <code style="background: #f0f4ff; padding: 0.25rem 0.5rem; border-radius: 0.25rem;">
                                        <?php echo e($url->short_code); ?>

                                    </code>
                                </td>
                                <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    <a href="<?php echo e($url->original_url); ?>" target="_blank" title="<?php echo e($url->original_url); ?>">
                                        <?php echo e($url->original_url); ?>

                                    </a>
                                </td>
                                <td><?php echo e($url->creator->name); ?></td>
                                <td>
                                    <span class="badge badge-success"><?php echo e($url->clicks); ?></span>
                                </td>
                                <td><?php echo e($url->created_at->format('M d, Y')); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?php echo e(route('urls.show', $url)); ?>" class="btn btn-secondary" style="font-size: 0.875rem;">View</a>
                                        <?php if($url->created_by === auth()->user()->id): ?>
                                            <form method="POST" action="<?php echo e(route('urls.destroy', $url)); ?>" style="display: inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-danger" style="font-size: 0.875rem;" 
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 2rem;">
                <?php echo e($shortUrls->links()); ?>

            </div>
        <?php endif; ?>
    </div>

    <?php if(auth()->user()->isMember()): ?>
        <div style="display: flex; gap: 1rem; margin-top: 1rem;">
            <a href="<?php echo e(route('urls.create')); ?>" class="btn btn-primary">+ Create New URL</a>
            <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project\resources\views/urls/index.blade.php ENDPATH**/ ?>