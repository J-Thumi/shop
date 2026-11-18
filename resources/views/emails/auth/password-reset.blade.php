<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title>Reset Your {{ config('app.name') }} Password</title>
</head>

<body style="margin:0; padding:0; background-color:#FAFAFA; font-family:Inter, Arial, Helvetica, sans-serif; color:#18181B;">

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
       style="background-color:#FAFAFA; padding:36px 12px;">
    <tr>
        <td align="center">

            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                   style="max-width:600px; background-color:#ffffff; border:1px solid #E4E4E7; border-radius:14px; overflow:hidden;">

                <!-- Brand header -->
                <tr>
                    <td style="background-color:#18181B; padding:27px 32px; text-align:center;">
                        <div style="font-size:25px; line-height:1.3; font-weight:800; letter-spacing:-0.8px; color:#ffffff;">
                            {{ config('app.name') }}
                        </div>
                        <div style="font-size:10px; color:#D4D4D8; letter-spacing:1.8px; font-weight:700; margin-top:8px; text-transform:uppercase;">
                            Technology &amp; Equipment
                        </div>
                        <div style="width:38px; height:3px; background-color:#F97316; border-radius:3px; margin:15px auto 0;"></div>
                    </td>
                </tr>

                <!-- Main message -->
                <tr>
                    <td style="padding:38px 32px 22px; text-align:center;">
                        <div style="width:58px; height:58px; line-height:58px; margin:0 auto 17px; border-radius:16px; background-color:#FFF7ED; color:#EA580C; font-size:27px;">
                            &#128274;
                        </div>

                        <h1 style="font-size:25px; line-height:1.3; color:#18181B; letter-spacing:-0.5px; margin:0 0 13px; font-weight:750;">
                            Reset Your Password
                        </h1>

                        <p style="font-size:14px; line-height:1.8; color:#71717A; margin:0;">
                            Hello <strong style="color:#18181B;">{{ $user->name }}</strong>,<br>
                            We received a request to reset the password for your {{ config('app.name') }} account.
                        </p>
                    </td>
                </tr>

                <!-- Reset action -->
                <tr>
                    <td style="padding:14px 32px 30px; text-align:center;">
                        <table role="presentation" cellpadding="0" cellspacing="0" border="0" align="center">
                            <tr>
                                <td bgcolor="#F97316" style="border-radius:9px;">
                                    <a href="{{ $resetUrl }}"
                                       style="display:inline-block; padding:15px 31px; color:#ffffff; font-size:14px; font-weight:700; text-decoration:none; border-radius:9px;">
                                        Reset My Password
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <p style="font-size:12px; line-height:1.8; color:#71717A; margin:20px 0 0;">
                            This password reset link expires in {{ $expiresIn }} minutes and can only be used once.
                        </p>
                    </td>
                </tr>

                <!-- Security notice -->
                <tr>
                    <td style="padding:0 32px 30px;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                               style="background-color:#FFF7ED; border:1px solid #FED7AA; border-radius:10px;">
                            <tr>
                                <td style="padding:17px 18px;">
                                    <h3 style="font-size:13px; color:#9A3412; margin:0 0 7px; font-weight:700;">
                                        Security Reminder
                                    </h3>
                                    <p style="font-size:12px; line-height:1.8; color:#9A3412; margin:0;">
                                        If you did not request a password reset, you can safely ignore this email. Your current password will remain unchanged.
                                    </p>
                                </td>
                            </tr>
                        </table>

                        <p style="font-size:11px; line-height:1.8; color:#71717A; margin:21px 0 0;">
                            If the button does not work, copy and paste this address into your browser:
                            <br>
                            <a href="{{ $resetUrl }}" style="color:#EA580C; word-break:break-all; text-decoration:underline;">
                                {{ $resetUrl }}
                            </a>
                        </p>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="padding:23px 25px; background-color:#18181B; text-align:center;">
                        <div style="font-size:18px; font-weight:800; letter-spacing:-0.4px; color:#ffffff;">
                            {{ config('app.name') }}
                        </div>

                        <div style="width:28px; height:2px; background-color:#F97316; border-radius:2px; margin:11px auto;"></div>

                        <p style="font-size:11px; line-height:1.7; color:#D4D4D8; margin:0;">
                            Thank you for choosing {{ config('app.name') }}.
                        </p>
                        <p style="font-size:10px; line-height:1.7; color:#A1A1AA; margin:8px 0 0;">
                            This is an automated security email. Please do not reply directly to this message.
                        </p>
                    </td>
                </tr>

            </table>

            <p style="font-size:10px; line-height:1.6; color:#A1A1AA; text-align:center; margin:18px 0 0;">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>

        </td>
    </tr>
</table>

</body>
</html>
