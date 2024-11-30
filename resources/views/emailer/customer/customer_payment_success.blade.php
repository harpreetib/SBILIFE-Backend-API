<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport"
         content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
      <title>#EventName#</title>
   </head>
   <body>
      <div
         style="margin:0 auto; max-width:700px; background-color:#fff;">
         <table width="700" border="0" cellspacing="0" cellpadding="0" align="center"
            style="font-family:Arial, Helvetica, sans-serif; font-size:16px; line-height:20px; color:#000; border: #171b4f 2px solid; padding:0px;">
            <tr style="background-repeat: no-repeat; background-size: cover;" border="0" cellspacing="0" cellpadding="0">
               <td>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                     <tr>
                        <td style="">
                           <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                 <td style="">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="20" style="background-image: linear-gradient(to right,#cc213c, #171b4f);">
                                       <tr >
                                          <td align="center" valign="middle"><img
                                             src="https://superangelssummit.com/registration/public/assets/images/logo--white.png" width="35%" >
                                          </td>
                                       </tr>
                                    </table>
                                 </td>
                              </tr>
                              <!--tr>
                                 <td style="background-color:#f52130;">
                                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                 	<tr>
                                 		<td align="center" valign="middle"> 
                                 		<p style="text-align:center;color:#fff;font-size:22px;font-weight:bold">Megaspace</p>
                                 		 </td>
                                 	</tr-->
                           </table>
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
            <tr >
               <td style="padding:30px 15px; font-family:Arial, Helvetica, sans-serif;">
                  <p>
                     <strong>Dear {{$fullname}},</strong>
                  </p>
                  <p>We are excited to inform you that your package upgrade for the Megaspace has been successfully completed. Welcome aboard!</p>
                  <p><strong>Your package upgrade details:</strong><br>
                     <strong>Full Name:</strong> {{$fullname}} <br>
                     <strong>Email Address:</strong> {{$email}}<br>
                     <strong>Package Name:</strong> {{$package->pm_name}}<br>
                     <strong>Package Amount:</strong> Rs. {{$package->pm_amount}}<br>
                  <p>If you have any questions or need further assistance, please don't hesitate to reach out to us at <a href="mailto:support@ibentos.com">support@ibentos.com<a/></p>
                  <p>Once again, thank you for choosing to be part of the Megaspace. We look forward to meeting you and making this metaverse a resounding success together.</p>
                  <p><strong> Regards<br />
                     Team Megaspace!</strong>
                  </p>
               </td>
            </tr>
         </table>
      </div>
   </body>
</html>