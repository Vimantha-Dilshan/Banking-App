<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>New Account Created - X-Banking</title>
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

        .account-details {
            background: #146c43;
            border-radius: 10px;
            padding: 25px;
            color: #d1e7dd;
            font-weight: 600;
            font-size: 16px;
            margin: 25px 0;
            letter-spacing: 0.02em;
        }

        .account-details div {
            margin-bottom: 12px;
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
    <div class="container" role="article" aria-roledescription="email" aria-label="New Account Created Email">
        <div class="header">
            Your New Account is Ready
            <div class="branding-text">Secure. Reliable. Yours.</div>
        </div>
        <div class="body">
            <p>Hello <strong>{{ $user->name }}</strong>,</p>

            <p>We are pleased to inform you that your new <strong>{{ $accountType }}</strong> account has been
                successfully created with X-Bank.</p>

            <div class="account-details" role="table" aria-label="Account Details">
                <div><strong>Account Number:</strong> {{ $accountNumber }}</div>
                <div><strong>Account Type:</strong> {{ $accountType }}</div>
                <div><strong>Branch:</strong> {{ $branchName }}</div>
                <div><strong>Opening Date:</strong> {{ $openingDate->format('F j, Y') }}</div>
                @if (!empty($initialDeposit))
                    <div><strong>Initial Deposit (LKR):</strong> {{ $initialDeposit }}</div>
                @endif
            </div>

            <p>You can now access your account online and manage your finances with ease.</p>

            <p>If you have any questions or require assistance, please feel free to contact our support team.</p>

            <p>Welcome to X-Bank, and thank you for banking with us!</p>

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
