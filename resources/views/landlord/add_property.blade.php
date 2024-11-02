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

    <link rel="stylesheet" type="text/css" href="{{ asset('css1/visitu95dashboardu95edit.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/globals.css') }}" />
  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="visitu95dashboardu95edit" />
    <div class="container-center-horizontal">
      <div class="visitu95dashboardu95edit screen">
     
        <div class="navbar-link-container">
            <div class="navbar-link-estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
     <a href="{{ route('landlord.user_home') }}"><div class="navbar-link-place navbar-link montserrat-normal-black-16px">Home</div> </a
      ><a href="{{ route('landlord.user_home') }}"><div class="navbar-link-about navbar-link montserrat-normal-black-16px">About</div> </a
      >  <a href="{{ route('user.properties_list') }}"><div class="navbar-link-properties montserrat-normal-black-16px">Properties</div> </a
        > <a href="{{ route('user.service') }}"> <div class="navbar-link-services montserrat-normal-black-16px">Services</div> </a>
      
      
        <a href="{{ route('landlord.profile') }}"><div class="head_pic">
            @if($profilePicture)
                <img src="{{ asset('storage/' . $profilePicture) }}" alt="User Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
            @else
                <img src="path/to/default/image.png" alt="Default Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
            @endif
        </div>
        
    </a>
   

        </div>


        <div class="flex-col flex">
          <div class="flex-row flex">
            <div class="flex-col-1 flex-col-7">
              <div class="flex-row-1">
                <h1 class="estate-ease_logo lexendzetta-medium-beaver-25px">ADD Property</h1>
                <img class="trash-2" src="{{ asset('img/trash-2.svg') }}" alt="trash-2" />
            </div>
            </div>
          </div>


          @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <form action="{{ route('landlord.store_property') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="form-container">
        <div class="left-side">
            <div class="form-group">
                <label for="st_no">Street Number</label>
                <input type="text" name="st_no" class="name_txtbox form-control" id="st_no" required>
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" class="name_txtbox form-control" id="city" required>
            </div>

            <div class="form-group">
                <label for="state">State</label>
                <input type="text" name="state" class="name_txtbox form-control" id="state" required>
            </div>

            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" name="country" class="name_txtbox form-control" id="country" required>
            </div>

            <div class="form-group">
                <label for="type">Property Type</label>
                <input type="text" name="type" id="type" class="name_txtbox form-control" required>
            </div>

            <div class="form-group">
                <label for="size">Size</label>
                <input type="text" name="size" id="size" class="name_txtbox form-control" required>
            </div>

            <div class="button-column">
            <div class="add-button-container">
        <button type="submit" class="add-property-button">Add Property</button>
    </div>
    <div class="back-button-container">
        <button type="button" onclick="window.history.back();" class="back-button">Go Back</button>
    </div>
   
</div>



        </div>

        <div class="right-side">
        <div class="form-group">
                <label for="amenities">Amenities</label>
                <textarea name="amenities" id="amenities" class="name_txtbox form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="num_of_rooms">Number of Rooms</label>
                <input type="number" name="num_of_rooms" class="name_txtbox form-control" id="num_of_rooms" required>
            </div>

            <div class="form-group">
                <label for="num_of_bathrooms">Number of Bathrooms</label>
                <input type="number" name="num_of_bathrooms" class="name_txtbox form-control" id="num_of_bathrooms" required>
            </div>
            <div class="form-group">
                <label for="rent">Rent</label>
                <input type="number" name="rent" id="rent" class="name_txtbox form-control" required>
            </div>

            <div class="form-group">
                <label for="floor">Floor</label>
                <input type="text" name="floor" id="floor" class="name_txtbox form-control">
            </div>

            <div class="form-group">
                <label for="available_from">Available From</label>
                <input type="date" name="available_from" class="name_txtbox form-control" id="available_from">
            </div>

            <div class="form-group">
    <label for="images">Upload Images</label>
    <input type="file" name="images[]" id="images" multiple class="form-control" accept="image/*">
    <small>You can select multiple images by holding the Ctrl (Cmd on Mac) key while selecting files.</small>
</div>

        </div>
    </div>
</form>

                  
            
           
       
        </div>
      </div>
    </div>
  </body>
</html>
