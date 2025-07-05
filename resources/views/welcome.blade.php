<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Job Portal - Smart Career Solutions</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Smart job portal for career opportunities" name="keywords">
    <meta content="Connect with top jobs and talents effortlessly" name="description">
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f5f7fa; color: #333; }
        .header-carousel .owl-carousel-item img { height: 650px; object-fit: cover; filter: brightness(0.5); transition: filter 0.5s ease; }
        .header-carousel .owl-carousel-item:hover img { filter: brightness(0.7); }
        .carousel-text { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: #fff; text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.8); padding: 30px; background: rgba(45, 55, 72, 0.6); border-radius: 15px; }
        .carousel-text h1 { font-size: 3rem; font-weight: 600; margin-bottom: 1.5rem; background: linear-gradient(90deg, #2d3748, #4fd1c5); -webkit-background-clip: text; background-clip: text; color: transparent; transition: transform 0.4s ease, opacity 0.4s ease; }
        .carousel-text h1:hover { transform: scale(1.1); opacity: 1; }
        .carousel-text p { font-size: 1.5rem; font-weight: 400; margin-bottom: 2rem; color: #fff; text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.6); }
        .carousel-text .btn-primary { background: linear-gradient(90deg, #2d3748, #4fd1c5); border: none; font-size: 1.2rem; padding: 1rem 2rem; border-radius: 30px; transition: transform 0.4s ease, box-shadow 0.4s ease; }
        .carousel-text .btn-primary:hover { transform: translateY(-5px); box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); }
        .feature-item { background: #fff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 30px; transition: transform 0.4s ease, box-shadow 0.4s ease; cursor: pointer; background: linear-gradient(135deg, #ffffff, #f7fafc); }
        .feature-item:hover { transform: translateY(-15px); box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15); }
        .feature-item i { font-size: 3rem; color: #4fd1c5; margin-bottom: 1.5rem; transition: color 0.4s ease; }
        .feature-item:hover i { color: #2d3748; }
        .feature-item h5 { font-size: 1.5rem; font-weight: 600; color: #2d3748; margin-bottom: 1rem; }
        .feature-item p { font-size: 1.1rem; color: #4a5568; }
        .who-we-are { background: linear-gradient(135deg, #edf2f7, #ffffff); padding: 40px 0; }
        .who-we-are h1 { color: #2d3748; font-size: 2.5rem; font-weight: 600; text-align: center; margin-bottom: 30px; text-transform: uppercase; letter-spacing: 1px; }
        .who-we-are p { color: #4a5568; font-size: 1.2rem; line-height: 2; text-align: center; max-width: 900px; margin: 0 auto 40px; }
        .our-core-values { background: linear-gradient(135deg, #f7fafc, #ffffff); padding: 40px 0; }
        .our-core-values h1 { color: #2d3748; font-size: 2.5rem; font-weight: 600; text-align: center; margin-bottom: 30px; text-transform: uppercase; letter-spacing: 1px; }
        .our-core-values p { color: #4a5568; font-size: 1.2rem; line-height: 2; text-align: center; max-width: 900px; margin: 0 auto 40px; }
        .our-core-values .value-item { background: #fff; border: none; border-radius: 20px; padding: 30px; text-align: center; transition: transform 0.4s ease, box-shadow 0.4s ease; margin-bottom: 20px; }
        .our-core-values .value-item:hover { transform: translateY(-15px); box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15); }
        .our-core-values .value-item i { font-size: 3rem; color: #4fd1c5; margin-bottom: 1.5rem; }
        .our-core-values .value-item h5 { color: #2d3748; font-size: 1.5rem; font-weight: 600; }
        .our-core-values .value-item p { color: #4a5568; font-size: 1.1rem; }
        .what-we-do { background: linear-gradient(135deg, #ffffff, #e6f0fa); padding: 40px 0; }
        .what-we-do h1 { color: #2d3748; font-size: 2.5rem; font-weight: 600; text-align: center; margin-bottom: 30px; text-transform: uppercase; letter-spacing: 1px; }
        .what-we-do .service-item { background: #fff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 20px; margin-bottom: 20px; transition: transform 0.4s ease, box-shadow 0.4s ease; text-align: center; }
        .what-we-do .service-item:hover { transform: translateY(-10px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); }
        .what-we-do .service-item h5 { color: #2d3748; font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem; }
        .what-we-do .service-item p { color: #4a5568; font-size: 1.1rem; }
        .contact-section { background: #f7fafc; padding: 80px 0; }
        .contact-section h1 { color: #2d3748; font-size: 2.5rem; font-weight: 600; text-align: center; margin-bottom: 30px; text-transform: uppercase; letter-spacing: 1px; }
        .contact-form .form-control { border-radius: 15px; border-color: #e2e8f0; transition: border-color 0.4s ease; }
        .contact-form .form-control:focus { border-color: #4fd1c5; box-shadow: 0 0 10px rgba(79, 209, 197, 0.3); }
        .footer { background: linear-gradient(135deg, #2d3748, #1a202c); color: #ffffff; padding: 60px 0; }
        .navbar-nav .nav-link { padding: 12px 20px; border-radius: 10px; transition: background-color 0.4s ease, color 0.4s ease; font-weight: 500; }
        .navbar-nav .nav-link:hover, .navbar-nav .nav-link.active { background: linear-gradient(90deg, #2d3748, #4fd1c5); color: #fff !important; }
        .login-btn, .register-btn { margin-left: 15px; padding: 10px 25px; border-radius: 30px; background: linear-gradient(90deg, #2d3748, #4fd1c5); color: #fff; border: none; transition: transform 0.4s ease, box-shadow 0.4s ease; font-weight: 500; }
        .login-btn:hover, .register-btn:hover { transform: translateY(-5px); box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); }
        .loading-spinner { display: none; width: 2.5rem; height: 2.5rem; border: 4px solid #4fd1c5; border-top: 4px solid transparent; border-radius: 50%; animation: spin 1.2s linear infinite; margin: 0 auto; }
        @keyframes spin { to { transform: rotate(360deg); } }
        #spinner { display: none; }
        .back-to-top { background: linear-gradient(90deg, #2d3748, #4fd1c5); border-radius: 50%; transition: transform 0.4s ease, opacity 0.4s ease; }
        .back-to-top:hover { transform: rotate(360deg); opacity: 0.9; }
    </style>
</head>
<body>
    <div class="container-xxl bg-white p-0">
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
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
                    <a href="{{ route('welcome') }}" class="nav-item nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}">Home</a>
                    <a href="#about" class="nav-item nav-link">About</a>
                    <a href="#jobs" class="nav-item nav-link {{ request()->routeIs('jobs.index') ? 'active' : '' }}">Jobs</a>
                    <a href="#contact" class="nav-item nav-link">Contact</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="nav-item nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                            <a href="{{ route('logout') }}" class="nav-item nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <button class="login-btn" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                            <a href="{{ route('register') }}" class="register-btn">Register</a>
                        @endauth
                    @endif
                </div>
            </div>
        </nav>
        <div class="container-fluid p-0 mb-0">
            <div class="owl-carousel header-carousel position-relative">
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="{{ asset('img/carousel-1.jpg') }}" alt="Job seekers at work">
                    <div class="carousel-text">
                        <h1>Find Your Dream Job</h1>
                        <p>Unlock career opportunities with elegance and ease.</p>
                        <a href="{{ route('jobs.index') }}" class="btn btn-primary py-3 px-5 mt-3">Explore Jobs</a>
                    </div>
                </div>
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="{{ asset('img/carousel-2.jpg') }}" alt="Startup job environment">
                    <div class="carousel-text">
                        <h1>Grow Your Career</h1>
                        <p>Connect with top employers in style.</p>
                        <a href="{{ route('jobs.index') }}" class="btn btn-primary py-3 px-5 mt-3">Explore Jobs</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-xxl py-5 who-we-are" id="about">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s"> About Us</h1>
                <p class="wow fadeInUp" data-wow-delay="0.2s">JobSmart is a premier career solutions platform dedicated to connecting talented professionals with leading organizations. Our mission is to deliver exceptional job opportunities and innovative services, fostering a dynamic ecosystem where talent and ambition thrive.</p>
            </div>
        </div>
        <div class="container-xxl py-5 what-we-do" id="jobs">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s"> What We Do</h1>
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
                            <p>Offer training to enhance employability and career growth.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="service-item">
                            <h5>Resume Building</h5>
                            <p>Assist in creating standout resumes for job applications.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="service-item">
                            <h5>Interview Prep</h5>
                            <p>Prepare candidates with mock interviews and strategies.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-xxl py-5 our-core-values">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s"> Our Values</h1>
                <p class="wow fadeInUp" data-wow-delay="0.2s">At JobSmart, we uphold the highest standards of excellence, integrity, and innovation. Our commitment to delivering exceptional career solutions drives us to build lasting partnerships and empower professionals with the resources they need to thrive in a competitive world.</p>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="value-item">
                            <i class="fas fa-balance-scale"></i>
                            <h5>Integrity</h5>
                            <p>We operate with transparency and ethical principles in all our endeavors.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="value-item">
                            <i class="fas fa-lightbulb"></i>
                            <h5>Innovation</h5>
                            <p>We embrace cutting-edge solutions to redefine career opportunities.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="value-item">
                            <i class="fas fa-handshake"></i>
                            <h5>Partnership</h5>
                            <p>We foster strong, collaborative relationships with our clients and partners.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid contact-section bg-light" id="contact">
            <div class="container py-5">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s"> Get in Touch</h1>
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="contact-form">
                            <form action="{{ route('contact.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control" name="message" placeholder="Message" rows="5" required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary py-2 px-4">Send Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="map-container">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.019788424739!2d-122.41941568468134!3d37.77492977975947!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8085808f3c7b3d2d%3A0x4b1c7b7b7b7b7b7b!2sSan%20Francisco%2C%20CA!5e0!3m2!1sen!2sus!4v1631234567890!5m2!1sen!2sus" width="100%" height="100%" style="border:0; border-radius: 15px;" allowfullscreen="" loading="lazy"></iframe>
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
                        <p class="mb-4">Your premier destination for elite job opportunities and connections with top-tier employers.</p>
                        <p><i class="fa fa-map-marker-alt me-3"></i>123 Elegance St, Kigali, Rwanda</p>
                        <p><i class="fa fa-phone-alt me-3"></i>+250 788 123 456</p>
                        <p><i class="fa fa-envelope me-3"></i>info@jobsmart.com</p>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h5 class="text-white mb-4">Quick Links</h5>
                        <a class="btn btn-link text-white" href="{{ route('welcome') }}">Home</a>
                        <a class="btn btn-link text-white" href="#about">About</a>
                        <a class="btn btn-link text-white" href="{{ route('jobs.index') }}">Jobs</a>
                        <a class="btn btn-link text-white" href="#contact">Contact</a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h5 class="text-white mb-4">Follow Us</h5>
                        <div class="d-flex">
                            <a class="btn btn-square btn-light me-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square btn-light me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-light me-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-square btn-light" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright text-center">
                    <div class="row">
                        <div class="col-12 text-white">
                            © <a class="text-white border-bottom" href="#">JobSmart</a>, All Rights Reserved. | Designed with Excellence by <a class="text-white border-bottom" href="#">SmartDev</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                <div class="modal-header bg-primary text-white" style="border-radius: 20px 20px 0 0;">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label text-dark">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label text-dark">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.header-carousel').owlCarousel({
                loop: true,
                margin: 0,
                nav: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 6000,
                responsive: {
                    0: { items: 1 },
                    600: { items: 1 },
                    1000: { items: 1 }
                }
            });

            $("#spinner").removeClass("show");

            new WOW().init();
        });
    </script>
    </body>
</html>