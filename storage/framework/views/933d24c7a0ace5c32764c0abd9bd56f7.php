

<?php $__env->startSection('content'); ?>
<!-- Hero Section Image -->
<section style="padding-top: 40px; padding-bottom: 0; background: white;">
    <div class="container" style="text-align: center;">
        <img src="<?php echo e(asset('images/hero-image.png')); ?>" alt="SECRET DIARY Hero" style="max-width: 100%; height: auto; display: block; margin: 0 auto;">
    </div>
</section>

<!-- Second Section Image with Text -->
<section style="padding: 60px 0; background: white;">
    <div class="container">
        <div style="display: flex; align-items: center; gap: 40px; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 300px;">
                <img src="<?php echo e(asset('images/second-section.png')); ?>" alt="SECRET DIARY Second Section" style="max-width: 100%; height: auto; display: block;">
            </div>
            <div style="flex: 1; min-width: 300px;">
                <p style="font-size: 50px; font-weight: 900; line-height: 1.2; color: #E94E90; margin: 0;">
                    Share your thoughts<br>
                    with us in this secret<br>
                    diary. Confess freely,<br>
                    express honestly, and<br>
                    let your heart breathe<br>
                    in a space made just for<br>
                    you.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- DEAR DIARY Section with Anonymous Messages -->
<section style="padding: 80px 0; background: #F8E8E8;">
    <div class="container">
        <h2 style="font-size: 48px; font-weight: 700; margin-bottom: 48px; text-align: center; color: #E94E90;">
            DEAR DIARY
        </h2>
        
        <?php if($anonymousEntries && $anonymousEntries->count() > 0): ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px;">
                <?php $__currentLoopData = $anonymousEntries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                        <p style="font-size: 16px; line-height: 1.6; color: #374151; white-space: pre-wrap; margin-bottom: 16px; min-height: 100px;">
                            <?php echo e(Str::limit($entry->message, 150)); ?>

                        </p>
                        <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 16px; border-top: 1px solid #e5e7eb;">
                            <span style="font-size: 12px; color: #9ca3af;">
                                <?php echo e($entry->created_at->format('M d, Y')); ?>

                            </span>
                            <span style="font-size: 12px; color: #E94E90; background: #fce7f3; padding: 4px 10px; border-radius: 12px; font-weight: 500;">
                                Anonymous
                            </span>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div style="text-align: center; padding: 60px; background: white; border-radius: 16px;">
                <p style="font-size: 18px; color: #6b7280;">
                    No anonymous messages yet. Be the first to share your thoughts!
                </p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- SECRET DIARY Section -->
<section style="padding: 80px 0; background: white;">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto;">

            <?php if(auth()->guard()->check()): ?>
                <div style="background: #f9fafb; padding: 40px; border-radius: 16px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    <form action="<?php echo e(route('diary.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div style="margin-bottom: 24px;">
                            <label for="message" style="display: block; font-weight: 500; margin-bottom: 8px; color: #374151;">Your Message</label>
                            <textarea 
                                id="message" 
                                name="message" 
                                rows="8" 
                                required
                                style="width: 100%; padding: 16px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 16px; font-family: inherit; resize: vertical; transition: border-color 0.3s;"
                                placeholder="Write your thoughts here..."
                                onfocus="this.style.borderColor='#ec4899'"
                                onblur="this.style.borderColor='#e5e7eb'"
                            ></textarea>
                            <p style="font-size: 14px; color: #9ca3af; margin-top: 8px;">Your message will be submitted anonymously</p>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 18px; padding: 16px;">
                            Submit Message
                        </button>
                    </form>
                </div>
            <?php else: ?>
                <div style="background: #f9fafb; padding: 40px; border-radius: 16px; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    <p style="font-size: 18px; color: #6b7280; margin-bottom: 24px;">
                        Please login or register to submit your anonymous message.
                    </p>
                    <div style="display: flex; gap: 16px; justify-content: center;">
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-primary" style="text-decoration: none;">Login</a>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-outline" style="text-decoration: none;">Sign Up</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- My Stories Section -->
<?php if(auth()->guard()->check()): ?>
    <section style="padding: 80px 0; background: #f9fafb;">
        <div class="container">
            <div style="max-width: 800px; margin: 0 auto;">
                <h2 style="font-size: 42px; font-weight: 700; margin-bottom: 16px; text-align: center; color: #1f2937;">My Stories</h2>
                <p style="font-size: 18px; color: #6b7280; text-align: center; margin-bottom: 48px;">
                    View all your submitted messages
                </p>

                <?php if($userEntries && $userEntries->count() > 0): ?>
                    <div style="display: flex; flex-direction: column; gap: 24px;">
                        <?php $__currentLoopData = $userEntries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div style="background: white; padding: 32px; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                                <p style="font-size: 16px; line-height: 1.8; color: #374151; white-space: pre-wrap; margin-bottom: 16px;">
                                    <?php echo e($entry->message); ?>

                                </p>
                                <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 16px; border-top: 1px solid #e5e7eb;">
                                    <span style="font-size: 14px; color: #9ca3af;">
                                        <?php echo e($entry->created_at->format('F d, Y h:i A')); ?>

                                    </span>
                                    <?php if($entry->is_anonymous): ?>
                                        <span style="font-size: 14px; color: #ec4899; background: #fce7f3; padding: 4px 12px; border-radius: 12px;">
                                            Anonymous
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div style="text-align: center; margin-top: 40px;">
                        <a href="<?php echo e(route('diary.my-stories')); ?>" class="btn btn-outline" style="text-decoration: none;">View All Stories</a>
                    </div>
                <?php else: ?>
                    <div style="background: white; padding: 60px; border-radius: 12px; text-align: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <p style="font-size: 18px; color: #6b7280;">
                            You haven't submitted any messages yet. Share your first story above!
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\documents2025901\Desktop\laravel\laravel-aivie\resources\views/welcome.blade.php ENDPATH**/ ?>