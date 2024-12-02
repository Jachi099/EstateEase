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
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
    class="logout_btn" style="cursor: pointer;">
        LOGOUT
    </a>
</form>
<a href="{{ route('landlord.profile') }}">
            <div class="profile_btn1">
           PROFILE
            </div>
            </a>

            <a href="{{ route('landlord.properties_list') }}">
                <div class="visit_btn1">
                    <div class="visit-requested-properties1">PROPERTY LIST</div>
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
          </div>
          <div class="flex-col">
            <div class="flex-row">
              <h1 class="estate-ease_logo-2 estate-ease_logo-4 lexendzetta-medium-beaver-25px">PROPERTY LISTING</h1>


            </div>




  <!-- Add Property Button on the left -->
  <a href="{{ route('landlord.add_property') }}">
            <div class="add-property-btn">Add Property</div>
        </a>

  <!-- Sort controls on the right -->
  <div class="sort-container">
    <div class="sort-by montserrat-medium-black-16px">SORT BY</div>
        <select id="sort-options" class="sort" onchange="sortProperties()">
            <option value="rent_asc">Rent (Low to High)</option>
            <option value="rent_desc">Rent (High to Low)</option>
            <option value="type">Property Type</option>
            <option value="availability">Availability</option>
        </select>
</div>


        <div class="container1">


            @foreach ($properties as $property)
            <div class="property-card">

            @php
    $propertyImage = \App\Models\PropertyImage::where('property_ID', $property->property_ID)->first();
@endphp

@if ($propertyImage)
    <!-- Display the first image from PropertyImage model -->
    <a href="{{ route('landlord.property_details', $property->property_ID) }}" class="property-image-link">
        <img src="{{ asset('storage/' . $propertyImage->image_path) }}" alt="Property Image" class="property-image">
        <span class="tooltip">More Details</span>
    </a>
@else
    <!-- Fallback to default image if no property images exist -->
    <a href="{{ route('landlord.property_details', $property->property_ID) }}" class="property-image-link">
        <img src="{{ asset('path/to/default/image.png') }}" alt="Default Property Image" class="property-image">
        <span class="tooltip">More Details</span>
    </a>
@endif


    <div class="property-header1">

    <h2 class="property-title1">{{ strtoupper($property->type) }}</h2>
    @php
        // Get the tenant info for the current property
        $tenant = isset($tenants[$property->property_ID]) ? $tenants[$property->property_ID] : null;
    @endphp

    <div class="tenant-info-item1 normal-text {{ $tenant ? 'tenant-info-rented' : 'tenant-info-available' }}">
        {{ $tenant ? 'Rented' : 'Available' }}
    </div>
</div>



    <div class="property-details1">
    <div class="detail-item1">
        <strong>Rent:</strong> <span>{{ $property->rent }}tk</span>
    </div>

    <div class="detail-item1">
        <strong>Size:</strong> <span>{{ $property->size }} sq ft</span>
    </div>
    <div class="detail-item1">
        <strong>Floor:</strong> <span>{{ $property->floor }}</span>
    </div>
    <div class="detail-item1">
        <strong>Bedrooms:</strong> <span>{{ $property->num_of_rooms }}</span>
    </div>

    <div class="detail-item1">
    <strong>Address:</strong>
    <span>
        {{ $property->house_no }}, {{ $property->area }}, {{ $property->thana }},
        {{ $property->city }} - {{ $property->postal_code }}
    </span>
</div>

    <div class="detail-item1">
        <strong>Available From:</strong> <span>{{ $property->available_from }}</span>
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
