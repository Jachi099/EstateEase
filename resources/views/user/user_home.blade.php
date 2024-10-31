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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://animaapp.s3.amazonaws.com/launchpad-static/launchpad.js"></script>
  
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/homepageu95loggedu95in.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/globals.css') }}" />
  </head>
  <body style="margin: 0; background: #ffffff">



          <input type="hidden" id="anPageName" name="page" value="homepageu95loggedu95in" />
          <div class="container-center-horizontal">
            <div class="homepageu95loggedu95in screen">
              <div class="navbar-link-container">
                <div class="navbar-link-estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
          <a href="#div_top"><div class="navbar-link-place navbar-link montserrat-normal-black-16px">Home</div> </a
          ><a href="#div_mid"><div class="navbar-link-about navbar-link montserrat-normal-black-16px">About</div> </a
          > <a href="{{ route('user.properties_list') }}">
            <div class="navbar-link-properties montserrat-normal-black-16px">Properties</div>
        </a>
        
             <a href="{{ route('user.service') }}"><div class="navbar-link-services montserrat-normal-black-16px">Services</div> </a>
          
          <a href="{{ route('user.profile') }}">
    <div class="head_pic">
        @if(isset($profilePicture) && $profilePicture)
            <img src="{{ asset('storage/' . $profilePicture) }}" alt="User Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
        @else
            <img src="path/to/default/image.png" alt="Default Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
        @endif
    </div>
</a>




        </div>
        <div class="overlap-group2">
          <img class="all-room-header-1"  src="{{ asset('img/all-room-header-1.png') }}" alt="All-Room-Header 1" />
          <div class="div_mid div_mid-2" id="div_mid"></div>
          <div class="div_pic"></div>
          <p class="manage-your-properties-with-ease">Manage Your Properties with Ease</p>
          <h1 class="title">EstateEase</h1>
          <div class="list-manage-earn lexendzetta-semi-bold-mongoose-30px">List,<br />Manage,<br />Earn</div>
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
          <img class="banner-1" src="{{ asset('img/banner-1.png') }}" alt="Banner 1" />
          <img class="x497656952-1" src="{{ asset('img/497656952-1.png') }}" alt="497656952 1" />
          
        </div>
        <div class="overlap-group">
          <div class="services lexendzetta-bold-mongoose-30px">SERVICES</div>
          <p class="one-stop-solution-fo">One-Stop Solution for All Your Property Needs</p>
          <div class="overlap-group-container">
            <div class="overlap-group3">
                <img class="repairing-1" src="{{ asset('img/repairing-1.png') }}" alt="repairing 1" />
                <div class="plumbing lexendzetta-bold-mongoose-20px">PLUMBING</div>
              <p class="quick-and-reliable-p montserrat-medium-black-14px">
                Quick and reliable plumbing services for leaks, clogged drains, and repairs.
              </p>
            </div>
            <div class="overlap-group-container-item">
                <img class="paint-roller-1" src="{{ asset('img/paint-roller-1.png') }}" alt="paint-roller 1" />
                <div class="painting lexendzetta-bold-mongoose-20px">PAINTING</div>
              <p class="refresh-your-space-w montserrat-medium-black-14px">
                Refresh your space with professional painting services.
              </p>
            </div>
            <div class="overlap-group-container-item">
                <img class="cleaning-1" src="{{ asset('img/cleaning-1.png') }}" alt="cleaning 1" />
                <div class="cleaning lexendzetta-bold-mongoose-20px">CLEANING</div>
              <p class="professional-cleanin montserrat-medium-black-14px">
                Professional cleaning services tailored to your needs.
              </p>
            </div>
            <div class="electric-container">
                <img class="electrician-1-1" src="{{ asset('img/electrician--1--1.png') }}" alt="electrician (1) 1" />
                <div class="electric-repair lexendzetta-bold-mongoose-20px">ELECTRIC REPAIR</div>
              <p class="expert-electrical-se montserrat-medium-black-14px">
                Expert electrical services to fix wiring issues, faulty outlets, or broken appliances.
              </p>
            </div>
          </div>
        </div>
       
      </div>
    </div>
  </body>
</html>
