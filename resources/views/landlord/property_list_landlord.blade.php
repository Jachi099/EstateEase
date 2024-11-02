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

            <div class="profile_btn"></div>
            
            <a href="{{ route('landlord.properties_list') }}">  <!-- Link to the property list page -->
    <div class="visit_btn">
        <div class="add-property">PROPERTY LIST</div>  <!-- Updated text -->
    </div>
</a>


            <a href="help.html"> <div class="help_btn"> <div class="help-center">HELP CENTER</div></div></a
            >
        
   
                <div class="navbar-link-container">
                  <div class="navbar-link-estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
                  <a href="{{ route('landlord.user_home') }}"><div class="navbar-link-place navbar-link montserrat-normal-black-16px">Home</div> </a
            > <a href="{{ route('landlord.user_home') }}"><div class="navbar-link-about navbar-link montserrat-normal-black-16px">About</div> </a
            >  <a href="{{ route('user.properties_list') }}"><div class="navbar-link-properties montserrat-normal-black-16px">Properties</div> </a
              > <a href="{{ route('user.service') }}"><div class="navbar-link-services montserrat-normal-black-16px">Services</div> </a>
            
            
              <a href="{{ route('landlord.profile') }}"><div class="head_pic">
                  @if($profilePicture)
                      <img src="{{ asset('storage/' . $profilePicture) }}" alt="User Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
                  @else
                      <img src="path/to/default/image.png" alt="Default Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
                  @endif
              </div>
              
          </a>
            <div class="estate-ease_logo-1 estate-ease_logo-4 lexendzetta-extra-bold-white-15px">LANDLORD DASHBOARD</div>
            <div class="profile montserrat-medium-white-16px">PROFILE</div>
          </div>
          <div class="flex-col">
            <div class="flex-row">
              <h1 class="estate-ease_logo-2 estate-ease_logo-4 lexendzetta-medium-beaver-25px">LANDLORD DASHBOARD</h1>
              <a href="{{ route('landlord.edit_profile') }}">
                <img class="edit" src="{{ asset('img/edit.svg') }}" alt="edit" />
            </a>
            
            <img class="trash-2" src="{{ asset('img/trash-2.svg') }}" alt="trash-2" />

            </div>
            <div class="flex-row-1">
              <div class="flex-col-1 flex-col-4">
              <div class="container">
        <a href="{{ route('landlord.add_property') }}">
            <div class="add-property-btn">Add Property</div>
        </a>

        <h1>Your Properties</h1>
        <div class="property-list">
            @foreach ($properties as $property)
                <div class="property-card">
                    <img src="{{ asset('storage/' . $property->img1) }}" alt="Property Image" class="property-image">
                    <h2>{{ $property->type }} - {{ $property->city }}</h2>
                    <p>Rent: ${{ $property->rent }}</p>
                    <p>Size: {{ $property->size }} sq ft</p>
                    <p>{{ Str::limit($property->amenities, 100) }}</p>
                    <a href="{{ route('landlord.property_details', $property->property_ID) }}">More Details</a> <!-- Adjust to your route -->
                </div>
            @endforeach
        </div>
    </div>
        </div>
        </div>
      </div>
    </div>
  </body>
</html>
