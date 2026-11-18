<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title>Your {{ config('app.name') }} Verification Code</title>
</head>

<body style="margin:0; padding:0; background-color:#FAFAFA; font-family:Arial, Helvetica, sans-serif; color:#18181B;">

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
       style="background-color:#FAFAFA; padding:30px 12px;">
    <tr>
        <td align="center">

            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                   style="max-width:600px; background-color:#ffffff; border:1px solid #E4E4E7; border-radius:12px; overflow:hidden;">

                <!-- HEADER -->
                <tr>
                    <td style="background-color:#18181B; padding:27px 32px; text-align:center;">
                        <div style="font-size:27px; font-weight:bold; letter-spacing:-1px; color:#ffffff;">
                            {{ config('app.name') }}
                        </div>

                        <div style="font-size:10px; color:#D4D4D8; letter-spacing:2px; font-weight:bold; margin-top:7px;">
                            TECHNOLOGY &amp; EQUIPMENT
                        </div>
                    </td>
                </tr>

                <!-- INTRODUCTION -->
                <tr>
                    <td style="padding:35px 32px 20px; text-align:center;">

                        <div style="font-size:38px; margin-bottom:12px;">
                            &#128274;
                        </div>

                        <h1 style="font-size:24px; line-height:1.3; color:#18181B; margin:0 0 10px;">
                            Verify Your Email
                        </h1>

                        <p style="font-size:14px; line-height:1.8; color:#71717A; margin:0;">
                            Hello <strong style="color:#18181B;">{{ $user->name }}</strong>,
                            use the verification code below to verify your email address and securely access your
                            {{ config('app.name') }} account.
                        </p>

                    </td>
                </tr>

                <!-- OTP -->
                <tr>
                    <td style="padding:10px 32px 25px;">

                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                               style="background-color:#FAFAFA; border:1px solid #E4E4E7; border-radius:10px;">
                            <tr>
                                <td align="center" style="padding:25px 15px;">

                                    <div style="font-size:10px; font-weight:bold; color:#71717A; letter-spacing:1.5px; text-transform:uppercase; margin-bottom:13px;">
                                        YOUR VERIFICATION CODE
                                    </div>

                                    <div style="font-family:Arial, Helvetica, sans-serif; font-size:34px; letter-spacing:9px; font-weight:bold; color:#F97316;">
                                        {{ $code }}
                                    </div>

                                    <p style="font-size:12px; color:#71717A; margin:15px 0 0;">
                                        This code expires in {{ $expiresIn }} minutes.
                                    </p>

                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>

                <!-- SECURITY NOTICE -->
                <tr>
                    <td style="padding:0 32px 30px;">

                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                               style="background-color:#FFF7ED; border:1px solid #FED7AA; border-radius:9px;">
                            <tr>
                                <td style="padding:16px 18px;">

                                    <h3 style="font-size:13px; color:#9A3412; margin:0 0 7px;">
                                        &#9888; Security Reminder
                                    </h3>

                                    <p style="font-size:12px; line-height:1.8; color:#9A3412; margin:0;">
                                        Never share this code with anyone. {{ config('app.name') }} staff will never ask
                                        you to disclose your verification code.
                                    </p>

                                </td>
                            </tr>
                        </table>

                        <p style="font-size:12px; line-height:1.8; color:#71717A; margin:20px 0 0; text-align:center;">
                            If you did not request this verification code, you can safely ignore this email.
                            No changes will be made to your account.
                        </p>

                    </td>
                </tr>

                <!-- FOOTER -->
                <tr>
                    <td style="padding:22px 25px; background-color:#18181B; text-align:center;">

                        <div style="font-size:19px; font-weight:bold; color:#ffffff;">
                            {{ config('app.name') }}
                        </div>

                        <p style="font-size:11px; color:#D4D4D8; margin:9px 0;">
                            Technology &amp; Equipment
                        </p>

                        <p style="font-size:10px; color:#A1A1AA; margin:0;">
                            Secure access to your {{ config('app.name') }} account.
                        </p>

                    </td>
                </tr>

            </table>

            <p style="font-size:10px; color:#A1A1AA; text-align:center; margin:18px 0 0;">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>

        </td>
    </tr>
</table>

</body>
</html>
