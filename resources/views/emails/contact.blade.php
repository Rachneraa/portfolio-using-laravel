<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Baru dari Portfolio</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #ec4899;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #ec4899;
            margin: 0;
            font-size: 24px;
        }

        .info-row {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #fce7f3;
            border-radius: 5px;
        }

        .info-label {
            font-weight: bold;
            color: #be185d;
        }

        .message-content {
            margin-top: 20px;
            padding: 20px;
            background-color: #fdf2f8;
            border-left: 4px solid #ec4899;
            border-radius: 5px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🌸 Pesan Baru dari Portfolio</h1>
        </div>

        <div class="info-row">
            <span class="info-label">Nama:</span> {{ $senderName }}
        </div>

        <div class="info-row">
            <span class="info-label">Email:</span>
            <a href="mailto:{{ $senderEmail }}">{{ $senderEmail }}</a>
        </div>

        <div class="message-content">
            <span class="info-label">Pesan:</span>
            <p>{!! nl2br(e($messageContent)) !!}</p>
        </div>

        <div class="footer">
            <p>Email ini dikirim dari form kontak di website portfolio.</p>
            <p>© {{ date('Y') }} Portfolio Fadilla Tasya Wanda</p>
        </div>
    </div>
</body>

</html>