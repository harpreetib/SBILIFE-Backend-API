<?php echo $__env->make('emailer.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                               
                                <h1
                                    style=" font-size:20px; font-weight:bold; padding:0; margin:0; font-family:Arial, Helvetica, sans-serif;">
                                    Dear #FullName#,
                                </h1>
                                <p>Thank you for registering for <strong><u><?php echo e($data->aem_name); ?></u></strong>.
                                </p>
                                <?php echo htmlspecialchars_decode($data->aem_mail_html); ?>

                                
                                <p>Date & Time: <?php echo e(date('l,M j',strtotime($data->aem_start_date))); ?><sup>th</sup> to <?php echo e(date('j',strtotime($data->aem_end_date))); ?><sup>th</sup>, <?php echo e(date('h:i A',strtotime($data->aem_start_date))); ?> - <?php echo e(date('h:i A',strtotime($data->aem_end_date))); ?> (IST Time Zone).</p>

                                <!--<p>Join from a PC, Mac, iPhone, or Android device:</p>-->

                                <!--<p style="text-align:center;">-->
                                <!--    <a href="#PreRegFairUrl#"-->
                                <!--        style="background: #000932; border: 1px solid #000932; color: #ffffff !important; padding: 8px 29px; outline: none; text-decoration: none; font-size: 16px; letter-spacing: 0; font-weight: 700; border-radius: 21px; text-transform: uppercase; display: inline-block;">JOIN</a>-->

                                <!--</p>-->
                               
<?php echo $__env->make('emailer.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ibentosroot/public_html/events/admin/resources/views/emailer/mailsetup.blade.php ENDPATH**/ ?>