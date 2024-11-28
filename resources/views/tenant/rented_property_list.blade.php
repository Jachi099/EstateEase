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

    <link rel="stylesheet" type="text/css" href="{{ asset('css1/visitoru95dashboard.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/globals.css') }}" />
   
  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="visitoru95dashboard" />
    <div class="container-center-horizontal">
      <div class="visitoru95dashboard screen">
        <div class="overlap-group-container">
          <div class="overlap-group2">
            <div class="side_div"></div>
<!-- Logout Button -->
<form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: inline;">
    @csrf
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout_btn" style="cursor: pointer;">
        LOGOUT
    </a>
</form>
<a href="{{ route('tenant.profile') }}">
            <div class="profile_btn"></div>
</a>
            
            <a href="{{ route('tenant.rented_properties_list') }}">  <!-- Link to the property list page -->
    <div class="visit_btn">
        <div class="add-property">RENTED PROPERTY LIST</div>  <!-- Updated text -->
    </div>
</a>

<a href="{{ route('tenant.service') }}">
    <div class="help_btn">
        <div class="help-center">SERVICE</div>
    </div>
</a>

   
                <div class="navbar-link-container">
                  <div class="navbar-link-estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
                  <a href="{{ route('tenant.user_home') }}"><div class="navbar-link-place navbar-link montserrat-normal-black-16px">Home</div> </a
            > <a href="{{ route('tenant.user_home') }}"><div class="navbar-link-about navbar-link montserrat-normal-black-16px">About</div> </a
            > <a href="{{ route('tenant.property_list') }}"><div class="navbar-link-properties montserrat-normal-black-16px">Properties</div> </a
            > 
            
            
              <a href="{{ route('tenant.profile') }}"><div class="head_pic">
                  @if($profilePicture)
                      <img src="{{ asset('storage/' . $profilePicture) }}" alt="User Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
                  @else
                      <img src="path/to/default/image.png" alt="Default Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
                  @endif
              </div>
              
          </a>
            <div class="estate-ease_logo-1 estate-ease_logo-4 lexendzetta-extra-bold-white-15px">TENANT DASHBOARD</div>
            <div class="profile montserrat-medium-white-16px">PROFILE</div>
          </div>
          <div class="flex-col">
            <div class="flex-row">
              <h1 class="estate-ease_logo-2 estate-ease_logo-4 lexendzetta-medium-beaver-25px">PROPERTY LISTING</h1>
             

            </div>
          
        <div class="container">
     
        <div class="property-list">

            
    @foreach ($properties as $property)
    <div class="property-card">
        @if ($property->img1)
            <a href="{{ route('tenant.property_details', $property->property_ID) }}" class="property-image-link">
                <img src="{{ asset('storage/' . $property->img1) }}" alt="Property Image" class="property-image">
                <span class="tooltip">More Details</span>
            </a>
        @else
            <a href="{{ route('tenant.property_details', $property->property_ID) }}" class="property-image-link">
                <img src="path/to/default/image.png" alt="Default Property Image" class="property-image">
                <span class="tooltip">More Details</span>
            </a>
        @endif

        <h2 class="property-title">{{ $property->type }}</h2>
        <div class="property-details">
            <div class="detail-item">
                <strong>Rent:</strong> <span>${{ $property->rent }}</span>
            </div>
            <div class="detail-item">
                <strong>Size:</strong> <span>{{ $property->size }} sq ft</span>
            </div>
            <div class="detail-item">
                <strong>Floor:</strong> <span>{{ $property->floor }}</span>
            </div>
            <div class="detail-item">
                <strong>State:</strong> <span>{{ $property->state }}</span>
            </div>
            <div class="detail-item">
                <strong>Status:</strong> <span>Rented since {{ $rentalStartDate }}</span>
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
    </div>
  </body>
</html>
