<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome to X-Banking Staff Portal</title>
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

        .credentials {
            background: #222;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
            font-size: 16px;
            color: #eee;
            word-break: break-word;
        }

        .credentials strong {
            color: #198754;
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
            text-decoration: none;
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
    <div class="container" role="article" aria-roledescription="email" aria-label="Staff Welcome Email">
        <div class="header">
            Welcome to the CodeX Team
            <div class="branding-text">Empowering Our People, Securing Our Future</div>
        </div>
        <div class="body">
            <p>Hello <strong>{{ $staff->name }}</strong>,</p>

            <p>We are excited to have you onboard as part of the CodeX family! Your office account has been
                successfully created.</p>

            <p>Here are your account details to access the staff portal:</p>

            <div class="credentials">
                <p><strong>Email:</strong> {{ $staff->email }}</p>
                <p><strong>Temporary Password:</strong> {{ $temporaryPassword }}</p>
            </div>

            <p>For security reasons, please log in and change your password immediately.</p>

            <a href="{{ route('staff.login') }}" class="btn" target="_blank" rel="noopener">Access Staff Portal</a>

            <p>If you need any assistance, feel free to contact our IT support team anytime.</p>

            <p>Welcome aboard,<br />CodeX HR Team</p>
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
