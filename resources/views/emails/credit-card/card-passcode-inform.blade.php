<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Your Credit Card Passcode - X-Banking</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            margin: 0;
            padding: 0;
            background: #000000;
            font-family: 'Poppins', sans-serif;
            color: #ddd;
        }

        a {
            color: #198754;
            text-decoration: none;
            font-weight: 600;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background: linear-gradient(145deg, #121212, #1e1e1e);
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(25, 135, 84, 0.3);
            overflow: hidden;
        }

        .header {
            background: #198754;
            color: #fff;
            padding: 30px;
            text-align: center;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: 1.2px;
        }

        .branding-text {
            font-size: 14px;
            font-weight: 500;
            opacity: 0.75;
            margin-top: 6px;
            letter-spacing: 0.8px;
            font-style: italic;
            color: #d1e7dd;
        }

        .body {
            padding: 40px 35px 50px 35px;
            font-size: 17px;
            line-height: 1.6;
            color: #ccc;
        }

        .body p {
            margin-bottom: 20px;
        }

        .passcode-box {
            background-color: #146c43;
            /* darker success */
            color: #d1e7dd;
            font-weight: 700;
            font-size: 22px;
            text-align: center;
            padding: 20px 25px;
            border-radius: 10px;
            margin: 25px 0;
            letter-spacing: 0.15em;
            font-family: 'Courier New', Courier, monospace;
            user-select: all;
        }

        .footer {
            background: #111;
            color: #666;
            text-align: center;
            font-size: 14px;
            padding: 30px 20px;
            letter-spacing: 0.8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .footer-logo img {
            height: 40px;
            filter: brightness(0) invert(1);
        }

        .footer-contact {
            line-height: 1.5;
        }

        @media (max-width: 640px) {
            .container {
                margin: 20px 15px;
            }

            .body {
                padding: 30px 20px 40px 20px;
                font-size: 16px;
            }

            .header {
                font-size: 28px;
                padding: 25px 15px;
            }

            .footer {
                font-size: 13px;
                padding: 20px 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container" role="article" aria-roledescription="email" aria-label="Credit Card Passcode Email">
        <div class="header">
            Your Credit Card Passcode
            <div class="branding-text">Security First, Always</div>
        </div>
        <div class="body">
            <p>Hello <strong>{{ $user->name }}</strong>,</p>

            <p>For your security, here is the passcode for your <strong>{{ $cardType }}</strong> credit card issued
                by X-Bank.</p>

            <div class="passcode-box">
                {{ $passcode }}
            </div>

            <p>Please keep this passcode confidential and do not share it with anyone.</p>

            <p>If you did not request this or believe your passcode has been compromised, please contact our support
                team immediately.</p>

            <p>Thank you for trusting X-Bank.</p>

            <p>Best regards,<br />X-Bank Team</p>
        </div>
        <div class="footer">
            <div class="footer-logo">
                <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel Logo" />
            </div>
            <div class="footer-contact">
                <div>Email: <a href="mailto:support@codex.com">support@codex.com</a></div>
                <div>Address: 123 Green Street, Tech City, Country</div>
            </div>
            <div>&copy; {{ date('Y') }} CodeX. All rights reserved.</div>
        </div>
    </div>
</body>

</html>
