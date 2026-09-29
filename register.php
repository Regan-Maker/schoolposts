<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Register | SchoolStatus</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            width: 100%;
            max-width: 460px;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .login-header h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .login-header p {
            font-size: 14px;
            opacity: 0.9;
            margin: 0;
        }

        .login-body {
            padding: 35px 30px 30px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }

        .form-control:focus {
            border-color: #667eea;
            background-color: white;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
            outline: none;
        }

        .form-control::placeholder {
            color: #999;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .signup-section {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            margin-top: 20px;
        }

        .signup-section p {
            color: #666;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .signup-section a {
            display: inline-block;
            width: 100%;
            padding: 12px;
            background-color: #f0f0f0;
            color: #667eea;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .signup-section a:hover {
            background-color: #e8e8e8;
            color: #764ba2;
            transform: translateY(-2px);
        }

        @media (max-width: 576px) {
            .login-container {
                padding: 15px;
            }

            .login-body {
                padding: 25px 20px 20px;
            }

            .login-header {
                padding: 30px 20px;
            }

            .login-header h1 {
                font-size: 26px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1>SchoolStatus</h1>
                <p>Create Your School Account</p>
            </div>

            <div class="login-body">
                <form action="insert.php" method="POST">
                    <div class="form-group">
                        <label for="username">School Name</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter school name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">School Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="your@email.com" required>
                    </div>

                    <div class="form-group">
                        <label for="telephone">Telephone</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Enter phone number" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required>
                    </div>

                    <button type="submit" class="btn-login">Register Your School</button>
                </form>

                <div class="signup-section">
                    <p>Already have an account?</p>
                    <a href="./login.php">Login to Your Account</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>