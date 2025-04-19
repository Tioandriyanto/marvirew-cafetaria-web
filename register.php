<?php
require_once 'config.php';
session_start();

$errors = [];
$success = false;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = sanitize($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $email = sanitize($_POST['email'] ?? '');
    $full_name = sanitize($_POST['full_name'] ?? '');
    $phone = sanitize($_POST['phone'] ?? '');
    $address = sanitize($_POST['address'] ?? '');

    // Validate input
    if (empty($username)) {
        $errors[] = "Username is required";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (empty($full_name)) {
        $errors[] = "Full name is required";
    }

    // Check if username already exists
    $sql = "SELECT id FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $errors[] = "Username already exists";
    }

    // Check if email already exists
    $sql = "SELECT id FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $errors[] = "Email already exists";
    }

    // If no errors, insert user into database
    if (empty($errors)) {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user
        $sql = "INSERT INTO users (username, password, email, full_name, phone, address) 
                VALUES ('$username', '$hashed_password', '$email', '$full_name', '$phone', '$address')";

        if ($conn->query($sql) === TRUE) {
            $success = true;
            // Auto login after registration
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['username'] = $username;

            // Redirect to home page after 2 seconds
            header("refresh:2;url=index.php");
        } else {
            $errors[] = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Marview Cafeteria</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #ff3b30;
            --secondary-color: #ff8c00;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .navbar-brand span {
            color: var(--primary-color);
        }

        .tb-badge {
            background-color: #ff8c00;
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            margin-right: 5px;
        }

        .register-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-title span {
            color: var(--primary-color);
        }

        .btn-register {
            background-color: var(--primary-color);
            border: none;
            color: white;
            font-weight: bold;
            padding: 10px 20px;
        }

        .btn-register:hover {
            background-color: #e62e24;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 30px 0;
            margin-top: 50px;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }

        .social-icons a {
            color: white;
            font-size: 20px;
            margin: 0 10px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.php"><span class="tb-badge">TB</span> <span>Marview</span> Cafetaria</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <a href="login.php" class="btn btn-outline-danger me-3">Sign In</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Registration Form -->
    <div class="container">
        <div class="register-container">
            <h2 class="form-title">Register for <span>FREE</span></h2>

            <?php if ($success): ?>
                <div class="alert alert-success" role="alert">
                    Registration successful! You will be redirected to the home page.
                </div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-register">Register</button>
                </div>

                <p class="text-center mt-3">
                    Already have an account? <a href="login.php">Sign In</a>
                </p>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <h3 class="text-warning mb-4">Marview Cafetaria</h3>

            <div class="footer-links mb-4">
                <a href="#">Service</a>
                <a href="#">About Us</a>
                <a href="#">Contact Us</a>
                <a href="#">FAQs</a>
                <a href="#">Sign In</a>
            </div>

            <div class="social-icons mb-4">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>

            <p class="small text-muted">Marview.com | All rights reserved</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>