<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khôi phục mật khẩu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            font-size: 24px;
            text-align: center;
        }

        p {
            color: #555;
            font-size: 16px;
            line-height: 1.5;
        }

        .button-container {
            text-align: center;
            /* Căn giữa nút */
            margin: 20px 0;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Khôi phục mật khẩu</h1>
        <p>Xin chào <strong>{{ $user->name }}</strong>,</p>
        <p>Chúng tôi đã nhận được yêu cầu khôi phục mật khẩu cho tài khoản của bạn. Bạn có thể đặt lại mật khẩu của mình
            bằng cách nhấp vào nút dưới đây:</p>
        <div class="button-container">
            <a href="{{ route('clickInEmailForgot', [$user->id, $token]) }}" class="button">Đặt lại mật khẩu</a>
        </div>
        <p>Nếu bạn không yêu cầu khôi phục mật khẩu, bạn có thể bỏ qua email này.</p>
        <div class="footer">
            <p>Cảm ơn bạn,<br>Đội ngũ hỗ trợ khách hàng</p>
        </div>
    </div>
</body>

</html>
