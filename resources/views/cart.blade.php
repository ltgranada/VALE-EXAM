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
            <li><a href="http://127.0.0.1:8000/about"   >About</a></li>
            <li><a href="http://127.0.0.1:8000/medicines" >Medicines</a></li>
            <li><a href="http://127.0.0.1:8000/doctors" class="active">Doctors</a></li>
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

<!-- Doctors Section -->
<section id="doctors" class="doctors section">
<h1>Your Cart</h1>
      <table>
        <thead>
          <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="cart-items">
          @php $total = 0; @endphp
          @foreach($cart as $item)
            @php
              $product = App\Models\Product::find($item->product_id);
              $itemTotal = $product->price * $item->quantity;
              $total += $itemTotal;
            @endphp
            <tr data-id="{{ $item->id }}">
              <td>{{ $product->name }}</td>
              <td>{{ $item->quantity }}</td>
              <td>${{ number_format($product->price, 2) }}</td>
              <td>${{ number_format($itemTotal, 2) }}</td>
              <td><button class="btn btn-danger remove-from-cart">Remove</button></td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3">Total</td>
            <td>${{ number_format($total, 2) }}</td>
            <td></td>
          </tr>
        </tfoot>
      </table>
      <a href="{{ route('products.index') }}">Continue Shopping</a>
</section><!-- /Doctors Section -->



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
  <script>
    $(document).ready(function() {
      // Handle remove from cart
      $('.remove-from-cart').click(function() {
        var row = $(this).closest('tr');
        var itemId = row.data('id');

        $.ajax({
          url: '/cart/remove/' + itemId, // Adjust the URL to your route
          type: 'DELETE',
          success: function(response) {
            // Remove the row from the table
            row.remove();
            // Update the total
            updateTotal();
          },
          error: function(xhr) {
            alert('Error removing item from cart');
          }
        });
      });

      function updateTotal() {
        var total = 0;
        $('#cart-items tr').each(function() {
          var itemTotal = parseFloat($(this).find('td:nth-child(4)').text().replace('$', ''));
          total += itemTotal;
        });
        $('#grand-total').text('$' + total.toFixed(2));
      }
    });
  </script>


</body>

</html>


    
