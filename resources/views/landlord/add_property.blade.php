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

    <style>
    /* Style for the error message container */
    .alert {
    color: white;
    font-weight: bolder;
    background-color: #cc4b4b; ;
    border-radius: 5px;
    width: 100%; /* Ensure it spans across the width */
}




</style>
  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="visitu95dashboardu95edit" />
    <div class="container-center-horizontal">
      <div class="visitu95dashboardu95edit screen">

        <div class="navbar-link-container">
            <div class="navbar-link-estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
     <a href="{{ route('landlord.user_home') }}"><div class="navbar-link-place navbar-link montserrat-normal-black-16px">Home</div> </a
      ><a href="{{ route('landlord.user_home') }}"><div class="navbar-link-about navbar-link montserrat-normal-black-16px">About</div> </a
      >

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
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
          <div class="flex-row flex">
            <div class="flex-col-1 flex-col-7">
              <div class="flex-row-1">


                <h1 class="estate-ease_logo lexendzetta-medium-beaver-25px">ADD PROPERTY</h1>
            </div>
            </div>
          </div>

          <form action="{{ route('landlord.store_property') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-container">
        <div class="left-side">
            <div class="form-group">
                <label for="house_no">House No</label>
                <input type="text" name="house_no" class="name_txtbox form-control" id="house_no"
                       placeholder="e.g., KA-50/8C" required>
            </div>

            <div class="form-group">
                <label for="area">Area</label>
                <input type="text" name="area" class="name_txtbox form-control" id="area"
                       placeholder="e.g., Kalachandpur" required>
            </div>

            <div class="form-group">
                <label for="thana">Thana</label>
                <input type="text" name="thana" class="name_txtbox form-control" id="thana"
                       placeholder="e.g., Gulshan" required>
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" class="name_txtbox form-control" id="city"
                       placeholder="e.g., Dhaka" required>
            </div>

            <div class="form-group">
                <label for="postal_code">Postal Code</label>
                <input type="text" name="postal_code" class="name_txtbox form-control" id="postal_code"
                       pattern="\d{4}" title="Please enter a valid 4-digit postal code"
                       placeholder="e.g., 1212" required>
            </div>

            <div class="form-group">
                <label for="type">Property Type</label>
                <select name="type" id="type" class="name_txtbox form-control" required>
                    <option value="" disabled selected>Select Property Type</option>
                    <option value="apartment">Apartment</option>
                    <option value="house">House</option>
                    <option value="duplex">Duplex</option>
                    <option value="condo">Condo</option>
                    <option value="villa">Villa</option>
                    <option value="flat">Flat</option>
                    <option value="office_space">Office Space</option>
                </select>
            </div>

            <div class="form-group">
                <label for="size">Size (in sqft)</label>
                <input type="number" name="size" id="size" class="name_txtbox form-control"
                       placeholder="e.g., 1000" step="0.01" min="0" required>
            </div>

            <div class="form-group">
                <label>Amenities</label><br>
                <small>Select applicable amenities for the property.</small>
            </div>


    <div class="form-group1">

    <div class="checkbox-group">
        <!-- Left Column -->
        <div class="checkbox-column">
            <div>
                <input type="checkbox" name="amenities[]" value="parking" id="parking">
                <label for="parking">Parking</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="lift" id="lift">
                <label for="lift">Lift/Elevator</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="generator_backup" id="generator_backup">
                <label for="generator_backup">Generator Backup</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="security" id="security">
                <label for="security">Security</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="gym" id="gym">
                <label for="gym">Gym/Fitness Center</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="swimming_pool" id="swimming_pool">
                <label for="swimming_pool">Swimming Pool</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="private_pool" id="private_pool">
                <label for="private_pool">Private Pool (for villas)</label>
            </div>
        </div>

        <!-- Right Column -->
        <div class="checkbox-column">
            <div>
                <input type="checkbox" name="amenities[]" value="playground" id="playground">
                <label for="playground">Playground</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="garden" id="garden">
                <label for="garden">Garden/Lawn</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="hot_water" id="hot_water">
                <label for="hot_water">Hot Water</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="gated_community" id="gated_community">
                <label for="gated_community">Gated Community</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="built_in_wardrobes" id="built_in_wardrobes">
                <label for="built_in_wardrobes">Built-in Wardrobes</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="rooftop_access" id="rooftop_access">
                <label for="rooftop_access">Rooftop Access</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="pets_allowed" id="pets_allowed">
                <label for="pets_allowed">Pets Allowed</label>
            </div>

        </div>
    </div>
</div>
        </div>

        <div class="right-side">


            <div class="form-group">
                <label for="num_of_rooms">Number of Bedrooms</label>
                <input type="number" name="num_of_rooms" class="name_txtbox form-control"
                       id="num_of_rooms" placeholder="e.g., 2" required min="0">
            </div>

            <div class="form-group">
                <label for="num_of_bathrooms">Number of Bathrooms</label>
                <input type="number" name="num_of_bathrooms" class="name_txtbox form-control"
                       id="num_of_bathrooms" placeholder="e.g., 2" required min="0">
            </div>

            <div class="form-group">
                <label for="num_of_balcony">Number of Balconies</label>
                <input type="number" name="num_of_balcony" class="name_txtbox form-control"
                       id="num_of_balcony" placeholder="e.g., 2" required min="0">
            </div>

            <div class="form-group">
                <label for="floor">Floor</label>
                <input type="text" name="floor" id="floor" class="name_txtbox form-control"
                       placeholder="e.g., 4">
            </div>

            <div class="form-group">
                <label for="rent">Rent</label>
                <input type="number" name="rent" id="rent" class="name_txtbox form-control"
                       placeholder="e.g., 20000" required min="0">
            </div>
            <div class="form-group">
    <label for="available_from">Available From</label>
    <input type="date" name="available_from" id="available_from" class="name_txtbox form-control"
           placeholder="Select a date" min="{{ \Carbon\Carbon::tomorrow()->toDateString() }}">
</div>

            <div class="form-group">
                <label for="images">Upload Images(Minimum 3)</label>
                <input type="file" name="images[]" id="images" multiple class="form-control"
                       accept="image/*" required>
                <small>You can select multiple images by holding the Ctrl (Cmd on Mac) key while selecting files.</small>
</div>




<div class="button-column">
        <button type="submit" class="add-button-container">Add Property</button>

        <a href="{{ route('landlord.properties_list') }}">
    <div class="back-button-container">
        <button type="button" class="back-button">Go Back</button>
    </div>
</a>

</div>



        </div>
    </div>
</form>





        </div>
      </div>
    </div>

    <script>
   // Function to display error messages at the top in a red container
function showError(message) {
    // Set the error message
    document.getElementById('error-text').innerText = message;

    // Show the error container
    document.getElementById('error-message').style.display = 'block';
}

// Form validation before submission
document.getElementById('property_form').addEventListener('submit', function (e) {
    // Hide error message initially before validation
    document.getElementById('error-message').style.display = 'none';

    // Check for negative numbers in the form fields
    let numOfRooms = document.getElementById('num_of_rooms').value;
    let numOfBathrooms = document.getElementById('num_of_bathrooms').value;
    let numOfBalcony = document.getElementById('num_of_balcony').value;
    let rent = document.getElementById('rent').value;

    if (numOfRooms < 0) {
        showError('Number of rooms cannot be negative.');
        e.preventDefault();
        return;
    }
    if (numOfBathrooms < 0) {
        showError('Number of bathrooms cannot be negative.');
        e.preventDefault();
        return;
    }
    if (numOfBalcony < 0) {
        showError('Number of balconies cannot be negative.');
        e.preventDefault();
        return;
    }
    if (rent < 0) {
        showError('Rent cannot be negative.');
        e.preventDefault();
        return;
    }

    // Check for at least 3 images
    let images = document.getElementsByName('images[]');
    if (images.length < 3) {
        showError('You must upload at least 3 images.');
        e.preventDefault();
        return;
    }
});

</script>



  </body>
</html>
