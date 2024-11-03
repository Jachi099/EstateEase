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
        
        <!-- Filter Form -->
        <form action="{{ route('user.properties.filter') }}" method="GET">
          <div class="flex-row-1">
            <div class="location location-2 montserrat-medium-black-16px">LOCATION: </div>
            <select name="location" id="location" class="sort-2">
              <option value="">All Locations</option>
              <option value="Bashundhara">Bashundhara</option>
              <option value="Badda">Badda</option>
              <option value="Nadda">Nadda</option>
              <option value="Uttara">Uttara</option>
              <option value="Mohammadpur">Mohammadpur</option>
              <option value="Mohakhali">Mohakhali</option>
            </select>

            <div class="rent-range rent-1 montserrat-medium-black-16px">RENT RANGE: </div>
            <select name="rent_range" id="rent_range" class="sort-3">
              <option value="">Select Rent Range</option>
              <option value="1000-5000" {{ request('rent_range') == '1000-5000' ? 'selected' : '' }}>Under Tk.5000</option>
              <option value="5000-20000" {{ request('rent_range') == '5000-20000' ? 'selected' : '' }}>Tk.5000 - Tk.20000</option>
              <option value="20000-30000" {{ request('rent_range') == '20000-30000' ? 'selected' : '' }}>Tk.20000 - Tk.30000</option>
              <option value="30000-40000" {{ request('rent_range') == '30000-40000' ? 'selected' : '' }}>Tk.30000 - Tk.40000</option>
              <option value="40000-100000" {{ request('rent_range') == '40000-100000' ? 'selected' : '' }}>Above Tk.40000</option>
            </select>

            <button type="submit" class="update_btn update_btn-2">FILTER</button>
          </div>
        </form>

      <div class="overlap-group1">

          @foreach($properties as $property)
            <!-- <div class="rented_list_box"> </div> -->
            <div class="property_card">
                <img src="{{ asset('storage/' . $property->img1) }}" alt="Property Image" class="pro_pic">
                <div class="location-1 montserrat-normal-black-12px">LOCATION: {{ $property->city }}</div>
                <div class="floor montserrat-normal-black-12px">FLOOR: {{ $property->floor }}</div>
                <div class="rent-1 montserrat-normal-black-12px">RENT: {{ $property->rent }}</div>
                <div class="available-from montserrat-normal-black-12px">AVAILABLE FROM: {{ $property->available_from }}</div>
                <div class="bedroom montserrat-normal-black-12px">BEDROOM: {{ $property->num_of_rooms }}</div>
                <div class="bathroom montserrat-normal-black-12px">BATHROOM: {{ $property->num_of_bathrooms }}</div>
                <a href="{{ route('property.details', ['id' => $property->property_ID]) }}" class="update_btn-1 update_btn-2">
                    <div class="more-details">MORE DETAILS</div>
                </a> 
            </div>
              
          @endforeach
</div>

    </div>
  </body>
</html>