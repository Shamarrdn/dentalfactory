<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رسالة جديدة من نموذج الاتصال - مصنع جينودينت</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
        }
        .header {
            background: #26e07f;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .content {
            background: white;
            padding: 20px;
            border-radius: 5px;
        }
        .field {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>رسالة جديدة من نموذج الاتصال</h2>
            <p>مصنع جينودينت</p>
        </div>
        <div class="content">
            <div class="field">
                <span class="label">الاسم:</span>
                <p>{{ $name }}</p>
            </div>
            <div class="field">
                <span class="label">البريد الإلكتروني:</span>
                <p>{{ $email }}</p>
            </div>
            <div class="field">
                <span class="label">رقم الهاتف:</span>
                <p>{{ $phone }}</p>
            </div>
            <div class="field">
                <span class="label">الموضوع:</span>
                <p>{{ $subject }}</p>
            </div>
            <div class="field">
                <span class="label">الرسالة:</span>
                <p>{{ $messageContent }}</p>
            </div>
        </div>
    </div>
</body>
</html>
