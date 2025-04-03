<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome - Guidance Counseling System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to bottom right, #d0f0f6, #f9fbfd);
        }

        .welcome-card {
            background: #ffffff;
            border-radius: 1rem;
            padding: 3rem;
            max-width: 650px;
            width: 100%;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-weight: 700;
            color: #007bff;
        }

        h2 {
            font-weight: 600;
            color: #343a40;
        }

        p.lead {
            color: #555;
        }

        .btn {
            min-width: 120px;
        }
    </style>
</head>
<body>

<div class="container d-flex flex-column justify-content-center align-items-center min-vh-100 text-center">
    <div class="welcome-card">
        <h1 class="mb-2">Welcome to</h1>
        <h2 class="mb-4">Guidance Counseling Appointment Booking System</h2>
        <p class="lead mb-4">
            Your mental health matters. Book appointments, track sessions, and connect with your guidance counselor.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="/login" class="btn btn-outline-primary px-4">Login</a>
            <a href="/register" class="btn btn-primary px-4">Register</a>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
