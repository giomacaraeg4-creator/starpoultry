
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register | Star Poultry Farm</title>

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

        .register-container {
            width: 100%;
            max-width: 440px;
            background: white;
            padding: 35px 40px;
            border-radius: 14px;
            border: 1px solid #e2e9df;
            box-shadow: 0 8px 30px rgba(35, 75, 45, 0.08);
        }

        .header {
            text-align: center;
            margin-bottom: 28px;
        }

        .logo {
            width: 60px;
            height: 60px;
            margin: 0 auto 13px;
            background: #e5efe3;
            color: #28643b;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            font-weight: bold;
        }

        .header h1 {
            color: #245b35;
            font-size: 22px;
            margin-bottom: 8px;
        }

        .header p {
            color: #818981;
            font-size: 13px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #354438;
            font-size: 13px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 13px;
            border: 1px solid #dce4da;
            border-radius: 7px;
            font-size: 14px;
            outline: none;
        }

        input:focus {
            border-color: #39834c;
            box-shadow: 0 0 0 3px rgba(57, 131, 76, 0.10);
        }

        .register-btn {
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

        .register-btn:hover {
            background: #1d4d2d;
        }

        .login-link {
            text-align: center;
            margin-top: 22px;
            font-size: 13px;
            color: #777f77;
        }

        .login-link a {
            color: #28643b;
            font-weight: bold;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .error {
            background: #fff0f0;
            color: #b42318;
            border: 1px solid #f5cccc;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .success {
            background: #edf7ed;
            color: #28643b;
            border: 1px solid #cce4ce;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        @media (max-width: 480px) {
            .register-container {
                padding: 30px 24px;
            }
        }
    </style>
</head>

<body>

    <div class="register-container">

        <div class="header">
            <div class="logo">SP</div>

            <h1>CREATE ACCOUNT</h1>
            <p>Star Poultry Farm Management System</p>
        </div>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST">
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
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    autocomplete="new-password"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Confirm your password"
                    autocomplete="new-password"
                    required
                >
            </div>

            <button type="submit" class="register-btn">
                CREATE ACCOUNT
            </button>
        </form>

        <div class="login-link">
            Already have an account?
            <a href="{{ route('login') }}">Login here</a>
        </div>

    </div>

</body>
</html>

