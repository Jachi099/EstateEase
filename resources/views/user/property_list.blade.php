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
            <a href="homepageu95loggedu95in.html"
              ><div class="navbar-link-place navbar-link montserrat-normal-black-16px">Home</div> </a
            ><a href="homepageu95loggedu95in.html"
              ><div class="navbar-link-about navbar-link montserrat-normal-black-16px">About</div>
            </a>
           
            <a href="{{ route('user.properties_list') }}"><div class="navbar-link-properties navbar-link montserrat-normal-black-16px">Properties</div>
            </a>
                <a href="homepageu95loggedu95in.html"
              ><div class="navbar-link-services navbar-link montserrat-normal-black-16px">Services</div>
            </a>
         
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





          <div class="flex-row flex">
            <h1 class="estate-ease_logo lexendzetta-medium-beaver-25px">PROPERTIES</h1>
            <div class="sort montserrat-medium-black-16px">SORT:</div>
            <div class="sort-1"></div>
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


      <div class="overlap-group1">
    @foreach($properties as $property)
        <div class="rented_list_box">

                <img src="{{ asset('storage/' . $property->img1) }}" alt="Property Image" class="pro_pic">

                            
                <div class="status">{{ $property->status }}</div>
                <div class="bedroom montserrat-normal-black-12px">BEDROOM: {{ $property->num_of_rooms }}</div>
                <div class="bathroom montserrat-normal-black-12px">BATHROOM: {{ $property->num_of_bathrooms }}</div>
                <div class="location-1 location-2 montserrat-normal-black-12px">LOCATION: {{ $property->city }}, {{ $property->state }}</div>
                <div class="rent rent-1 montserrat-normal-black-12px">RENT: {{ number_format($property->rent, 2) }}</div>
                <div class="floor montserrat-normal-black-12px">FLOOR: {{ $property->floor }}</div>
                <div class="available-from montserrat-normal-black-12px">AVAILABLE FROM: {{ \Carbon\Carbon::parse($property->available_from)->format('M d, Y') }}</div>
                <div class="update_btn-1 update_btn-2">
                    <div class="more-details">MORE DETAILS</div>
                </div>
        </div>
    @endforeach
</div>

    </div>
  </body>
</html>
