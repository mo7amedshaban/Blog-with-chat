<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>





    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <!--scripts -->

     <!-- Bootstrap core CSS -->
  <link href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('assets/css/font-awesome.min.css')); ?>" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?php echo e(asset('assets/css/added_style.css')); ?>" rel="stylesheet">


</head>
<body>
    <div id="app">
       

       <?php echo $__env->yieldContent('content'); ?>

       <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <script src="https://kit.fontawesome.com/3bbb7e2990.js" crossorigin="anonymous"></script>

    <script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/app.js')); ?>" defer ></script>
    <script>
        $(document).ready(function(){
          $('.switch-tologin-modal').on('click',function(){
            $('#register-modal').modal('hide');
            $('#login-modal').modal('show');
          })
          $('.switch-toregister-modal').on('click',function(){
            $('#login-modal').modal('hide');
            $('#register-modal').modal('show');
          })
        })
      </script>

      <script src="http://localhost:8098"></script>
</body>
</html>
<?php /**PATH /Users/mac/Desktop/GitHub/Blog-with-chat/resources/views/layouts/app.blade.php ENDPATH**/ ?>