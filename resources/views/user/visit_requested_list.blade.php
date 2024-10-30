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

    <link rel="stylesheet" type="text/css" href="{{ asset('css1/visitu95property.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/globals.css') }}" />
    
  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="visitu95property" />
    <div class="container-center-horizontal">
      <div class="visitu95property screen">
        <div class="overlap-group-container">
          <div class="overlap-group">
            <div class="side_div"></div>
            <div class="side_div"></div>
            <!-- Logout Button -->
            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: inline;">
                @csrf
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout_btn" style="cursor: pointer;">
                    LOGOUT
                </a>
            </form>
            
                        <div class="profile_btn"></div>
                        <a href="visitu95property.html"> <div class="visit_btn"><div class="visit-requested-properties">VISIT REQUESTED PROPERTIES</div></div></a
                        ><a href="help.html"> <div class="help_btn"> <div class="help-center">HELP CENTER</div></div></a
                        >
                    
            <div class="div_top"></div>
            
            <div class="navbar-link-container">
                <div class="navbar-link-estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
          <a href="#div_top"><div class="navbar-link-place navbar-link montserrat-normal-black-16px">Home</div> </a
          ><a href="#div_mid"><div class="navbar-link-about navbar-link montserrat-normal-black-16px">About</div> </a
          > <div class="navbar-link-properties montserrat-normal-black-16px">Properties</div> </a
            > <a href="{{ route('user.service') }}"><div class="navbar-link-services montserrat-normal-black-16px">Services</div> </a>
          
          
            <a href="{{ route('user.profile') }}"><div class="head_pic">
                @if($profilePicture)
                    <img src="{{ asset('storage/' . $profilePicture) }}" alt="User Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
                @else
                    <img src="path/to/default/image.png" alt="Default Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
                @endif
            </div>
            
            <div class="estate-ease_logo-1 estate-ease_logo-3 lexendzetta-extra-bold-white-15px">VISITOR DASHBOARD</div>
            <a href="help.html"> <div class="logout_btn"></div></a>
            <div class="logout montserrat-medium-white-16px">LOGOUT</div>
          </div>
          <div class="overlap-group1">
            <div class="flex-row">
              <h1 class="estate-ease_logo-2 estate-ease_logo-3 lexendzetta-medium-beaver-25px">
                VISIT REQUESTED PROPERTIES STATUS
              </h1>
              <div class="sort-by montserrat-medium-black-16px">SORT BY</div>
              <div class="sort"></div>
            </div>
            <div class="overlap-group2">
              <div class="pro_card"></div>
              <div class="visit_date"></div>
              <div class="visit-requested-date visit-requested montserrat-normal-black-12px">VISIT REQUESTED DATE:</div>
              <div class="property-address montserrat-normal-black-12px">PROPERTY ADDRESS:</div>
              <div class="pro_pic"></div>
              <div class="pro_add"></div>
              <a href="propertyu95detailsu95afteru95booked.html"> <div class="pro_detail_btn"></div></a>
              <div class="details">DETAILS</div>
              <div class="status"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
