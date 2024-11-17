<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>GRANADA's DRUGS</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        

        

  <!-- Favicons -->
  <link href="assets/img/drug.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Medilab
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">luisenrico.granada.cics@ust.edu.ph</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+02 7576 1371</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

    <div class="container position-relative d-flex align-items-center justify-content-between">
      <img src="assets/img/drug.png" alt="logo" width="60" height="75" >
      <a href="index.html" class="logo align-items-center me-auto">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          
          <h1 class="sitename">GRANADA's DRUGS</h1>
        </a>
        

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="http://127.0.0.1:8000/">Home<br></a></li>
            <li><a href="http://127.0.0.1:8000/about"   class="active">About</a></li>
            <li><a href="http://127.0.0.1:8000/medicines">Medicines</a></li>
            <li><a href="http://127.0.0.1:8000/doctors">Doctors</a></li>
            <li class="dropdown"><a href="http://127.0.0.1:8000/services"><span>Services</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="http://127.0.0.1:8000/padala">Gamot Padala</a></li>
                <li><a href="http://127.0.0.1:8000/appointment">Book a Consultation</a></li>
                <li><a href="http://127.0.0.1:8000/inquiry">Medicine Inquiry</a></li>
              </ul>
            </li>
            <li><a href="http://127.0.0.1:8000/contact">Contact</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        @if (Route::has('login'))
                            <nav>
                                @auth
                                @livewire('navigation-menu')

                                @else
                                <a class="cta-btn d-none d-sm-block" href="http://127.0.0.1:8000/login">SIGN IN/SIGN UP</a>
                                @endauth
                            </nav>
                        @endif
        

      </div>

    </div>
    

            

  </header>

  <main class="main">

  <style>
/* Global Styles */

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f9f9f9;
}

/* Logo Styles */

.logo {
  display: block;
  margin: 20px auto;
  text-align: center;
}

.logo img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  object-fit: cover;
}

/* Form Styles */
label {
  display: block;
  margin-bottom: 10px;
  font-weight: bold;
  color: #333;
}

input[type="email"],
input[type="password"] {
  width: 100%;
  height: 40px;
  margin-bottom: 20px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

input[type="email"]:focus,
input[type="password"]:focus {
  border-color: #aaa;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.checkbox {
  margin-right: 10px;
}

.checkbox label {
  font-weight: normal;
}

/* Button Styles */

button[type="submit"] {
  background-color: #2074cc;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  weight: bold;
}

button[type="submit"]:hover {
  background-color: #3e8e41;
}
    </style>

<!-- Testimonials Section -->
<section id="testimonials" class="testimonials section">

<div class="container">

  <div class="row align-items-center">

    <div class="col-lg-5 info" data-aos="fade-up" data-aos-delay="100">
    <h3>Gamot Padala</h3>
<p>
  Enjoy the convenience and reliability of our Gamot Padala service. We ensure your medications are securely packaged and delivered promptly to your doorstep, providing peace of mind and enhancing your healthcare experience.
</p>

    </div>

    <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">

      <div class="swiper init-swiper">
        <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": "auto",
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            }
          }
        </script>
        <div class="swiper-wrapper">

        <div class="swiper-slide">
  <div class="testimonial-item">
    <div class="d-flex">
      <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img flex-shrink-0" alt="">
      <div>
        <h3>Saul Goodman</h3>
        <h4>CEO &amp; Founder</h4>
        <div class="stars">
          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
        </div>
      </div>
    </div>
    <p>
      <i class="bi bi-quote quote-icon-left"></i>
      <span>The Gamot Padala service is exceptional! My medications arrived quickly and were securely packaged. I’m incredibly impressed with the reliability and convenience.</span>
      <i class="bi bi-quote quote-icon-right"></i>
    </p>
  </div>
</div><!-- End testimonial item -->

<div class="swiper-slide">
  <div class="testimonial-item">
    <div class="d-flex">
      <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img flex-shrink-0" alt="">
      <div>
        <h3>Sara Wilsson</h3>
        <h4>Designer</h4>
        <div class="stars">
          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
        </div>
      </div>
    </div>
    <p>
      <i class="bi bi-quote quote-icon-left"></i>
      <span>Using Gamot Padala was a lifesaver! The process was simple, and the delivery was fast. I highly recommend it for anyone who needs their medicines delivered right to their door.</span>
      <i class="bi bi-quote quote-icon-right"></i>
    </p>
  </div>
</div><!-- End testimonial item -->

<div class="swiper-slide">
  <div class="testimonial-item">
    <div class="d-flex">
      <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img flex-shrink-0" alt="">
      <div>
        <h3>Jena Karlis</h3>
        <h4>Store Owner</h4>
        <div class="stars">
          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
        </div>
      </div>
    </div>
    <p>
      <i class="bi bi-quote quote-icon-left"></i>
      <span>Gamot Padala made it so easy to get the medicine I needed for my family. The delivery was prompt, and the service was top-notch. I’ll definitely use it again!</span>
      <i class="bi bi-quote quote-icon-right"></i>
    </p>
  </div>
</div><!-- End testimonial item -->

<div class="swiper-slide">
  <div class="testimonial-item">
    <div class="d-flex">
      <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img flex-shrink-0" alt="">
      <div>
        <h3>Matt Brandon</h3>
        <h4>Freelancer</h4>
        <div class="stars">
          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
        </div>
      </div>
    </div>
    <p>
      <i class="bi bi-quote quote-icon-left"></i>
      <span>I was very pleased with the Gamot Padala service. The delivery was fast, and the customer service was excellent. It’s a convenient option for anyone needing timely access to their medications.</span>
      <i class="bi bi-quote quote-icon-right"></i>
    </p>
  </div>
</div><!-- End testimonial item -->

<div class="swiper-slide">
  <div class="testimonial-item">
    <div class="d-flex">
      <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img flex-shrink-0" alt="">
      <div>
        <h3>John Larson</h3>
        <h4>Entrepreneur</h4>
        <div class="stars">
          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
        </div>
      </div>
    </div>
    <p>
      <i class="bi bi-quote quote-icon-left"></i>
      <span>The ease of using Gamot Padala is unbeatable. My prescription was delivered on time, and the whole experience was hassle-free. Highly recommend it!</span>
      <i class="bi bi-quote quote-icon-right"></i>
    </p>
  </div>
</div><!-- End testimonial item -->


        </div>
        <div class="swiper-pagination"></div>
      </div>

    </div>

  </div>

</div>

</section><!-- /Testimonials Section -->

<section id="hero" class="hero section light-background">

<img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

  <!-- <img src="assets/img/drug.png" alt="Logo" width="100" height="125" style="display: block; margin: 20px auto; text-align: center;"> -->

<div class="welcome position-relative" data-aos="fade-down" data-aos-delay="100">
<!-- Appointment Section -->

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
<h2>Order Now</h2>
<p>Easily place your order for fast and reliable medicine delivery straight to your door. Your health and convenience are our top priorities.</p>
        </br></br>

<div class="container" data-aos="fade-up" data-aos-delay="100">

  <form action="forms/appointment.php" method="post" role="form" class="php-email-form">
    <div class="row">
      <div>
        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required="">
      </div>
      <div>
        <input type="text" class="form-control" name="email" id="email" placeholder="Your Address" required="">
      </div>
      <div>
        <input type="tel" class="form-control" name="phone" id="phone" placeholder="Your Phone" required="">
      </div>
    </div>
    <div class="row">
    <div>
        <select name="department" id="department" class="form-select" required="">
          <option value="">Choose Medicine</option>
          <option value="Department 1">Biogesic</option>
          <option value="Department 2">Bioflu</option>
          <option value="Department 3">Neozep</option>
        </select>
      </div>
      <div >
        <input type="number" name="number" class="form-control datepicker" id="date" placeholder="Quantity" required="">
      </div>
    
    </div>

    <div class="form-group mt-3">
      <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
    </div>
    <div class="mt-3">
      <div class="loading">Loading</div>
      <div class="error-message"></div>
      <div class="sent-message">Your order is being processed. Thank you!</div>
      <div class="text-center"><button type="submit">Place Order</button></div>
    </div>
  </form>

</div>
      
        </section><!-- /Hero Section -->

  </main>

  <footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Granada's Drugs</span>
          </a>
          <div class="footer-contact pt-3">
            <p>A108 Adam Street</p>
            <p>New York, NY 535022</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+02 7576 1371</span></p>
            
    <p><strong>Email:</strong> <span>contact@granadasdrugs.com</span></p>
  </div>
  <div class="social-links d-flex mt-4">
    <a href="#"><i class="bi bi-twitter"></i></a>
    <a href="#"><i class="bi bi-facebook"></i></a>
    <a href="#"><i class="bi bi-instagram"></i></a>
    <a href="#"><i class="bi bi-linkedin"></i></a>
  </div>
</div>

<div class="col-lg-2 col-md-3 footer-links">
  <h4>Quick Links</h4>
  <ul>
    <li><a href="#">Home</a></li>
    <li><a href="#">About Us</a></li>
    <li><a href="#">Our Services</a></li>
    <li><a href="#">Terms of Service</a></li>
    <li><a href="#">Privacy Policy</a></li>
  </ul>
</div>

<div class="col-lg-2 col-md-3 footer-links">
  <h4>Our Services</h4>
  <ul>
    <li><a href="#">Pharmaceutical Products</a></li>
    <li><a href="#">Consultations</a></li>
    <li><a href="#">Health and Wellness Programs</a></li>
    <li><a href="#">Home Delivery</a></li>
    <li><a href="#">Customer Support</a></li>
  </ul>
</div>

<div class="col-lg-2 col-md-3 footer-links">
  <h4>Customer Care</h4>
  <ul>
    <li><a href="#">FAQs</a></li>
    <li><a href="#">Returns and Exchanges</a></li>
    <li><a href="#">Shipping Information</a></li>
    <li><a href="#">Contact Us</a></li>
    <li><a href="#">Feedback</a></li>
  </ul>
</div>

<div class="col-lg-2 col-md-3 footer-links">
  <h4>Additional Resources</h4>
  <ul>
    <li><a href="#">Health Blog</a></li>
    <li><a href="#">Community Support</a></li>
    <li><a href="#">Product Recalls</a></li>
    <li><a href="#">Pharmacy Locator</a></li>
    <li><a href="#">Wellness Tips</a></li>
  </ul>
</div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Granada's Drugs</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>