<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <!--<meta name=description content="This site was generated with Anima. www.animaapp.com"/>-->
    <!-- <link rel="shortcut icon" type=image/png href="https://animaproject.s3.amazonaws.com/home/favicon.png" /> -->
    <meta name="viewport" content="width=1440, maximum-scale=1.0" />
    <link rel="shortcut icon" type="image/png" href="https://animaproject.s3.amazonaws.com/home/favicon.png" />
    <meta name="og:type" content="website" />
    <meta name="twitter:card" content="photo" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css_landlord/homepage.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css_landlord/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css_landlord/globals.css') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://animaapp.s3.amazonaws.com/launchpad-static/launchpad.js"></script>
  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="homepage" />
    <div class="container-center-horizontal">
      <div class="homepage screen">
        <div class="navbar-link-container">
          <div class="navbar-link-estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
          <a href="#div_top">
            <div class="navbar-link-place montserrat-normal-black-16px">Home</div>
        </a>
        <a href="#div_mid">
            <div class="navbar-link-about montserrat-normal-black-16px">About</div>
        </a>
        @auth
            <a href="{{ route('landlord.properties') }}">
                <div class="navbar-link-properties montserrat-normal-black-16px">Properties</div>
            </a>
            <a href="{{ route('landlord.service') }}">
                <div class="navbar-link-services montserrat-normal-black-16px">Services</div>
            </a>
        @endauth
        <a href="{{ route('landlord.signup') }}">
            <div class="navbar-link-sign-up montserrat-normal-black-16px">Sign Up</div>
        </a>
        
        </div>
        <div class="overlap-group">
          <img class="all-room-header-1" src="img/all-room-header-1.png" alt="All-Room-Header 1" />
          <div class="div_mid div_mid-2" id="div_mid"></div>
          <div class="div_pic"></div>
          <a href="{{ route('landlord.signup') }}" > <div class="sign_up_btn sign_up_btn-2"> <span class="sign-up">SIGN UP</span></div></a
          >
          <p class="manage-your-properties-with-ease">Manage Your Properties with Ease</p>
          <h1 class="title">EstateEase</h1>
          <div class="list-manage-earn lexendzetta-semi-bold-mongoose-30px">List,<br />Manage,<br />Earn</div>
          <a href="{{ route('landlord.login') }}" > <div class="sign_up_btn-1 sign_up_btn-2"><span class="login">LOGIN</span></div></a
          > 
          <p class="list-your-property-i montserrat-normal-black-14px">
            List your property in just a few clicks, manage every detail with ease, and start earning from reliable
            tenants.
          </p>
          <div class="div_mid-1 div_mid-2"></div>
          <div class="rent-your-new-home lexendzetta-semi-bold-mongoose-30px">Rent Your New Home</div>
          <p class="find-your-next-home montserrat-normal-black-14px">
            Find Your Next Home, Hassle-Free. Discover a wide range of rental options tailored to your needs, all in one
            place.
          </p>
          <img class="banner-1" src="img/banner-1.png" alt="Banner 1" />
          <img class="x497656952-1" src="img/497656952-1.png" alt="497656952 1" />
        </div>
        <div class="overlap-group1">
          <div class="services lexendzetta-bold-mongoose-30px">SERVICES</div>
          <p class="one-stop-solution-fo">One-Stop Solution for All Your Property Needs</p>
          <div class="overlap-group-container">
            <div class="overlap-group6">
              <img class="repairing-1" src="img/repairing-1.png" alt="repairing 1" />
              <div class="plumbing lexendzetta-bold-mongoose-20px">PLUMBING</div>
              <p class="quick-and-reliable-p montserrat-medium-black-14px">
                Quick and reliable plumbing services for leaks, clogged drains, and repairs.
              </p>
            </div>
            <div class="overlap-group-container-item">
              <img class="paint-roller-1" src="img/paint-roller-1.png" alt="paint-roller 1" />
              <div class="painting lexendzetta-bold-mongoose-20px">PAINTING</div>
              <p class="refresh-your-space-w montserrat-medium-black-14px">
                Refresh your space with professional painting services.
              </p>
            </div>
            <div class="overlap-group-container-item">
              <img class="cleaning-1" src="img/cleaning-1.png" alt="cleaning 1" />
              <div class="cleaning lexendzetta-bold-mongoose-20px">CLEANING</div>
              <p class="professional-cleanin montserrat-medium-black-14px">
                Professional cleaning services tailored to your needs.
              </p>
            </div>
            <div class="electric-container">
              <img class="electrician-1-1" src="img/electrician--1--1.png" alt="electrician (1) 1" />
              <div class="electric-repair lexendzetta-bold-mongoose-20px">ELECTRIC REPAIR</div>
              <p class="expert-electrical-se montserrat-medium-black-14px">
                Expert electrical services to fix wiring issues, faulty outlets, or broken appliances.
              </p>
            </div>
          </div>
        </div>
        {{-- <div class="feedbacks lexendzetta-bold-mongoose-30px">FEEDBACKS</div>
        <div class="rectangle-14"></div> --}}
      </div>
    </div>
  </body>
</html>
