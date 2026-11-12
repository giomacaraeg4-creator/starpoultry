
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Star Poultry Farm</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #edf2eb;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            padding: 40px;
            border-radius: 14px;
            border: 1px solid #e2e9df;
            box-shadow: 0 8px 30px rgba(35, 75, 45, 0.08);
        }

        .header {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo {
            width: 65px;
            height: 65px;
            margin: 0 auto 15px;
            background: #e5efe3;
            color: #28643b;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: bold;
        }

        .header h1 {
            color: #245b35;
            font-size: 23px;
            margin-bottom: 9px;
            letter-spacing: 0.5px;
        }

        .header p {
            color: #818981;
            font-size: 13px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 9px;
            color: #354438;
            font-size: 13px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 14px;
            border: 1px solid #dce4da;
            border-radius: 7px;
            font-size: 14px;
            color: #333;
            outline: none;
            transition: 0.2s;
        }

        input:focus {
            border-color: #39834c;
            box-shadow: 0 0 0 3px rgba(57, 131, 76, 0.10);
        }

        input::placeholder {
            color: #a6aea5;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background: #28643b;
            color: white;
            border: none;
            border-radius: 7px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .login-btn:hover {
            background: #1d4d2d;
        }

        .register-section {
            text-align: center;
            margin-top: 23px;
            padding-top: 20px;
            border-top: 1px solid #edf0eb;
        }

        .register-section p {
            color: #777f77;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .register-btn {
            display: block;
            width: 100%;
            padding: 13px;
            background: #ffffff;
            color: #28643b;
            border: 1px solid #28643b;
            border-radius: 7px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            transition: 0.2s;
        }

        .register-btn:hover {
            background: #edf4eb;
        }

        .error {
            background: #fff0f0;
            color: #b42318;
            border: 1px solid #f5cccc;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .success {
            background: #edf7ed;
            color: #28643b;
            border: 1px solid #cce4ce;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .footer {
            text-align: center;
            margin-top: 28px;
            color: #a0a79f;
            font-size: 11px;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px 24px;
            }

            .header h1 {
                font-size: 21px;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">

        <div class="header">
            <div class="logo">SP</div>

            <h1>STAR POULTRY FARM</h1>
            <p>Farm Management System</p>
        </div>

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="user_name">Username</label>

                <input
                    type="text"
                    id="user_name"
                    name="user_name"
                    value="{{ old('user_name') }}"
                    placeholder="Enter your username"
                    autocomplete="username"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    autocomplete="current-password"
                    required
                >
            </div>

            <button type="submit" class="login-btn">
                LOGIN
            </button>
        </form>

        <div class="register-section">
            <p>Don't have an account yet?</p>

            <a href="{{ route('register') }}" class="register-btn">
                CREATE AN ACCOUNT
            </a>
        </div>

        <div class="footer">
            © {{ date('Y') }} Star Poultry Farm. All Rights Reserved.
        </div>

    </div>

</body>
</html>
