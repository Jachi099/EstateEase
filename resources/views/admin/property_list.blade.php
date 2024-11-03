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

    <link rel="stylesheet" type="text/css" href="{{ asset('css/propertyu95listu95admin.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/globals.css') }}" />

  
  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="propertyu95listu95admin" />
    <div class="container-center-horizontal">
        <div class="propertyu95listu95admin screen">
          <div class="overlap-group1">
            <div class="estate-ease estate lexendzetta-black-mongoose-20px">EstateEase</div>

            
                        {{-- 
            <a href="{{ route('user.profile') }}">
                <div class="head_pic">
                    @if(isset($profilePicture) && $profilePicture)
                        <img src="{{ asset('storage/' . $profilePicture) }}" alt="User Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
                    @else
                        <img src="path/to/default/image.png" alt="Default Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
                    @endif
                </div>
            </a>
            --}}


            <div class="dashb-container">
              <a href="{{ route('admin.dashboard') }}">
                  <div class="link"></div>
              </a>
              <div class="dashboard montserrat-extra-bold-mongoose-20px">Dashboard</div>
          </div>
            <div class="overlap-group6"><div class="profile montserrat-extra-bold-mongoose-20px">Profile</div></div>
            <div class="overlap-group8"><div class="property montserrat-extra-bold-beaver-20px">Property</div></div>
            <div class="overlap-group4"><div class="landlord montserrat-extra-bold-mongoose-20px">Landlord</div></div>
            <div class="tenant-container">
              <a href="visitor.html"> <div class="link"></div></a>
              <div class="tenant-visitor montserrat-extra-bold-mongoose-20px">Tenant &amp; Visitor</div>
            </div>
            <div class="overlap-group5">
              <div class="service service-1 montserrat-extra-bold-mongoose-20px">Service</div>
            </div>
            <div class="overlap-group7">
              <div class="service-1 montserrat-extra-bold-mongoose-20px">Service Provider</div>
            </div>
            <div class="overlap-group10"><div class="feedback montserrat-extra-bold-mongoose-20px">Feedback</div></div>
            <div class="overlap-group12"><div class="log-out montserrat-extra-bold-mongoose-20px">Log out</div></div>


            
          </div>

          <div class="flex-col">
            <div class="flex-row">
              <div class="flex-col-1 flex-col-3">
                <h1 class="estate-ease_logo estate lexendzetta-medium-beaver-25px">PROPERTY LIST</h1>
                <div class="overlap-group3">
                  <div class="add-property add-1">ADD PROPERTY</div>
                  <img class="add add-1" src="img/add@2x.png" alt="Add" />
                </div>
            
                <div class="flex-row-2 montserrat-medium-black-16px">
                    <div class="total-properties">TOTAL PROPERTIES:</div>
                    <div class="total">{{ $properties->count() }}</div>
                    
                    <div class="sort">SORT:</div>
                    <div class="sort-1"></div>
                  </div>


          <!-- Filter Form -->
          <form action="{{ route('properties.filter') }}" method="GET">
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

            <!-- Display Properties -->
            <div class="overlap-group">
                @foreach($properties as $property)
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
      </div>
    </div>
  </body>
</html>