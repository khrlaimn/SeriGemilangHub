@extends('layouts.homepage')

@section('content')
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">

    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 data-aos="fade-up" class="display-4 font-weight-bold">Seri Gemilang Hub</h1>
                <p data-aos="fade-up" data-aos-delay="400" class="lead">Manage student's attendance and teacher's whereabouts with ease</p>
                <div data-aos="fade-up" data-aos-delay="600">
                    <a href="/login" target="_blank" class="btn btn-primary btn-lg">
                        <span>Get Started</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                <img src="/dist/img/SGHLogoNoBg.png" class="img-fluid" alt="School Logo">
            </div>
        </div>
    </div>

</section>


<!-- ======= Values Section ======= -->
<section id="values" class="values bg-light">
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <p>Discover all functions of Seri Gemilang Hub</p>
        </header>
        <div class="row">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="box">
                    <img src="assets/img/school.png" class="img-fluid" alt="">
                    <h3>Track, and Report Attendance Online!</h3>
                    <p>Setting up students and classes is very easy and you can be off and running in no time at all.</p>
                </div>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
                <div class="box">
                    <img src="assets/img/business-report.png" class="img-fluid" alt="">
                    <h3>Attendance Reporting You'll Love!</h3>
                    <p>You can view in-depth reports by student attendance and export them to Excel.</p>
                </div>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="600">
                <div class="box">
                    <img src="assets/img/megaphone.png" class="img-fluid" alt="">
                    <h3>Communicate Swiftly!</h3>
                    <p>Easily share notices on the notice board, ensuring that all users receive important updates promptly.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ======= About Section ======= -->
<section id="about" class="about">
    <div class="container" data-aos="fade-up">
        <div class="row gx-0">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="content">
                    <h2>About Sekolah Kebangsaan Seri Gemilang</h2>
                    <p>
                        Sekolah Kebangsaan Seri Gemilang (SKSG) is a leading national school dedicated to academic excellence and character development. Established 2009. SKSG offers a holistic education experience tailored to nurture student's talents and potentials. Join us in shaping tomorrow's leaders.
                    </p>
                    <a href="https://www.facebook.com/SKSeriGemilang" target="_blank" class="btn btn-primary">
                        <span>About SKSG</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center justify-content-center" data-aos="zoom-out" data-aos-delay="200">
                <img src="/dist/img/SKSGLogo_NoBg.png" class="img-fluid" alt="SK Seri Gemilang Logo">
            </div>
        </div>
    </div>
</section>


@endsection