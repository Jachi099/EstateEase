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
        <div class="flex-row-1">
          <div class="location location-2 montserrat-medium-black-16px">LOCATION:</div>
          <div class="sort-2"></div>
          <div class="rent-range rent-1 montserrat-medium-black-16px">RENT RANGE:</div>
          <div class="sort-3"></div>
          <div class="overlap-group2">
            <div class="update_btn update_btn-2">            <div class="filter">FILTER</div>
        </div>
          </div>
        </div>
        <div class="overlap-group1">
           
                @foreach($properties as $property)
                <div class="rented_list_box">

                    <div class="pro_pic">
                        <img src="{{ asset('storage/' . $property->img1) }}" alt="Property Image">
                    </div>
                    <div class="status"> {{ $property->status }} </div>

                <div class="pro_card">
                    
                    <div class="bedroom montserrat-normal-black-12px">BEDROOM:</div>         
                           <div class="number number-3 montserrat-normal-black-12px">       {{ $property->num_of_rooms }}</div>
             
                  <div class="bathroom montserrat-normal-black-12px">BATHROOM:</div> 
                  <div class="number-2 number-3 montserrat-normal-black-12px">        {{ $property->num_of_bathrooms }}</div>
                      
                 <div class="floor montserrat-normal-black-12px">FLOOR:</div> 
                 <div class="number-1 number-3 montserrat-normal-black-12px">    {{ $property->floor }}</div>

                 <div class="location-1 location-2 montserrat-normal-black-12px">LOCATION:</div> 
                 <div class="airport-dhaka montserrat-normal-black-12px"> {{ $property->state }}</div>

                 <div class="rent rent-1 montserrat-normal-black-12px">RENT:  {{ number_format($property->rent, 2) }}</div> 
             
                 <div class="available-from montserrat-normal-black-12px">AVAILABLE FROM:</div> 
                        
                        <div class="date montserrat-normal-black-12px">  {{ \Carbon\Carbon::parse($property->available_from)->format('M d, Y') }}
                        </div>

                    <div class="update_btn-1 update_btn-2">
                        <div class="more-details">MORE DETAILS</div>
                    </div>
            </div>
        </div>
                @endforeach

         
     
      </div>
    </div>
  </body>
</html>
