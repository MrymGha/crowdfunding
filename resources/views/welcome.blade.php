<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Crowdfunding Platform</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="{{ asset('images/iconLogo.png') }}" type="image/png">

    <style>
        body {
            padding-top: 56px; /* Adjust this value if the height of the navbar changes */
        }
        .navbar {
            background: #f8f9fa;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .hero-section {
            background: #343a40;
            color: white;
            padding: 100px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .hero-content {
            z-index: 1;
            position: relative;
        }
        .hero-animation {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            z-index: 0;
            width: 100%;
            max-width: 500px;
            height: auto;
        }
        .campaign-listing {
            padding: 50px 0;
        }
        .campaign-card {
            margin-bottom: 30px;
        }
        .hero-content h1{
            margin-top: 350px;
        }
        .footer {
            background: #343a40;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        .footer a {
            color: #f8f9fa;
            text-decoration: none;
        }
        .footer a:hover {
            color: #adb5bd;
        }
        table {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .contact-section {
            padding: 50px 0;
            text-align: center;
        }
        .icon-container {
            margin-top: 20px;
        }
        .icon-container a {
            margin: 0 15px;
            color: #333;
            font-size: 30px;
            transition: color 0.3s;
        }
        .icon-container a:hover {
            color: #007BFF;
        }
        .card-img-top {
            width: 100%;
            height: 200px; /* Adjust the height as needed */
            object-fit: cover; /* Ensures the image covers the area without stretching */
        }
        .card {
            margin-bottom: 20px; /* Adds some spacing between cards */
        }
        .navbar-nav .dropdown-menu {
            position: absolute;
            will-change: transform;
            top: 0;
            left: 0;
            transform: translate3d(0px, 38px, 0px);
        }
        .card-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }
       
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/mainLogo.png') }}" alt="" style="width: 180px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#about"> <b>About</b> </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('campaigns') }}"> <b>Campaigns</b> </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact"> <b>Contact</b> </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dashboard
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if (Auth::user()->role == 'admin')
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                            @elseif (Auth::user()->role == 'project_owner')
                                <a class="dropdown-item" href="{{ route('project_owner.dashboard') }}">Project Owner Dashboard</a>
                            @elseif (Auth::user()->role == 'contributor')
                                <a class="dropdown-item" href="{{ route('contributor.dashboard') }}">Contributor Dashboard</a>
                            @endif
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

    <div class="hero-section">
        <div class="hero-animation">
            <img src="{{ asset('images/undraw_hero.svg') }}" alt="Crowdfunding Animation">
        </div>
        <div class="hero-content">
            <div class="container">
                <h1 class="display-4">Welcome to Our Crowdfunding Platform</h1>
                <p class="lead">Discover amazing campaigns and help make ideas come to life.</p>
                <a href="#campaigns" style="color:white" class="btn btn-warning btn-lg">Explore Campaigns</a>
            </div>
        </div>
    </div>

    <table style="align-content: center">
        <tr>
            <td>
                <div id="about" class="about-section">
                    <div class="container">
                        <h2 class="text-center">About Us</h2>
                        <p class="text-center">Learn more about our mission and values.</p>
                        <br>
                        <p class="text-center">Welcome to Crowdfunding, where dreams come to life through the power of community support!</p>
                        <p class="text-center">Our Mission</p>
                        <p class="text-center">
                            At Crowdfunding, our mission is to bridge the gap between innovative ideas and the resources needed to bring them to fruition. We believe that every great idea deserves a chance to shine, and our platform is dedicated to providing a space where creators, visionaries, and changemakers can connect with supporters who believe in their projects.
                        </p>
                        <p class="text-center">Who We Are</p>
                        <p class="text-center">
                            We are a passionate team of entrepreneurs, developers, and creatives who understand the challenges of turning dreams into reality. Our diverse backgrounds and experiences drive our commitment to fostering an environment where projects of all shapes and sizes can find the backing they need to succeed.
                        </p>
                    </div>
                </div>
            </td>
            <td>
                <div>
                    <img src="{{ asset('images/hero.svg') }}" alt="Crowdfunding">
                </div>
            </td>
        </tr>
    </table>

    <div id="campaigns" class="campaign-listing">
        <div class="container">
            <h2 class="text-center">Featured Campaigns</h2>
            <div class="row">
                <!-- Example campaign card -->
                @foreach ($campaigns as $campaign)
                    <div class="col-md-4">
                        <div class="card campaign-card">
                            @if($campaign->photo)
                                <img src="{{ asset('storage/' . $campaign->photo) }}" class="card-img-top" alt="Campaign Photo">
                            @else
                                <img src="{{ asset('images/hero.svg') }}" class="card-img-top" alt="Default Photo">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $campaign->title }}</h5>
                                <p class="card-text">{{ Str::limit($campaign->description, 100) }}</p>
                                <a href="{{ route('campaigns.show', $campaign->id) }}" class="btn btn-primary">View Campaign</a>
                                @auth
                                    <a href="{{ route('contributions.create', $campaign->id) }}" style="color: white" class="btn btn-warning mt-2">Contribute</a>
                                @else
                                    <a href="{{ route('login') }}" style="color: white" class="btn btn-warning mt-2">Contribute</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="contact" class="contact-section">
        <div class="container">
            <h2 class="text-center">Contact Us</h2>
            <p class="text-center">We would love to hear from you. Get in touch with us.</p>
            <div class="icon-container">
                <a href="https://www.linkedin.com/in/yourprofile" target="_blank"><i class="fab fa-linkedin"></i></a>
                <a href="https://www.instagram.com/yourprofile" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="mailto:your-email@example.com"><i class="fas fa-envelope"></i></a>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Crowdfunding Platform. All rights reserved.</p>
            <p>
                <a href="#about">About</a> | 
                <a href="#campaigns">Campaigns</a> | 
                <a href="#contact">Contact</a>
            </p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
