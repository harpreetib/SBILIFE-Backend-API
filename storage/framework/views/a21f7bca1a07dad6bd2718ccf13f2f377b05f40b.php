<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <p><strong>Dear <?php echo e($full_name); ?></strong>&nbsp;<strong>,</strong></p>
    <p>Here are your login credentials:&nbsp;</p>
    <p>Userid: <?php echo e($userid); ?></p>
<p>Password:  <?php echo e($password); ?></p>
<p>You can login here <a href="https://events.ibentos.com/admin/<?php echo e($bm_nickname); ?>" target="_blank">https://events.ibentos.com/admin/<?php echo e($bm_nickname); ?></a> </p>
    <!--<p>For any further details, you may contact </p> -->

    <p><strong>Warm Regards<br />
    Team iBentos</strong></p>


  </body>
</html><?php /**PATH /home/eventsibentos/public_html/admin/resources/views/emailer/sendcredentials.blade.php ENDPATH**/ ?>