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
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet"> <!-- Montserrat font -->
   

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
<a href="{{ route('landlord.profile') }}">
            <div class="profile_btn"></div>
</a>
            
            <a href="{{ route('landlord.properties_list') }}">  <!-- Link to the property list page -->
    <div class="visit_btn">
        <div class="add-property">PROPERTY LIST</div>  <!-- Updated text -->
    </div>
</a>


<a href="{{ route('landlord.notifications') }}">
    <div class="help_btn">
        <div class="help-center">NOTIFICATIONS</div>
    </div>
</a>

        
   
                <div class="navbar-link-container">
                  <div class="navbar-link-estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
                  <a href="{{ route('landlord.user_home') }}"><div class="navbar-link-place navbar-link montserrat-normal-black-16px">Home</div> </a
            > <a href="{{ route('landlord.user_home') }}"><div class="navbar-link-about navbar-link montserrat-normal-black-16px">About</div> </a
            > 
            
            
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
              <h1 class="estate-ease_logo-2 estate-ease_logo-4 lexendzetta-medium-beaver-25px">PROPERTY LISTING</h1>
              <a href="{{ route('landlord.edit_profile') }}">
                <img class="edit" src="{{ asset('img/edit.svg') }}" alt="edit" />
            </a>
            
            <img class="trash-2" src="{{ asset('img/trash-2.svg') }}" alt="trash-2" />

            </div>
            <div class="property-details-wrapper">
  <div class="property-details-content-wrapper">
    <div class="property-images-wrapper">
      @if ($property->img1)
          <img src="{{ asset('storage/' . $property->img1) }}" alt="Property Image" class="property-image-small">
      @endif
      @if ($property->img2)
          <img src="{{ asset('storage/' . $property->img2) }}" alt="Property Image" class="property-image-small">
      @endif
      @if ($property->img3)
          <img src="{{ asset('storage/' . $property->img3) }}" alt="Property Image" class="property-image-small">
      @endif
    </div>
    <div class="property-details-content">
    <h2 class="normal-text">{{ $property->type }} - {{ $property->city }}</h2>

      <strong>Rent:</strong><div class="normal-text">${{ $property->rent }}</div>
      <strong>Size:</strong><div class="normal-text">{{ $property->size }} sq ft</div>
      <strong>Status:</strong><div class="normal-text">{{ $property->status }}</div>
      <strong>Available From:</strong><div class="normal-text">{{ $property->available_from }}</div>
      <strong>Amenities:</strong><div class="normal-text">{{ $property->amenities }}</div>
      <strong>Rooms:</strong><div class="normal-text">{{ $property->num_of_rooms }}</div>
      <strong>Bathrooms:</strong><div class="normal-text">{{ $property->num_of_bathrooms }}</div>
    </div>

  <div class="tenant-info-wrapper">
    <h2 class="tenant-info-title normal-text">Tenant Information</h2>
    @if ($tenant)
        <div class="tenant-info-item"><strong>Name:</strong> {{ $tenant->full_name }}</div>
        <div class="tenant-info-item"><strong>Rented Since:</strong> {{ $tenant->rented_since }}</div>
    @else
        <div class="tenant-info-item normal-text">Status: Available</div>
    @endif
  </div>
</div>

        </div>
        </div>
      </div>
    </div>
  </body>
</html>
