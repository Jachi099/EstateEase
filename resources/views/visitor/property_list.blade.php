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
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/propertyu95listu95foru95visitor.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/globals.css') }}" />

  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="propertyu95listu95foru95visitor" />
    <div class="container-center-horizontal">
      <div class="propertyu95listu95foru95visitor screen">
        <div class="flex-col flex">
          <div class="navbar">
            <div class="navbar-link-estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
            <a href="{{ route('visitor.user_home') }}"><div class="navbar-link-place navbar-link montserrat-normal-black-16px">Home</div> </a
            > <a href="{{ route('visitor.user_home') }}"><div class="navbar-link-about navbar-link montserrat-normal-black-16px">About</div> </a
            >

            <a href="{{ route('visitor.property_list') }}"><div class="navbar-link-properties navbar-link montserrat-normal-black-16px">Properties</div>
            </a>


            <a href="{{ route('visitor.profile') }}">
                <div class="head_pic">
                    @if(isset($profilePicture) && $profilePicture)
                        <img src="{{ asset('storage/' . $profilePicture) }}" alt="User Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
                    @else
                        <img src="path/to/default/image.png" alt="Default Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
                    @endif
                </div>
            </a>

          </div>





          <div class="flex-row flex">
            <h1 class="estate-ease_logo lexendzetta-medium-beaver-25px">PROPERTIES</h1>
            <div class="sort montserrat-medium-black-16px">SORT:</div>



              <!-- Sort controls on the right -->
        <select id="sort-options" class="sort-1" onchange="sortProperties()">
            <option value="rent_asc">Rent (Low to High)</option>
            <option value="rent_desc">Rent (High to Low)</option>
            <option value="type">Property Type</option>
            <option value="availability">Availability</option>
        </select>


          </div>
        </div>
        <form action="{{ route('properties.filter') }}" method="GET">

        <div class="flex-row-1">
          <div class="location location-2 montserrat-medium-black-16px">LOCATION:</div>

         <select name="location" id="location" class="sort-2">
          <option value="">All Locations</option>
          <!-- Add location options here -->
          <option value="City1">DHAKA</option>
          <option value="City2">CA</option>
      </select>
          <div class="rent-range rent-1 montserrat-medium-black-16px">RENT RANGE:</div>
    <select name="rent_range" class="sort-3">
      <option value="">Select Rent Range</option>
      <option value="0-1000" {{ request('rent_range') == '0-1000' ? 'selected' : '' }}>Under $1000</option>
      <option value="1000-2000" {{ request('rent_range') == '1000-2000' ? 'selected' : '' }}>$1000 - $2000</option>
      <option value="2000-3000" {{ request('rent_range') == '2000-3000' ? 'selected' : '' }}>$2000 - $3000</option>
      <option value="3000-4000" {{ request('rent_range') == '3000-4000' ? 'selected' : '' }}>$3000 - $4000</option>
      <option value="4000-100000" {{ request('rent_range') == '4000-100000' ? 'selected' : '' }}>Above $4000</option>
  </select>


          <div class="overlap-group2">
            <button type="submit" class="update_btn update_btn-2"><div class="filter">FILTER</div></button>
        </div>
          </div>
        </form>



        <div class="container1">


            @foreach ($properties as $property)
            <div class="property-card">

            @php
    $propertyImage = \App\Models\PropertyImage::where('property_ID', $property->property_ID)->first();
@endphp

@if ($propertyImage)
    <!-- Display the first image from PropertyImage model -->
    <a href="{{ route('visitor.details', $property->property_ID) }}" class="property-image-link">
        <img src="{{ asset('storage/' . $propertyImage->image_path) }}" alt="Property Image" class="property-image">
        <span class="tooltip">More Details</span>
    </a>
@else
    <!-- Fallback to default image if no property images exist -->
    <a href="{{ route('visitor.details', $property->property_ID) }}" class="property-image-link">
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
  </body>
</html>
