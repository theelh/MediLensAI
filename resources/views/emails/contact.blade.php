<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Medilens AI Support</title>
    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            text-align: center;
            padding: 30px 20px;
        }
        .header h1 {
            font-size: 22px;
            margin: 0;
            font-weight: 600;
        }
        .content {
            padding: 30px 40px;
            color: #1f2937;
        }
        .content p {
            line-height: 1.7;
            margin-bottom: 14px;
            font-size: 15px;
        }
        .label {
            font-weight: 600;
            color: #374151;
        }
        .message-box {
            background: #f9fafb;
            border-left: 4px solid #6366f1;
            padding: 15px 20px;
            border-radius: 8px;
            font-style: italic;
            color: #374151;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 13px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>📩 Nouveau message de contact</h1>
        </div>
        <div class="content">
            <p><span class="label">👤 Nom :</span> {{ $data['name'] }}</p>
            <p><span class="label">📧 Email :</span> {{ $data['email'] }}</p>
            <p class="label">💬 Message :</p>
            <div class="message-box">
                {{ $data['message'] }}
            </div>
        </div>
        <div class="footer">
            Cet email vous a été envoyé depuis le formulaire de contact de <strong>MediLens AI</strong>.
        </div>
    </div>
</body>
</html>
