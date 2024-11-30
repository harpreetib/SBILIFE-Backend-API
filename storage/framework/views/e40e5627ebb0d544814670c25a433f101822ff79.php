<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>SBI Life</title>
</head>

<body>
    <div style="margin:0 auto; max-width:700px; background-color:#fff;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0"
            style="font-family:Arial, Helvetica, sans-serif; font-size:16px; line-height:20px; color:#000; border:#0a0a0a 1px solid; padding:0px;">
            <tr>
                <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="padding:0px 0px 15px 0px;background-color: #f5eded;">
                                <div>
                                    <div style="padding:0px 25px 0px 25px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                

                                                <td align="left" valign="top">
                                                    <img src="https://lifeverse.megaspace.ai/assets/images/SBI_Logo.png"
                                                        style="max-width:60%; display:block; padding:10px 0 0 0;" />
                                                </td>
                                            </tr>

                                        </table>
                                    </div>

                                    <div style="padding:0px 0px 0px 25px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="left" valign="middle">
                                                    &nbsp;
                                                </td>
                                                
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding:30px 15px; font-family:Arial, Helvetica, sans-serif;">
                                <h1
                                    style=" font-size:20px; font-weight:bold; padding:0; margin:0; font-family:Arial, Helvetica, sans-serif;">
                                    Dear <?php echo e($data->lm_fullname); ?>,
                                </h1>

                                
                                <p>You can use this OTP to verify email:
                                    <!--& Webinar-->:
                                    <strong><?php echo e($otp); ?></strong>
                                </p>

                                

                                <p></br>
                                    <strong>Thanks & Regards,<br>
                                        Team SBI Life</strong>
                                </p>

                            </td>
                        </tr>

                        

                    </table>
                </td>
            </tr>
        </table>

    </div>
</body>

</html><?php /**PATH /home/megaspace/public_html/sbilife/console/resources/views/emailer/email_otp_verify.blade.php ENDPATH**/ ?>