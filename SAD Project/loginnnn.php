<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    <!-- Font Awesome (check internet connection!) -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Roboto", sans-serif;
            background: url('img/background.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            width: 330px;
            background: rgba(255, 255, 255, 0.1); /* more visible */
            backdrop-filter: blur(10px);
            border: 1px solid #ffffff33;
            border-radius: 10px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
            padding: 30px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        form h1 {
            text-align: center;
            margin-bottom: 10px;
        }

        .input-group {
            position: relative;
        }

        .input-group input {
            width: 100%;
            padding: 10px 40px 10px 15px;
            border-radius: 25px;
            border: 1px solid #ccc;
            background-color: transparent;
            color: white;
        }

        .input-group i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: white;
        }

        .mypw {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
        }

        .mypw input[type="checkbox"] {
            margin-right: 5px;
        }

        button {
            padding: 10px;
            border: none;
            border-radius: 25px;
            background-color: white;
            color: black;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h1>Login</h1>

        <div class="input-group">
            <input type="text" name="username" placeholder="Username" required>
            <i class="fas fa-user"></i>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
            <i class="fas fa-lock"></i>
        </div>

        <div class="mypw">
            <label><input type="checkbox"> Remember me</label>
            <a href="#">Forgot password?</a>
        </div>

        <button type="submit">Login</button>
    </form>
</body>
</html>
