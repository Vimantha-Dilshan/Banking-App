<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome to X-Banking</title>
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
            /* Bootstrap success color */
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
            /* Bootstrap success */
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
            /* subtle lighter green */
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

        .btn {
            display: inline-block;
            background: #198754;
            color: #fff;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 16px;
            margin: 30px 0;
            box-shadow: 0 6px 18px rgba(25, 135, 84, 0.5);
            transition: background 0.3s ease;
        }

        .btn:hover {
            background: #146c43;
            /* Darker success hover */
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
            /* invert colors for dark bg */
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

            .btn {
                padding: 12px 24px;
                font-size: 15px;
            }

            .footer {
                font-size: 13px;
                padding: 20px 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container" role="article" aria-roledescription="email" aria-label="Welcome Email">
        <div class="header">
            Welcome to X-Banking
            <div class="branding-text">Innovating Your Digital Future</div>
        </div>
        <div class="body">
            <p>Hello <strong>{{ $user->name }}</strong>,</p>

            <p>Thank you for joining <strong>X-Bank</strong> — we're excited to have you with us!</p>

            <p>With your new account, you can now explore all our services designed to help you grow and succeed.</p>

            <p>To get started, just click the button below to log in and access your personalized dashboard.</p>

            <a href="{{ route('login') }}" class="btn" target="_blank" rel="noopener">Log In to Your Account</a>

            <p>If you have any questions or need assistance, our support team is here to help you 24/7.</p>

            <p>Welcome aboard,<br />X-Bank Team</p>
        </div>
        <div class="footer">
            <div class="footer-logo">
                <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel Logo" style="max-height: 40px;" />
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
