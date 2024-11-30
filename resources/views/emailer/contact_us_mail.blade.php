<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>Intel</title>
</head>

<body>
    <div style="margin:0 auto; max-width:700px; background-color:#fff;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0"
            style="font-family:Arial, Helvetica, sans-serif; font-size:16px; line-height:20px; color:#000; border:#0a0a0a 1px solid; padding:0px;">
            <tr>
                <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="padding:0px 0px 15px 0px;background-color: #0a0a0a;">
                                <div>
                                    <div style="padding:0px 25px 0px 25px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="left" valign="middle"
                                                    style="border-left:2px solid #000; height:26px;">
                                                    &nbsp;
                                                </td>
                                                <td align="right" valign="top">
                                                    &nbsp;
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div style="padding:0px 25px 0px 25px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="left" valign="top">
                                                    <img src="https://megaspace.ai/admin/public/assets/images/intel_logo.png"
                                                        style="max-width:100%;height:100px; display:block; padding:10px 0 0 0;" />
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
                            <td style="padding:30px 15px; font-family:Times New Roman, Georgia, Serif;">
                                <h1
                                    style=" font-size:16px; font-weight:bold; padding:0; margin:0; font-family:Times New Roman, Georgia, Serif;">
                                    Dear {{$booth_name}},
                                </h1>
                                
                                <p>You have received an enquiry. Here are the contact details of the user.</br><br/>
                                <br>
                                Name: {{$enquiryData['ind_fullname']}}<br/>
                                Email : {{$enquiryData['ind_email']}}<br/>
                                Designation: {{$enquiryData['ind_designation']}}<br/>
                                Company: {{$enquiryData['ind_company_name']}}<br/>
                                Message: {{$enquiryData['ind_message']}}</br>
                                
                                <br><br>
                                You may contact him/her for further assistance. <a href="{{$uniquelink}}" target="_blank">Click here to reply</a>
                                <br><br>
                                Thank you for your attention.
                                <br/>
                                
                                <p>
                                    <strong>Thanks & Regards,<br>
                                        Team Intel</strong>
                                </p>

                            </td>
                        </tr>

                        

                    </table>
                </td>
            </tr>
        </table>

    </div>
</body>

</html>