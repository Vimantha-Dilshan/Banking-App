<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Monthly Account Statement - X-Banking</title>
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
            max-width: 700px;
            margin: 40px auto;
            background: linear-gradient(145deg, #121212, #1e1e1e);
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(25, 135, 84, 0.3);
            overflow: hidden;
            padding-bottom: 40px;
        }

        .header {
            background: #198754;
            color: #fff;
            padding: 30px;
            text-align: center;
            font-size: 28px;
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
            padding: 35px 40px 0 40px;
            font-size: 16px;
            line-height: 1.6;
            color: #ccc;
        }

        .body p {
            margin-bottom: 20px;
        }

        .account-summary {
            margin-top: 25px;
            border: 1px solid #198754;
            border-radius: 10px;
            padding: 20px;
            background-color: #121212;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-weight: 600;
            font-size: 16px;
            color: #d1e7dd;
        }

        .transactions {
            margin-top: 30px;
        }

        .transactions table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }

        .transactions th,
        .transactions td {
            padding: 12px 15px;
            border-bottom: 1px solid #198754;
            text-align: left;
        }

        .transactions th {
            background-color: #198754;
            color: #fff;
            font-weight: 700;
        }

        .transactions tbody tr:hover {
            background-color: #1e3a2f;
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
            margin-top: 40px;
        }

        .footer-logo img {
            height: 40px;
            filter: brightness(0) invert(1);
        }

        .footer-contact {
            line-height: 1.5;
        }

        @media (max-width: 700px) {
            .container {
                margin: 20px 15px;
                padding-bottom: 30px;
            }

            .body {
                padding: 25px 20px 0 20px;
                font-size: 15px;
            }

            .header {
                font-size: 24px;
                padding: 25px 15px;
            }

            .transactions th,
            .transactions td {
                padding: 10px 12px;
                font-size: 14px;
            }

            .footer {
                font-size: 13px;
                padding: 20px 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container" role="article" aria-roledescription="email" aria-label="Monthly Account Statement">
        <div class="header">
            Your Monthly Account Statement
            <div class="branding-text">Stay Informed, Stay Secure</div>
        </div>
        <div class="body">
            <p>Hello <strong>{{ $user->name }}</strong>,</p>

            <p>Please find below the summary of your account activity for the period
                <strong>{{ $statementPeriod }}</strong>.
            </p>

            <div class="account-summary" role="table" aria-label="Account Summary">
                <div class="summary-row">
                    <div>Account Number:</div>
                    <div>{{ $accountNumber }}</div>
                </div>
                <div class="summary-row">
                    <div>Account Type:</div>
                    <div>{{ $accountType }}</div>
                </div>
                <div class="summary-row">
                    <div>Opening Balance (LKR):</div>
                    <div>{{ $openingBalance }}</div>
                </div>
                <div class="summary-row">
                    <div>Closing Balance (LKR):</div>
                    <div>{{ $closingBalance }}</div>
                </div>
            </div>

            <div class="transactions" role="table" aria-label="Transaction Details">
                <h3 style="color:#d1e7dd; margin-bottom:15px;">Transactions</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->date->format('M d, Y') }}</td>
                                <td>{{ $transaction->description }}</td>
                                <td style="color: {{ $transaction->amount > 0 ? '#198754' : '#dc3545' }};">
                                    {{ $transaction->amount > 0 ? '+' : '' }}{{ $transaction->amountFormatted }}</td>
                                <td>{{ $transaction->balanceFormatted }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <p>If you have any questions about your statement, please contact our support team.</p>

            <p>Thank you for banking with X-Bank.</p>

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
