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
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .header-carousel .owl-carousel-item img { height: 600px; object-fit: cover; filter: brightness(0.6); transition: filter 0.5s ease; }
        .header-carousel .owl-carousel-item:hover img { filter: brightness(0.8); }
        .carousel-text { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: #fff; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); padding: 20px; }
        .carousel-text h1 { font-size: 3.5rem; font-weight: 700; margin-bottom: 1rem; background: linear-gradient(90deg, #1e3a8a, #00B074); -webkit-background-clip: text; background-clip: text; color: transparent; transition: transform 0.3s ease, opacity 0.3s ease; }
        .carousel-text h1:hover { transform: scale(1.05); opacity: 0.9; }
        .carousel-text p { font-size: 1.5rem; font-weight: 400; margin-bottom: 1.5rem; color: #fff; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5); }
        .carousel-text .btn-primary { background-color: #00B074; border-color: #00B074; font-size: 1.1rem; padding: 0.75rem 1.5rem; border-radius: 25px; transition: background-color 0.3s ease, transform 0.3s ease; }
        .carousel-text .btn-primary:hover { background-color: #028654; transform: translateY(-2px); }
        .job-item { background: #ffffff; border: 1px solid #e9ecef; border-radius: 10px; padding: 15px; transition: transform 0.3s, box-shadow 0.3s; }
        .job-item:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); }
        .job-item h5 { font-size: 1.5rem; font-weight: 600; color: #1e3a8a; margin-bottom: 0.5rem; }
        .job-item p { font-size: 0.9rem; color: #6c757d; margin: 0.25rem 0; }
        .job-item .btn-primary { background-color: #1e3a8a; border-color: #1e3a8a; font-size: 0.875rem; padding: 0.25rem 0.75rem; }
        .job-item .btn-primary:hover { background-color: #172554; border-color: #172554; }
        .btn-primary { background-color: #1e3a8a; border-color: #1e3a8a; }
        .btn-primary:hover { background-color: #172554; border-color: #172554; }
        .search-bar { background: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); margin-bottom: 20px; }
        .footer { background: #1e3a8a; color: #ffffff; }
        .contact-section { padding: 40px 0; background-color: #f1f3f5; }
        .contact-form .form-control { background: #e9ecef; border: none; color: #333; margin-bottom: 10px; }
        .contact-form .form-control:focus { background: #e9ecef; box-shadow: none; }
        .contact-form .btn-primary { background-color: #00B074; border-color: #00B074; width: 100%; }
        .contact-form .btn-primary:hover { background-color: #028654; }
        .map-container { height: 400px; margin-top: 20px; }
        .job-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 20px; }
        .loading-spinner { display: none; width: 2rem; height: 2rem; border: 3px solid #00B074; border-top: 3px solid transparent; border-radius: 50%; animation: spin 1s linear infinite; margin: 0 auto; }
        @keyframes spin { to { transform: rotate(360deg); } }
        .modal-content { background: linear-gradient(135deg, #00B074, #1e3a8a); color: #fff; border: none; border-radius: 15px; }
        .modal-header, .modal-footer { border: none; }
        .modal-body { text-align: left; padding: 2rem; }
        .navbar-nav .nav-link { padding: 10px 15px; border-radius: 5px; transition: background-color 0.3s, color 0.3s; }
        .navbar-nav .nav-link:hover, .navbar-nav .nav-link.active { background-color: #00B074; color: #fff !important; }
        .login-btn, .register-btn { margin-left: 10px; padding: 8px 20px; border-radius: 25px; background-color: #1e3a8a; color: #fff; border: none; transition: background-color 0.3s, transform 0.3s; }
        .login-btn:hover, .register-btn:hover { background-color: #172554; transform: translateY(-2px); }
        .apply-modal-details { margin-top: 15px; display: none; }
        .apply-modal-details input, .apply-modal-details select, .registration-modal-details input, .registration-modal-details select { background-color: #e9ecef; border: none; color: #333; margin-bottom: 10px; }
        .modal.fade .modal-dialog { transition: transform 0.3s ease-out, opacity 0.2s; }
        .modal.show .modal-dialog { transform: translate(0, -50px); }
        #successModal { display: none; }
        #successModal .modal-content { background: linear-gradient(135deg, #00B074, #1e3a8a); color: #fff; border-radius: 15px; }
        #successModal .modal-body { text-align: center; padding: 2rem; }
        .job-title-highlight { font-size: 1.5rem; font-weight: 700; color: #fff; background: rgba(0, 0, 0, 0.7); padding: 15px; border-radius: 8px; margin-bottom: 1.5rem; text-align: center; border: 2px solid #00B074; }
    </style>
</head>
<body>
    <div class="container-xxl bg-white p-0">
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
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
        <div class="container-fluid p-0 mb-5">
            <div class="owl-carousel header-carousel position-relative">
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="{{ asset('img/carousel-1.jpg') }}" alt="Job seekers at work">
                    <div class="carousel-text">
                        <h1>Find Your Dream Job</h1>
                        <p>Unlock career opportunities with ease.</p>
                        <a href="{{ route('jobs.index') }}" class="btn btn-primary py-3 px-5 mt-3">Explore Jobs</a>
                    </div>
                </div>
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="{{ asset('img/carousel-2.jpg') }}" alt="Startup job environment">
                    <div class="carousel-text">
                        <h1>Grow Your Career</h1>
                        <p>Connect with top employers today.</p>
                        <a href="{{ route('jobs.index') }}" class="btn btn-primary py-3 px-5 mt-3">Explore Jobs</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container my-5">
            <div class="search-bar wow fadeInUp" data-wow-delay="0.1s">
                <form action="{{ route('jobs.index') }}" method="get">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="keyword" placeholder="Job Title or Keyword" value="{{ request('keyword') }}">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="category">
                                <option value="">Select Category</option>
                                <option value="1" @if(request('category') == '1') selected @endif>Category 1</option>
                                <option value="2" @if(request('category') == '2') selected @endif>Category 2</option>
                                <option value="3" @if(request('category') == '3') selected @endif>Category 3</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="location">
                                <option value="">Select Location</option>
                                <option value="1" @if(request('location') == '1') selected @endif>Location 1</option>
                                <option value="2" @if(request('location') == '2') selected @endif>Location 2</option>
                                <option value="3" @if(request('location') == '3') selected @endif>Location 3</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Search Jobs</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @php
            $departments = App\Models\Department::all();
            $provinces = App\Models\Province::all();
        @endphp
        <div class="container-xxl py-5" id="jobs">
            <div class="container">
                <h1 class="text-center mb-5 text-dark wow fadeInUp" data-wow-delay="0.1s">Job Opportunities</h1>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-full-time">
                                <h6 class="mt-n1 mb-0">Full Time <span class="badge bg-primary ms-2">{{ $jobs->where('job_type', 'full_time')->count() }}</span></h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-part-time">
                                <h6 class="mt-n1 mb-0">Part Time <span class="badge bg-primary ms-2">{{ $jobs->where('job_type', 'part_time')->count() }}</span></h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-freelance">
                                <h6 class="mt-n1 mb-0">Freelance <span class="badge bg-primary ms-2">{{ $jobs->where('job_type', 'freelance')->count() }}</span></h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-internship">
                                <h6 class="mt-n1 mb-0">Internship <span class="badge bg-primary ms-2">{{ $jobs->where('job_type', 'internship')->count() }}</span></h6>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-full-time" class="tab-pane fade show p-0 active">
                            <div class="job-grid">
                                @foreach ($jobs->where('job_type', 'full_time') as $job)
                                    <div class="job-item p-4 mb-4">
                                        <div class="row g-4">
                                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                                <img class="flex-shrink-0 img-fluid border rounded" src="{{ $job->company->logo ? asset('storage/' . $job->company->logo) : asset('img/default-logo.png') }}" alt="{{ $job->company->name }}" style="width: 80px; height: 80px;">
                                                <div class="text-start ps-4">
                                                    <h5 class="mb-3">{{ $job->title }}</h5>
                                                    <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $job->location }}</p>
                                                    <p><i class="fa fa-building text-primary me-2"></i>{{ $job->company->name }}</p>
                                                    <p><i class="fa fa-clock text-primary me-2"></i>{{ $job->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                                <div class="d-flex mb-3">
                                                    <a class="btn btn-light btn-square me-3" href="{{ route('jobs.show', $job->job_id) }}"><i class="far fa-heart text-primary"></i></a>
                                                    <button class="btn btn-primary" id="apply-btn-{{ $job->job_id }}" data-bs-toggle="modal" data-bs-target="#registerModal-{{ $job->job_id }}" data-job-title="{{ $job->title }}">Apply Now</button>
                                                </div>
                                                <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Deadline: {{ $job->deadline }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="registerModal-{{ $job->job_id }}" tabindex="-1" aria-labelledby="registerModalLabel-{{ $job->job_id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="registerModalLabel-{{ $job->job_id }}">Apply for {{ $job->title }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h3 class="job-title-highlight">{{ $job->title }} at {{ $job->company->name }}</h3>
                                                    <div id="register-success-message-{{ $job->job_id }}" class="alert alert-success d-none" role="alert"></div>
                                                    <div id="register-error-message-{{ $job->job_id }}" class="alert alert-danger d-none" role="alert"></div>
                                                    <form id="apply-form-{{ $job->job_id }}" action="{{ route('applicables.store') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="job_id" value="{{ $job->job_id }}">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="names-{{ $job->job_id }}">Full Name</label>
                                                                    <input type="text" class="form-control registration-modal-details" id="names-{{ $job->job_id }}" name="names" required>
                                                                    <span class="text-danger error-names"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="phone-{{ $job->job_id }}">Phone Number</label>
                                                                    <input type="text" class="form-control registration-modal-details" id="phone-{{ $job->job_id }}" name="phone" required pattern="^(?:\+250|07)\d{8}$" title="Phone must start with +250 or 07 followed by 8 digits">
                                                                    <span class="text-danger error-phone"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="email-{{ $job->job_id }}">Email</label>
                                                                    <input type="email" class="form-control registration-modal-details" id="email-{{ $job->job_id }}" name="email" required>
                                                                    <span class="text-danger error-email" id="emailFeedback-{{ $job->job_id }}"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="id_number-{{ $job->job_id }}">ID Number</label>
                                                                    <input type="text" class="form-control registration-modal-details" id="id_number-{{ $job->job_id }}" name="id_number" required pattern="\d{16}" title="Must be 16 digits">
                                                                    <span class="text-danger error-id_number"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="department_id-{{ $job->job_id }}">Department</label>
                                                                    <select class="form-control registration-modal-details" id="department_id-{{ $job->job_id }}" name="department_id" required>
                                                                        <option value="">Select Department</option>
                                                                        @foreach ($departments as $department)
                                                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="text-danger error-department_id"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="province_id-{{ $job->job_id }}">Province</label>
                                                                    <select class="form-control registration-modal-details" id="province_id-{{ $job->job_id }}" name="province_id" required>
                                                                        <option value="">Select Province</option>
                                                                        @foreach ($provinces as $province)
                                                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="text-danger error-province_id"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="district_id-{{ $job->job_id }}">District</label>
                                                                    <select class="form-control registration-modal-details" id="district_id-{{ $job->job_id }}" name="district_id" required>
                                                                        <option value="">Select District</option>
                                                                    </select>
                                                                    <span class="text-danger error-district_id"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="sector_id-{{ $job->job_id }}">Sector</label>
                                                                    <select class="form-control registration-modal-details" id="sector_id-{{ $job->job_id }}" name="sector_id" required>
                                                                        <option value="">Select Sector</option>
                                                                    </select>
                                                                    <span class="text-danger error-sector_id"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="cv-{{ $job->job_id }}">Upload CV</label>
                                                                    <input type="file" class="form-control registration-modal-details" id="cv-{{ $job->job_id }}" name="cv" accept=".pdf,.doc,.docx">
                                                                    <span class="text-danger error-cv"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="degree-{{ $job->job_id }}">Upload Degree</label>
                                                                    <input type="file" class="form-control registration-modal-details" id="degree-{{ $job->job_id }}" name="degree" accept=".pdf,.doc,.docx">
                                                                    <span class="text-danger error-degree"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="id_doc-{{ $job->job_id }}">Upload ID Document</label>
                                                                    <input type="file" class="form-control registration-modal-details" id="id_doc-{{ $job->job_id }}" name="id_doc" accept=".pdf,.jpg,.jpeg,.png">
                                                                    <span class="text-danger error-id_doc"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary mt-3">Submit Application</button>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="tab-part-time" class="tab-pane fade p-0">
                            <div class="job-grid">
                                @foreach ($jobs->where('job_type', 'part_time') as $job)
                                    <div class="job-item p-4 mb-4">
                                        <div class="row g-4">
                                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                                <img class="flex-shrink-0 img-fluid border rounded" src="{{ $job->company->logo ? asset('storage/' . $job->company->logo) : asset('img/default-logo.png') }}" alt="{{ $job->company->name }}" style="width: 80px; height: 80px;">
                                                <div class="text-start ps-4">
                                                    <h5 class="mb-3">{{ $job->title }}</h5>
                                                    <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $job->location }}</p>
                                                    <p><i class="fa fa-building text-primary me-2"></i>{{ $job->company->name }}</p>
                                                    <p><i class="fa fa-clock text-primary me-2"></i>{{ $job->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                                <div class="d-flex mb-3">
                                                    <a class="btn btn-light btn-square me-3" href="{{ route('jobs.show', $job->job_id) }}"><i class="far fa-heart text-primary"></i></a>
                                                    <button class="btn btn-primary" id="apply-btn-{{ $job->job_id }}" data-bs-toggle="modal" data-bs-target="#registerModal-{{ $job->job_id }}" data-job-title="{{ $job->title }}">Apply Now</button>
                                                </div>
                                                <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Deadline: {{ $job->deadline }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="registerModal-{{ $job->job_id }}" tabindex="-1" aria-labelledby="registerModalLabel-{{ $job->job_id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="registerModalLabel-{{ $job->job_id }}">Apply for {{ $job->title }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h3 class="job-title-highlight">{{ $job->title }} at {{ $job->company->name }}</h3>
                                                    <div id="register-success-message-{{ $job->job_id }}" class="alert alert-success d-none" role="alert"></div>
                                                    <div id="register-error-message-{{ $job->job_id }}" class="alert alert-danger d-none" role="alert"></div>
                                                    <form id="apply-form-{{ $job->job_id }}" action="{{ route('applicables.store') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="job_id" value="{{ $job->job_id }}">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="names-{{ $job->job_id }}">Full Name</label>
                                                                    <input type="text" class="form-control registration-modal-details" id="names-{{ $job->job_id }}" name="names" required>
                                                                    <span class="text-danger error-names"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="phone-{{ $job->job_id }}">Phone Number</label>
                                                                    <input type="text" class="form-control registration-modal-details" id="phone-{{ $job->job_id }}" name="phone" required pattern="^(?:\+250|07)\d{8}$" title="Phone must start with +250 or 07 followed by 8 digits">
                                                                    <span class="text-danger error-phone"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="email-{{ $job->job_id }}">Email</label>
                                                                    <input type="email" class="form-control registration-modal-details" id="email-{{ $job->job_id }}" name="email" required>
                                                                    <span class="text-danger error-email" id="emailFeedback-{{ $job->job_id }}"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="id_number-{{ $job->job_id }}">ID Number</label>
                                                                    <input type="text" class="form-control registration-modal-details" id="id_number-{{ $job->job_id }}" name="id_number" required pattern="\d{16}" title="Must be 16 digits">
                                                                    <span class="text-danger error-id_number"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="department_id-{{ $job->job_id }}">Department</label>
                                                                    <select class="form-control registration-modal-details" id="department_id-{{ $job->job_id }}" name="department_id" required>
                                                                        <option value="">Select Department</option>
                                                                        @foreach ($departments as $department)
                                                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="text-danger error-department_id"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="province_id-{{ $job->job_id }}">Province</label>
                                                                    <select class="form-control registration-modal-details" id="province_id-{{ $job->job_id }}" name="province_id" required>
                                                                        <option value="">Select Province</option>
                                                                        @foreach ($provinces as $province)
                                                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="text-danger error-province_id"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="district_id-{{ $job->job_id }}">District</label>
                                                                    <select class="form-control registration-modal-details" id="district_id-{{ $job->job_id }}" name="district_id" required>
                                                                        <option value="">Select District</option>
                                                                    </select>
                                                                    <span class="text-danger error-district_id"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="sector_id-{{ $job->job_id }}">Sector</label>
                                                                    <select class="form-control registration-modal-details" id="sector_id-{{ $job->job_id }}" name="sector_id" required>
                                                                        <option value="">Select Sector</option>
                                                                    </select>
                                                                    <span class="text-danger error-sector_id"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="cv-{{ $job->job_id }}">Upload CV</label>
                                                                    <input type="file" class="form-control registration-modal-details" id="cv-{{ $job->job_id }}" name="cv" accept=".pdf,.doc,.docx">
                                                                    <span class="text-danger error-cv"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="degree-{{ $job->job_id }}">Upload Degree</label>
                                                                    <input type="file" class="form-control registration-modal-details" id="degree-{{ $job->job_id }}" name="degree" accept=".pdf,.doc,.docx">
                                                                    <span class="text-danger error-degree"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="id_doc-{{ $job->job_id }}">Upload ID Document</label>
                                                                    <input type="file" class="form-control registration-modal-details" id="id_doc-{{ $job->job_id }}" name="id_doc" accept=".pdf,.jpg,.jpeg,.png">
                                                                    <span class="text-danger error-id_doc"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary mt-3">Submit Application</button>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="tab-freelance" class="tab-pane fade p-0">
                            <div class="job-grid">
                                @foreach ($jobs->where('job_type', 'freelance') as $job)
                                    <div class="job-item p-4 mb-4">
                                        <div class="row g-4">
                                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                                <img class="flex-shrink-0 img-fluid border rounded" src="{{ $job->company->logo ? asset('storage/' . $job->company->logo) : asset('img/default-logo.png') }}" alt="{{ $job->company->name }}" style="width: 80px; height: 80px;">
                                                <div class="text-start ps-4">
                                                    <h5 class="mb-3">{{ $job->title }}</h5>
                                                    <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $job->location }}</p>
                                                    <p><i class="fa fa-building text-primary me-2"></i>{{ $job->company->name }}</p>
                                                    <p><i class="fa fa-clock text-primary me-2"></i>{{ $job->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-4 d-flex flex-column alignið
items-start align-items-md-end justify-content-center">
                                                <div class="d-flex mb-3">
                                                    <a class="btn btn-light btn-square me-3" href="{{ route('jobs.show', $job->job_id) }}"><i class="far fa-heart text-primary"></i></a>
                                                    <button class="btn btn-primary" id="apply-btn-{{ $job->job_id }}" data-bs-toggle="modal" data-bs-target="#registerModal-{{ $job->job_id }}" data-job-title="{{ $job->title }}">Apply Now</button>
                                                </div>
                                                <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Deadline: {{ $job->deadline }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="registerModal-{{ $job->job_id }}" tabindex="-1" aria-labelledby="registerModalLabel-{{ $job->job_id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="registerModalLabel-{{ $job->job_id }}">Apply for {{ $job->title }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h3 class="job-title-highlight">{{ $job->title }} at {{ $job->company->name }}</h3>
                                                    <div id="register-success-message-{{ $job->job_id }}" class="alert alert-success d-none" role="alert"></div>
                                                    <div id="register-error-message-{{ $job->job_id }}" class="alert alert-danger d-none" role="alert"></div>
                                                    <form id="apply-form-{{ $job->job_id }}" action="{{ route('applicables.store') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="job_id" value="{{ $job->job_id }}">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="names-{{ $job->job_id }}">Full Name</label>
                                                                    <input type="text" class="form-control registration-modal-details" id="names-{{ $job->job_id }}" name="names" required>
                                                                    <span class="text-danger error-names"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="phone-{{ $job->job_id }}">Phone Number</label>
                                                                    <input type="text" class="form-control registration-modal-details" id="phone-{{ $job->job_id }}" name="phone" required pattern="^(?:\+250|07)\d{8}$" title="Phone must start with +250 or 07 followed by 8 digits">
                                                                    <span class="text-danger error-phone"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="email-{{ $job->job_id }}">Email</label>
                                                                    <input type="email" class="form-control registration-modal-details" id="email-{{ $job->job_id }}" name="email" required>
                                                                    <span class="text-danger error-email" id="emailFeedback-{{ $job->job_id }}"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="id_number-{{ $job->job_id }}">ID Number</label>
                                                                    <input type="text" class="form-control registration-modal-details" id="id_number-{{ $job->job_id }}" name="id_number" required pattern="\d{16}" title="Must be 16 digits">
                                                                    <span class="text-danger error-id_number"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="department_id-{{ $job->job_id }}">Department</label>
                                                                    <select class="form-control registration-modal-details" id="department_id-{{ $job->job_id }}" name="department_id" required>
                                                                        <option value="">Select Department</option>
                                                                        @foreach ($departments as $department)
                                                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="text-danger error-department_id"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="province_id-{{ $job->job_id }}">Province</label>
                                                                    <select class="form-control registration-modal-details" id="province_id-{{ $job->job_id }}" name="province_id" required>
                                                                        <option value="">Select Province</option>
                                                                        @foreach ($provinces as $province)
                                                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="text-danger error-province_id"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="district_id-{{ $job->job_id }}">District</label>
                                                                    <select class="form-control registration-modal-details" id="district_id-{{ $job->job_id }}" name="district_id" required>
                                                                        <option value="">Select District</option>
                                                                    </select>
                                                                    <span class="text-danger error-district_id"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="sector_id-{{ $job->job_id }}">Sector</label>
                                                                    <select class="form-control registration-modal-details" id="sector_id-{{ $job->job_id }}" name="sector_id" required>
                                                                        <option value="">Select Sector</option>
                                                                    </select>
                                                                    <span class="text-danger error-sector_id"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="cv-{{ $job->job_id }}">Upload CV</label>
                                                                    <input type="file" class="form-control registration-modal-details" id="cv-{{ $job->job_id }}" name="cv" accept=".pdf,.doc,.docx">
                                                                    <span class="text-danger error-cv"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="degree-{{ $job->job_id }}">Upload Degree</label>
                                                                    <input type="file" class="form-control registration-modal-details" id="degree-{{ $job->job_id }}" name="degree" accept=".pdf,.doc,.docx">
                                                                    <span class="text-danger error-degree"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="id_doc-{{ $job->job_id }}">Upload ID Document</label>
                                                                    <input type="file" class="form-control registration-modal-details" id="id_doc-{{ $job->job_id }}" name="id_doc" accept=".pdf,.jpg,.jpeg,.png">
                                                                    <span class="text-danger error-id_doc"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary mt-3">Submit Application</button>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="tab-internship" class="tab-pane fade p-0">
                            <div class="job-grid">
                                @foreach ($jobs->where('job_type', 'internship') as $job)
                                    <div class="job-item p-4 mb-4">
                                        <div class="row g-4">
                                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                                <img class="flex-shrink-0 img-fluid border rounded" src="{{ $job->company->logo ? asset('storage/' . $job->company->logo) : asset('img/default-logo.png') }}" alt="{{ $job->company->name }}" style="width: 80px; height: 80px;">
                                                <div class="text-start ps-4">
                                                    <h5 class="mb-3">{{ $job->title }}</h5>
                                                    <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $job->location }}</p>
                                                    <p><i class="fa fa-building text-primary me-2"></i>{{ $job->company->name }}</p>
                                                    <p><i class="fa fa-clock text-primary me-2"></i>{{ $job->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                                <div class="d-flex mb-3">
                                                    <a class="btn btn-light btn-square me-3" href="{{ route('jobs.show', $job->job_id) }}"><i class="far fa-heart text-primary"></i></a>
                                                    <button class="btn btn-primary" id="apply-btn-{{ $job->job_id }}" data-bs-toggle="modal" data-bs-target="#registerModal-{{ $job->job_id }}" data-job-title="{{ $job->title }}">Apply Now</button>
                                                </div>
                                                <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Deadline: {{ $job->deadline }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="registerModal-{{ $job->job_id }}" tabindex="-1" aria-labelledby="registerModalLabel-{{ $job->job_id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="registerModalLabel-{{ $job->job_id }}">Apply for {{ $job->title }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h3 class="job-title-highlight">{{ $job->title }} at {{ $job->company->name }}</h3>
                                                    <div id="register-success-message-{{ $job->job_id }}" class="alert alert-success d-none" role="alert"></div>
                                                    <div id="register-error-message-{{ $job->job_id }}" class="alert alert-danger d-none" role="alert"></div>
                                                    <form id="apply-form-{{ $job->job_id }}" action="{{ route('applicables.store') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="job_id" value="{{ $job->job_id }}">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="names-{{ $job->job_id }}">Full Name</label>
                                                                    <input type="text" class="form-control registration-modal-details" id="names-{{ $job->job_id }}" name="names" required>
                                                                    <span class="text-danger error-names"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="phone-{{ $job->job_id }}">Phone Number</label>
                                                                    <input type="text" class="form-control registration-modal-details" id="phone-{{ $job->job_id }}" name="phone" required pattern="^(?:\+250|07)\d{8}$" title="Phone must start with +250 or 07 followed by 8 digits">
                                                                    <span class="text-danger error-phone"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="email-{{ $job->job_id }}">Email</label>
                                                                    <input type="email" class="form-control registration-modal-details" id="email-{{ $job->job_id }}" name="email" required>
                                                                    <span class="text-danger error-email" id="emailFeedback-{{ $job->job_id }}"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="id_number-{{ $job->job_id }}">ID Number</label>
                                                                    <input type="text" class="form-control registration-modal-details" id="id_number-{{ $job->job_id }}" name="id_number" required pattern="\d{16}" title="Must be 16 digits">
                                                                    <span class="text-danger error-id_number"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="department_id-{{ $job->job_id }}">Department</label>
                                                                    <select class="form-control registration-modal-details" id="department_id-{{ $job->job_id }}" name="department_id" required>
                                                                        <option value="">Select Department</option>
                                                                        @foreach ($departments as $department)
                                                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="text-danger error-department_id"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="province_id-{{ $job->job_id }}">Province</label>
                                                                    <select class="form-control registration-modal-details" id="province_id-{{ $job->job_id }}" name="province_id" required>
                                                                        <option value="">Select Province</option>
                                                                        @foreach ($provinces as $province)
                                                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="text-danger error-province_id"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="district_id-{{ $job->job_id }}">District</label>
                                                                    <select class="form-control registration-modal-details" id="district_id-{{ $job->job_id }}" name="district_id" required>
                                                                        <option value="">Select District</option>
                                                                    </select>
                                                                    <span class="text-danger error-district_id"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="sector_id-{{ $job->job_id }}">Sector</label>
                                                                    <select class="form-control registration-modal-details" id="sector_id-{{ $job->job_id }}" name="sector_id" required>
                                                                        <option value="">Select Sector</option>
                                                                    </select>
                                                                    <span class="text-danger error-sector_id"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="cv-{{ $job->job_id }}">Upload CV</label>
                                                                    <input type="file" class="form-control registration-modal-details" id="cv-{{ $job->job_id }}" name="cv" accept=".pdf,.doc,.docx">
                                                                    <span class="text-danger error-cv"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="degree-{{ $job->job_id }}">Upload Degree</label>
                                                                    <input type="file" class="form-control registration-modal-details" id="degree-{{ $job->job_id }}" name="degree" accept=".pdf,.doc,.docx">
                                                                    <span class="text-danger error-degree"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="id_doc-{{ $job->job_id }}">Upload ID Document</label>
                                                                    <input type="file" class="form-control registration-modal-details" id="id_doc-{{ $job->job_id }}" name="id_doc" accept=".pdf,.jpg,.jpeg,.png">
                                                                    <span class="text-danger error-id_doc"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary mt-3">Submit Application</button>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-xxl py-5">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Why Choose Us</h1>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="feature-item text-center border rounded p-4">
                            <i class="fa fa-briefcase fa-3x text-primary mb-4"></i>
                            <h5 class="mb-3">Wide Range of Jobs</h5>
                            <p>Explore diverse job opportunities across industries.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="feature-item text-center border rounded p-4">
                            <i class="fa fa-users fa-3x text-primary mb-4"></i>
                            <h5 class="mb-3">Trusted Employers</h5>
                            <p>Connect with verified and reputable companies.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="feature-item text-center border rounded p-4">
                            <i class="fa fa-rocket fa-3x text-primary mb-4"></i>
                            <h5 class="mb-3">Fast Application</h5>
                            <p>Apply to jobs quickly with our streamlined process.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid contact-section bg-light" id="contact">
            <div class="container py-5">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Contact Us</h1>
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
                                        <button type="submit" class="btn btn-primary">Send Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="map-container">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.019788424739!2d-122.41941568468134!3d37.77492977975947!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8085808f3c7b3d2d%3A0x4b1c7b7b7b7b7b7b!2sSan%20Francisco%2C%20CA!5e0!3m2!1sen!2sus!4v1631234567890!5m2!1sen!2sus" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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
                        <p class="mb-4">Your trusted platform for finding the best job opportunities and connecting with top employers.</p>
                        <p><i class="fa fa-map-marker-alt me-3"></i>123 Street, Kigali, Rwanda</p>
                        <p><i class="fa fa-phone-alt me-3"></i>+250 788 123 456</p>
                        <p><i class="fa fa-envelope me-3"></i>info@jobsmart.com</p>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h5 class="text-white mb-4">Quick Links</h5>
                        <a class="btn btn-link" href="{{ route('welcome') }}">Home</a>
                        <a class="btn btn-link" href="#about">About</a>
                        <a class="btn btn-link" href="{{ route('jobs.index') }}">Jobs</a>
                        <a class="btn btn-link" href="#contact">Contact</a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h5 class="text-white mb-4">Follow Us</h5>
                        <div class="d-flex">
                            <a class="btn btn-square btn-primary me-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square btn-primary me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-primary me-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-square btn-primary" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            © <a class="border-bottom" href="#">JobSmart</a>, All Rights Reserved.
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            Designed By <a class="border-bottom" href="#">SmartDev</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title" id="successModalLabel">Application Success</h5>
                    <p id="successMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                autoplayTimeout: 5000,
                responsive: {
                    0: { items: 1 },
                    600: { items: 1 },
                    1000: { items: 1 }
                }
            });

            $("#spinner").removeClass("show");

            @foreach ($jobs as $job)
                $('#apply-btn-{{ $job->job_id }}').on('click', function() {
                    var jobTitle = $(this).data('job-title') || "{{ $job->title }}";
                    $('#registerModal-{{ $job->job_id }}').modal({
                        backdrop: 'static',
                        keyboard: false
                    }).on('show.bs.modal', function() {
                        $(this).find('.modal-dialog').css('opacity', '0').animate({ opacity: 1 }, 300);
                        $(this).find('.job-title-highlight').text(jobTitle + ' at {{ $job->company->name }}');
                    });
                });

                $('#province_id-{{ $job->job_id }}').change(function() {
                    var provinceId = $(this).val();
                    var districtSelect = $('#district_id-{{ $job->job_id }}');
                    var sectorSelect = $('#sector_id-{{ $job->job_id }}');
                    districtSelect.empty().append('<option value="">Select District</option>');
                    sectorSelect.empty().append('<option value="">Select Sector</option>');
                    if (provinceId) {
                        $.get('/api/districts/' + provinceId, function(data) {
                            $.each(data, function(index, district) {
                                districtSelect.append($('<option>', {
                                    value: district.id,
                                    text: district.name
                                }));
                            });
                        });
                    }
                });

                $('#district_id-{{ $job->job_id }}').change(function() {
                    var districtId = $(this).val();
                    var sectorSelect = $('#sector_id-{{ $job->job_id }}');
                    sectorSelect.empty().append('<option value="">Select Sector</option>');
                    if (districtId) {
                        $.get('/api/sectors/' + districtId, function(data) {
                            $.each(data, function(index, sector) {
                                sectorSelect.append($('<option>', {
                                    value: sector.id,
                                    text: sector.name
                                }));
                            });
                        });
                    }
                });

                $('#apply-form-{{ $job->job_id }}').on('submit', function(e) {
                    e.preventDefault();
                    $('.error').text('');
                    $('#register-success-message-{{ $job->job_id }}, #register-error-message-{{ $job->job_id }}').addClass('d-none');

                    var formData = new FormData(this);
                    var jobTitle = $('#apply-btn-{{ $job->job_id }}').data('job-title') || "{{ $job->title }}";

                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        beforeSend: function() {
                            $(this).find('button[type="submit"]').prop('disabled', true).text('Submitting...');
                        },
                        complete: function() {
                            $(this).find('button[type="submit"]').prop('disabled', false).text('Submit Application');
                        },
                        success: function(response) {
                            $('#registerModal-{{ $job->job_id }}').modal('hide');
                            $('#successMessage').text(`Thank you for applying to ${jobTitle}! We will contact you soon as possible.`);
                            $('#successModal').modal('show');
                            setTimeout(function() {
                                $('#successModal').modal('hide');
                            }, 5000);
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;
                                if (errors && errors['job_id'] && errors['job_id'].includes('already applied')) {
                                    $('#register-error-message-{{ $job->job_id }}').removeClass('d-none').text('You have already applied for this job.');
                                } else {
                                    $.each(errors, function(key, value) {
                                        $('.error-' + key).text(value[0]);
                                    });
                                }
                            } else {
                                $('#register-error-message-{{ $job->job_id }}').removeClass('d-none').text('An error occurred: ' + xhr.responseText);
                            }
                        }
                    });
                });
            @endforeach

            new WOW().init();
        });
    </script>
</body>
</html>