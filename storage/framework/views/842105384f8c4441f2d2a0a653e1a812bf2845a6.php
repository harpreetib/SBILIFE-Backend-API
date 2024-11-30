<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php echo e(config('app.name')); ?></title>
        <link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>" sizes="32x32" />
        <link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>" sizes="192x192" />
        <link rel="apple-touch-icon" href="<?php echo e(asset('favicon.ico')); ?>" />
        <meta name="msapplication-TileImage" content="favicon.ico" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo e(asset('assets/styles/css/themes/lite-blue.min.css')); ?>">
    </head>

    <body>
        <div class="auth-layout-wrap" style="background-image: url(<?php echo e(asset('assets/images/login-bg.jpg')); ?>)">
            <div class="auth-content">
                <div class="card o-hidden">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="p-4">
                                <div class="auth-logo text-center mb-4">
                                    <img src="<?php echo e(asset('assets/images/logo.png')); ?>?ver=<?php echo e(rand()); ?>" alt="">
                                </div>
                                <h1 class="mb-3 text-18">Sign In</h1>
                                <form method="POST" action="<?php echo e($action_url); ?>">
                                    <!---->
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="text" id="email"
                                            class="form-control form-control-rounded <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email"
                                            autofocus>
                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" id="password"
                                            class="form-control form-control-rounded <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="password" required autocomplete="current-password">
                                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group d-none">
                                        <div class="">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                                                <label class="form-check-label" for="remember">
                                                    <?php echo e(__('Remember Me')); ?>

                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-rounded btn-primary btn-block mt-2">Sign In</button>
                                    
                                    
                                    <?php if(Session::has('error')): ?>
                                        <span style="color:#ff0000"><?php echo e(ucfirst(Session::get('error'))); ?></span>
                                    <?php endif; ?> 

                                </form>
                                <?php if(Route::has('password.request')): ?>

                                <div class="mt-3 text-center">

                                    <a href="<?php echo e(route('password.request')); ?>" class="text-muted"><u>Forgot
                                            Password?</u></a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 text-center "
                            style="background-size: cover;background-image: url(<?php echo e(asset('assets/images/right-side-bg.png')); ?>">
                            <div class="pr-3 auth-right d-none">
                                <a class="btn btn-rounded btn-outline-primary btn-outline-email btn-block btn-icon-text"
                                    href="signup.html">
                                    <i class="i-Mail-with-At-Sign"></i> Sign up with Email
                                </a>
                                <a
                                    class="btn btn-rounded btn-outline-primary btn-outline-google btn-block btn-icon-text">
                                    <i class="i-Google-Plus"></i> Sign up with Google
                                </a>
                                <a
                                    class="btn btn-rounded btn-outline-primary btn-block btn-icon-text btn-outline-facebook">
                                    <i class="i-Facebook-2"></i> Sign up with Facebook
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?php echo e(asset('assets/js/common-bundle-script.js')); ?>"></script>

        <script src="<?php echo e(asset('assets/js/script.js')); ?>"></script>
    </body>

</html><?php /**PATH /home/ibentosroot/public_html/events/admin/resources/views/sessions/signIn.blade.php ENDPATH**/ ?>