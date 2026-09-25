<?php $__env->startSection('title', 'تسجيل الدخول'); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-page">

    
    <svg class="auth-rose-decor" viewBox="0 0 300 300" xmlns="http://www.w3.org/2000/svg">
        <g fill="none" stroke="#9b7cc4" stroke-width="1.4">
            <path d="M150 260 C 90 220, 70 160, 110 110 C 140 75, 190 75, 210 110 C 230 145, 210 190, 170 205" fill="#4a3573" opacity=".55"/>
            <circle cx="150" cy="110" r="34" fill="#7c5ba8" opacity=".6"/>
            <circle cx="150" cy="110" r="20" fill="#9b7cc4" opacity=".7"/>
            <path d="M110 150 C 80 150, 55 170, 45 200" />
            <path d="M190 150 C 220 150, 245 170, 255 200" />
        </g>
    </svg>
    <svg class="auth-rose-decor top-right" viewBox="0 0 300 300" xmlns="http://www.w3.org/2000/svg">
        <g fill="none" stroke="#9b7cc4" stroke-width="1.2">
            <circle cx="150" cy="110" r="26" fill="#4a3573" opacity=".5"/>
            <path d="M150 260 C 100 220, 90 160, 120 120" />
        </g>
    </svg>

    <div class="auth-card">
        <div class="auth-brand">
            <h1>فَلَك</h1>
            <p>لوحة التحكم — سجّل دخولك لإدارة المكتبة</p>
        </div>

        <?php if($errors->any()): ?>
            <div class="auth-error">
                <?php echo e($errors->first()); ?>

            </div>
        <?php endif; ?>

        <?php if(session('status')): ?>
            <div class="auth-error" style="background:rgba(111,191,139,.1);border-color:rgba(111,191,139,.35);color:#bfe6cd;">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <form class="auth-form" method="POST" action="<?php echo e(route('admin.login.submit')); ?>">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label class="form-label" for="email">البريد الإلكتروني</label>
                <div class="input-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 6h16v12H4z"/><path d="M4 7l8 6 8-6"/></svg>
                    <input type="email" id="email" name="email" class="form-control"
                           placeholder="admin@falak-books.com" value="<?php echo e(old('email')); ?>" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">كلمة المرور</label>
                <div class="input-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="5" y="10" width="14" height="10" rx="2"/><path d="M8 10V7a4 4 0 018 0v3"/></svg>
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="••••••••" required>
                </div>
            </div>

            <div class="auth-form-footer">
                <label>
                    <input type="checkbox" name="remember" style="accent-color: var(--falak-purple-500);">
                    تذكرني
                </label>
            </div>

            <button type="submit" class="btn btn-gold auth-submit">دخول</button>
        </form>

        <div class="auth-divider">فَلَك — نُسيّرك في الكُتُب حيثُ لا نهاية للشغف</div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\falak\falak_backend\resources\views/admin/auth/login.blade.php ENDPATH**/ ?>