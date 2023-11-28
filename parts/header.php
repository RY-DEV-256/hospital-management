<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/alertify/alertify.min.css">
    <link rel="stylesheet" href="assets/alertify/default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
    body {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    .left-side {
        height: 100vh;
        background: url(assets/img/1.jpg);
        background-repeat: no-repeat;
        background-size: cover;
    }

    .nav-tabs {
        width: 50%;
    }

    .a {
        color: white;
        cursor: pointer;
        outline: none;
    }

    .a:hover {
        color: black;
    }

    @media(max-width:700px) {
        .nav-tabs {
            width: 100%;
        }
    }
    .scrolled-down{
            transform: translateY(-100%);
            transition: all 0.3s ease-in;
        }
        .scrolled-up{
            transform: translateY(0);
            transition: all 0.3s ease-in-out;
        }
</style>

<body>
<nav class="autohide navbar navbar-expand-sm bg-primary">
        <div class="container-fluid p-3">
        <a class="navbar-brand text-white" href="index.php">St. Elizabeth Hospital</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navLinks"><span><i class="navbar-toggler-icon"></i></span></button>
            <div class="collapse navbar-collapse justify-content-center" id="navLinks">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link text-white">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="aboutus.php" class="nav-link text-white">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="contactus.php" class="nav-link text-white">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
