<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Job Portal - Smart Career Solutions</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Smart job portal for career opportunities" name="keywords">
    <meta content="Connect with top jobs and talents effortlessly with JobSmart, your premier career platform." name="description">
    <meta name="robots" content="index, follow">
    <meta name="author" content="JobSmart Team">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f5f7fa; color: #333; overflow-x: hidden; }
        .top-header { background: #2d3748; color: #fff; padding: 10px 0; font-size: 0.9rem; transition: background 0.3s ease; }
        .top-header .contact-info a, .top-header .social-icons a { color: #fff; text-decoration: none; margin: 0 10px; transition: color 0.3s ease; }
        .top-header .social-icons a:hover { color: #38b2ac; }
        .header-carousel { position: relative; height: 100vh; overflow: hidden; }
        .header-carousel .owl-carousel-item { height: 100vh; }
        .header-carousel .owl-carousel-item img { width: 100%; height: 100%; object-fit: cover; filter: brightness(0.5); transition: filter 0.5s ease; }
        .header-content { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: #fff; z-index: 1; }
        .header-content h1 { font-size: 4.5rem; font-weight: 700; background: linear-gradient(45deg, #fff, #e6f0fa); -webkit-background-clip: text; background-clip: text; color: transparent; text-transform: uppercase; animation: fadeIn 1s ease-out; }
        .header-content p { font-size: 1.6rem; color: #e6f0fa; margin: 1rem 0; animation: fadeInUp 1s ease-out 0.5s backwards; }
        .header-content .btn-register { background: linear-gradient(90deg, #38b2ac, #6b46c1); border: none; padding: 1.2rem 3rem; font-size: 1.3rem; font-weight: 600; color: #fff; border-radius: 35px; transition: all 0.3s ease; }
        .header-content .btn-register:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(56, 178, 172, 0.4); }
        .parallax { background: linear-gradient(rgba(45, 55, 72, 0.7), rgba(45, 55, 72, 0.7)); height: 100%; width: 100%; position: absolute; top: 0; left: 0; z-index: 0; transition: opacity 0.5s ease; }
        .navbar { background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: background 0.3s ease; }
        .navbar-nav .nav-link { padding: 0.8rem 1.5rem; color: #2d3748; font-weight: 500; transition: all 0.3s ease; }
        .navbar-nav .nav-link:hover, .navbar-nav .nav-link.active { color: #fff; background: linear-gradient(90deg, #2d3748, #4fd1c5); border-radius: 5px; }
        .login-btn, .register-btn { margin: 0 0.5rem; padding: 0.5rem 1.5rem; border-radius: 25px; border: none; font-weight: 600; transition: all 0.3s ease; }
        .login-btn { background: linear-gradient(135deg, #38b2ac, #6b46c1); color: #fff; }
        .login-btn:hover { background: linear-gradient(135deg, #2d3748, #38b2ac); }
        .register-btn { background: linear-gradient(135deg, #6b46c1, #38b2ac); color: #fff; }
        .register-btn:hover { background: linear-gradient(135deg, #38b2ac, #2d3748); }
        .who-we-are, .what-we-do, .our-core-values { background: linear-gradient(135deg, #edf2f7, #ffffff); padding: 40px 0; transition: background 0.5s ease; }
        .what-we-do .service-item, .our-core-values .value-item { background: #fff; border-radius: 20px; padding: 20px; text-align: center; transition: all 0.4s ease; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .what-we-do .service-item:hover, .our-core-values .value-item:hover { transform: translateY(-10px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); }
        .footer { background: linear-gradient(135deg, #2d3748, #1a202c); color: #ffffff; padding: 60px 0; }
        .back-to-top { background: linear-gradient(90deg, #2d3748, #38b2ac); border-radius: 50%; transition: all 0.3s ease; }
        .back-to-top:hover { transform: scale(1.1); }
        .loading-spinner { display: none; width: 2.5rem; height: 2.5rem; border: 4px solid #38b2ac; border-top: 4px solid transparent; border-radius: 50%; animation: spin 1.2s linear infinite; margin: 0 auto; }
        .map-container { position: relative; height: 400px; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
        .map-container iframe { width: 100%; height: 100%; border: 0; }
        .map-overlay { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(45, 55, 72, 0.8); padding: 20px; border-radius: 10px; text-align: center; }
        .map-overlay button { background: linear-gradient(90deg, #38b2ac, #6b46c1); border: none; padding: 10px 20px; color: #fff; margin: 5px; border-radius: 25px; transition: all 0.3s ease; }
        .map-overlay button:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(56, 178, 172, 0.4); }
        .modal-content { border-radius: 10px; }
        .modal-header { background: #38b2ac; color: #fff; }
        .modal-header.bg-success { background: #28a745; }
        .custom-error { color: #dc3545; font-size: 0.9rem; margin-top: 0.25rem; display: block; }
        .form-control { border-radius: 8px; border: 1px solid #ced4da; padding: 10px; transition: all 0.3s ease; }
        .form-control:focus { border-color: #38b2ac; box-shadow: 0 0 5px rgba(56, 178, 172, 0.5); }
        .btn-primary { background: #38b2ac; border: none; border-radius: 8px; padding: 10px; transition: all 0.3s ease; }
        .btn-primary:hover { background: #2d3748; }
        .alert-success, .alert-danger { border-radius: 8px; padding: 10px; margin-bottom: 1rem; animation: fadeIn 0.5s ease-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>
</head>
<body>
    <div class="top-header">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="contact-info">
                <a href="mailto:info@jobsmart.com"><i class="fa fa-envelope me-2"></i>info@jobsmart.com</a>
                <a href="tel:+250788123456" class="ms-4"><i class="fa fa-phone-alt me-2"></i>+250 788 123 456</a>
            </div>
            <div class="social-icons">
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
    <div class="container-xxl bg-white p-0">
        <div id="spinner" class="bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3.5rem; height: 3.5rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="{{ route('welcome') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
                <h2 class="m-0 text-primary"><i class="fas fa-briefcase me-3"></i>JobSmart</h2>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="#about" class="nav-item nav-link">About Us</a>
                    <a href="#jobs" class="nav-item nav-link">What We Do</a>
                    <a href="#values" class="nav-item nav-link">Our Values</a>
                    <a href="#contact" class="nav-item nav-link">Contact</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="nav-item nav-link">Dashboard</a>
                            <a href="{{ route('logout') }}" class="nav-item nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <button class="login-btn" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                            <button class="register-btn" data-bs-toggle="modal" data-bs-target="#registerModal">Apply</button>
                        @endauth
                    @endif
                </div>
            </div>
        </nav>
        <div class="container-fluid p-0 mb-0">
            <div class="owl-carousel header-carousel position-relative">
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="{{ asset('img/carousel-1.jpg') }}" alt="Job seekers at work" loading="lazy">
                    <div class="parallax"></div>
                    <div class="header-content">
                        <h1>Unlock Your Career</h1>
                        <p>Discover top opportunities with JobSmart</p>
                        <button class="btn btn-register" data-bs-toggle="modal" data-bs-target="#registerModal">Apply Now</button>
                    </div>
                </div>
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="{{ asset('img/carousel-2.jpg') }}" alt="Startup job environment" loading="lazy">
                    <div class="parallax"></div>
                    <div class="header-content">
                        <h1>Build Your Future</h1>
                        <p>Connect with leading employers today</p>
                        <button class="btn btn-register" data-bs-toggle="modal" data-bs-target="#registerModal">Apply Now</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-xxl py-5 who-we-are" id="about">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">About Us</h1>
                <p class="lead text-center wow fadeInUp" data-wow-delay="0.2s">At JobSmart, we’re more than just a job portal—we’re your partner in building a thriving career. Founded with a vision to bridge the gap between talent and opportunity, we’ve empowered thousands of professionals across Rwanda and beyond to find meaningful work that aligns with their skills and aspirations. Our journey began with a simple idea: to create a platform where ambition meets innovation. Today, we proudly connect top-tier candidates with leading organizations, fostering a community driven by excellence, diversity, and growth. With cutting-edge technology and a dedicated team, JobSmart is committed to shaping the future of work—one career at a time.</p>
            </div>
        </div>
        <div class="container-xxl py-5 what-we-do" id="jobs">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">What We Do</h1>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item">
                            <h5>Job Matching</h5>
                            <p>Connect talents with ideal career opportunities seamlessly.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="service-item">
                            <h5>Career Guidance</h5>
                            <p>Provide expert advice to navigate your professional journey.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="service-item">
                            <h5>Employer Solutions</h5>
                            <p>Help businesses find top-tier candidates efficiently.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="service-item">
                            <h5>Skill Development</h5>
                            <p>Offer training programs to enhance your employability.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="service-item">
                            <h5>Resume Building</h5>
                            <p>Assist in crafting professional resumes to stand out.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="service-item">
                            <h5>Interview Prep</h5>
                            <p>Provide mock interviews to boost your confidence.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-xxl py-5 our-core-values" id="values">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Our Values</h1>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="value-item">
                            <i class="fas fa-balance-scale"></i>
                            <h5>Integrity</h5>
                            <p>We operate with transparency and ethical principles.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="value-item">
                            <i class="fas fa-lightbulb"></i>
                            <h5>Innovation</h5>
                            <p>We embrace cutting-edge solutions to redefine opportunities.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="value-item">
                            <i class="fas fa-handshake"></i>
                            <h5>Partnership</h5>
                            <p>We foster collaborative relationships with clients.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="value-item">
                            <i class="fas fa-users"></i>
                            <h5>Diversity</h5>
                            <p>We celebrate and include diverse talents and perspectives.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="value-item">
                            <i class="fas fa-shield-alt"></i>
                            <h5>Trust</h5>
                            <p>We build lasting trust with every interaction.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.8s">
                        <div class="value-item">
                            <i class="fas fa-chart-line"></i>
                            <h5>Excellence</h5>
                            <p>We strive for the highest standards in all we do.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-xxl py-5" id="contact">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Get in Touch</h1>
                <div class="row g-4">
                    <div class="col-12">
                        <div class="row gy-4">
                            <div class="col-md-4">
                                <h5 class="text-primary mb-4">Quick Contact</h5>
                                <p><i class="fa fa-envelope me-3"></i>info@jobsmart.com</p>
                                <p><i class="fa fa-phone-alt me-3"></i>+250 788 123 456</p>
                                <p><i class="fa fa-map-marker-alt me-3"></i>123 Main St, Kigali, Rwanda</p>
                                <div class="d-flex pt-2">
                                    <a class="btn btn-square btn-light me-2" href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-light me-2" href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-light me-2" href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                                    <a class="btn btn-square btn-light" href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h5 class="text-primary mb-4">Send Us a Message</h5>
                                <form id="contactForm" action="{{ route('contact.submit') }}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control border-0 bg-light px-4" name="name" placeholder="Your Name" required>
                                            <span class="custom-error error-name"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="email" class="form-control border-0 bg-light px-4" name="email" placeholder="Your Email" required>
                                            <span class="custom-error error-email"></span>
                                        </div>
                                        <div class="col-12">
                                            <input type="text" class="form-control border-0 bg-light px-4" name="subject" placeholder="Subject" required>
                                            <span class="custom-error error-subject"></span>
                                        </div>
                                        <div class="col-12">
                                            <textarea class="form-control border-0 bg-light px-4 py-3" name="message" rows="4" placeholder="Message" required></textarea>
                                            <span class="custom-error error-message"></span>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="map-container">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15947.25878431133!2d30.0596!3d-1.9441!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dcaea7a1a8f8a3%3A0x1e4b0c6a5f2f3f!2sKigali%2C%20Rwanda!5e0!3m2!1sen!2sus!4v1623456789!5m2!1sen!2sus" allowfullscreen="" loading="lazy"></iframe>
                            <div class="map-overlay">
                                <button onclick="window.location.href='mailto:info@jobsmart.com'">Email Us</button>
                                <button onclick="window.open('tel:+250788123456')">Call Us</button>
                                <button onclick="window.open('https://www.google.com/maps/dir/?api=1&destination=123+Main+St,+Kigali,+Rwanda')">Get Directions</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid footer py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-4 col-md-6">
                        <h5 class="text-white mb-4">JobSmart</h5>
                        <p class="mb-4">Your premier destination for elite job opportunities.</p>
                        <p><i class="fa fa-map-marker-alt me-3"></i>123 Main St, Kigali, Rwanda</p>
                        <p><i class="fa fa-phone-alt me-3"></i>+250 788 123 456</p>
                        <p><i class="fa fa-envelope me-3"></i>info@jobsmart.com</p>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h5 class="text-white mb-4">Quick Links</h5>
                        <a class="btn btn-link text-white" href="{{ route('welcome') }}">Home</a>
                        <a class="btn btn-link text-white" href="#about">About Us</a>
                        <a class="btn btn-link text-white" href="#jobs">What We Do</a>
                        <a class="btn btn-link text-white" href="#values">Our Values</a>
                        <a class="btn btn-link text-white" href="#contact">Contact</a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h5 class="text-white mb-4">Follow Us</h5>
                        <div class="d-flex">
                            <a class="btn btn-square btn-light me-2" href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square btn-light me-2" href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-light me-2" href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-square btn-light" href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright text-center">
                    <div class="row">
                        <div class="col-12 text-white">
                            © <a class="text-white border-bottom" href="#">JobSmart</a>, All Rights Reserved.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="loginForm" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="login_email" class="form-label text-dark">Email address</label>
                            <input type="email" class="form-control" id="login_email" name="email" required>
                            <span class="custom-error error-email"></span>
                        </div>
                        <div class="mb-4">
                            <label for="login_password" class="form-label text-dark">Password</label>
                            <input type="password" class="form-control" id="login_password" name="password" required>
                            <span class="custom-error error-password"></span>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="registerModalLabel">Register as an Applicant</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="register-success-message" class="alert alert-success d-none" role="alert"></div>
                    <div id="register-error-message" class="alert alert-danger d-none" role="alert"></div>
                    <form id="newApplicationForm" method="POST" action="{{ route('applications.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="full_name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="full_name" name="full_name" required>
                                    <span class="custom-error error-full_name"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone" required pattern="^(?:\+250|07)[0-9]{8}$" title="Phone must start with +250 or 07 followed by 8 digits">
                                    <span class="custom-error error-phone"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <span class="custom-error error-email"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_number" class="form-label">ID Number</label>
                                    <input type="text" class="form-control" id="id_number" name="id_number" required pattern="[0-9]{16}" title="ID number must be 16 digits">
                                    <span class="custom-error error-id_number"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department_id" class="form-label">Department</label>
                                    <select class="form-control" id="department_id" name="department_id" required>
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="custom-error error-department_id"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="province_id" class="form-label">Province</label>
                                    <select class="form-control" id="province_id" name="province_id" required>
                                        <option value="">Select Province</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="custom-error error-province_id"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="district_id" class="form-label">District</label>
                                    <select class="form-control" id="district_id" name="district_id" required>
                                        <option value="">Select District</option>
                                    </select>
                                    <span class="custom-error error-district_id"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sector_id" class="form-label">Sector</label>
                                    <select class="form-control" id="sector_id" name="sector_id" required>
                                        <option value="">Select Sector</option>
                                    </select>
                                    <span class="custom-error error-sector_id"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="cv" class="form-label">Upload CV</label>
                                    <input type="file" class="form-control" id="cv" name="cv" accept=".pdf,.doc,.docx">
                                    <small class="form-text text-muted">PDF, DOC, DOCX (Max 2MB)</small>
                                    <span class="custom-error error-cv"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="degree" class="form-label">Upload Degree</label>
                                    <input type="file" class="form-control" id="degree" name="degree" accept=".pdf,.doc,.docx">
                                    <small class="form-text text-muted">PDF, DOC, DOCX (Max 2MB)</small>
                                    <span class="custom-error error-degree"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="id_doc" class="form-label">Upload ID Document</label>
                                    <input type="file" class="form-control" id="id_doc" name="id_doc" accept=".pdf,.jpg,.jpeg,.png">
                                    <small class="form-text text-muted">PDF, JPG, JPEG, PNG (Max 2MB)</small>
                                    <span class="custom-error error-id_doc"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100 py-3">Submit Application</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">Application Successful</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <p id="successMessage"></p>
                    <button type="button" class="btn btn-success w-100 py-2" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}" defer></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}" defer></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}" defer></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script>
        $(document).ready(function() {
            $('.header-carousel').owlCarousel({
                loop: true,
                margin: 0,
                nav: false, // Removed < > arrows
                dots: true,
                autoplay: true,
                autoplayTimeout: 7000,
                items: 1
            });

            $('#spinner').hide();
            new WOW().init();

            $('#registerModal').on('show.bs.modal', function() {
                $('#newApplicationForm')[0].reset();
                $('.custom-error').text('');
                $('#register-success-message, #register-error-message').addClass('d-none');
                $('#district_id').html('<option value="">Select District</option>');
                $('#sector_id').html('<option value="">Select Sector</option>');
            });

            $('#province_id').on('change', function() {
                var provinceId = $(this).val();
                $('#district_id').html('<option value="">Select District</option>');
                $('#sector_id').html('<option value="">Select Sector</option>');
                $('.error-district_id, .error-sector_id').text('');
                if (provinceId) {
                    $.ajax({
                        url: '/districts?province_id=' + provinceId,
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if (data.length === 0) {
                                $('.error-district_id').text('No districts available for this province.');
                            } else {
                                $.each(data, function(key, district) {
                                    $('#district_id').append(`<option value="${district.id}">${district.name}</option>`);
                                });
                            }
                        },
                        error: function(xhr) {
                            $('.error-district_id').text('Error loading districts: ' + xhr.statusText);
                            console.error('Districts AJAX error:', xhr);
                        }
                    });
                }
            });

            $('#district_id').on('change', function() {
                var districtId = $(this).val();
                $('#sector_id').html('<option value="">Select Sector</option>');
                $('.error-sector_id').text('');
                if (districtId) {
                    $.ajax({
                        url: '/sectors?district_id=' + districtId,
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if (data.length === 0) {
                                $('.error-sector_id').text('No sectors available for this district.');
                            } else {
                                $.each(data, function(key, sector) {
                                    $('#sector_id').append(`<option value="${sector.id}">${sector.name}</option>`);
                                });
                            }
                        },
                        error: function(xhr) {
                            $('.error-sector_id').text('Error loading sectors: ' + xhr.statusText);
                            console.error('Sectors AJAX error:', xhr);
                        }
                    });
                }
            });

            function validateFileSize(file, field, maxSizeMB) {
                if (file && file.size > maxSizeMB * 1024 * 1024) {
                    return `File size must not exceed ${maxSizeMB}MB`;
                }
                return '';
            }

            function validatePhone(phone) {
                const regex = /^(?:\+250|07)[0-9]{8}$/;
                return regex.test(phone) ? '' : 'Phone must start with +250 or 07 followed by 8 digits';
            }

            $('#phone').on('input', function() {
                var phone = $(this).val();
                var error = validatePhone(phone);
                $('.error-phone').text(error);
            });

            $('#cv, #degree, #id_doc').on('change', function() {
                var error = validateFileSize(this.files[0], $(this).attr('id'), 2);
                $('.error-' + $(this).attr('id')).text(error);
            });

            $('#newApplicationForm').on('submit', function(e) {
                e.preventDefault();
                $('.custom-error').text('');
                $('#register-success-message, #register-error-message').addClass('d-none');

                var formData = new FormData(this);
                var errors = [];
                ['cv', 'degree', 'id_doc'].forEach(function(field) {
                    var file = $(`#${field}`)[0].files[0];
                    var error = validateFileSize(file, field, 2);
                    if (error) errors.push(error);
                });

                var phoneError = validatePhone($('#phone').val());
                if (phoneError) {
                    errors.push(phoneError);
                    $('.error-phone').text(phoneError);
                }

                if (errors.length) {
                    $('#register-error-message').removeClass('d-none').text(errors.join(', '));
                    return;
                }

                $.ajax({
                    url: '{{ route('applications.store') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $('#spinner').show();
                        $('#newApplicationForm button[type="submit"]').prop('disabled', true).text('Submitting...');
                    },
                    complete: function() {
                        $('#spinner').hide();
                        $('#newApplicationForm button[type="submit"]').prop('disabled', false).text('Submit Application');
                    },
                    success: function(response) {
                        $('#newApplicationForm')[0].reset();
                        $('#registerModal').modal('hide');
                        $('#successMessage').text(response.message || 'Application submitted successfully!');
                        $('#successModal').modal('show');
                        setTimeout(function() {
                            $('#successModal').modal('hide');
                        }, 5000);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.error-' + key.replace('.', '_')).text(value[0]);
                            });
                        } else {
                            $('#register-error-message').removeClass('d-none').text('An error occurred: ' + (xhr.responseJSON?.error || xhr.statusText));
                            console.error('Form submission error:', xhr);
                        }
                    }
                });
            });

            $('#contactForm').on('submit', function(e) {
                e.preventDefault();
                $('.custom-error').text('');
                var formData = new FormData(this);
                $.ajax({
                    url: '{{ route('contact.submit') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $('#spinner').show();
                        $('#contactForm button[type="submit"]').prop('disabled', true).text('Sending...');
                    },
                    complete: function() {
                        $('#spinner').hide();
                        $('#contactForm button[type="submit"]').prop('disabled', false).text('Send Message');
                    },
                    success: function(response) {
                        $('#contactForm')[0].reset();
                        alert(response.message || 'Message sent successfully!');
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.error-' + key).text(value[0]);
                            });
                        } else {
                            alert('An error occurred: ' + (xhr.responseJSON?.error || xhr.statusText));
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>