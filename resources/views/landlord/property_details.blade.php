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
    <link rel="stylesheet" type="text/css" href="{{ asset('css_landlord/propertyu95detailsu95landlord.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css_landlord/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css_landlord/globals.css') }}" />
  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="propertyu95detailsu95landlord" />
    <div class="container-center-horizontal">
      <div class="propertyu95detailsu95landlord screen">
        <div class="overlap-group-container">
          <div class="overlap-group">
            <div class="side_div"></div>
            <a href="addu95propertyu95landlord.html">
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
        NOTIFICATIONS
    </div>
</a>


            <div class="div_top"></div>
            <div class="about montserrat-normal-black-16px">Notifications</div>

            <div class="estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
                  <a href="{{ route('landlord.user_home') }}"><div class="place montserrat-normal-black-16px">Home</div> </a
            >

            <a href="{{ route('landlord.profile') }}">
    <div class="head_pic">
        @if($landlordProfilePicture)  <!-- Use the variable for the landlord's picture -->
            <img src="{{ $landlordProfilePicture }}" alt="Landlord Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
        @else
            <img src="{{ asset('path/to/default/image.png') }}" alt="Default Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
        @endif
    </div>
</a>
          <div class="flex-col flex">
            <div class="flex-col-1">
              <h1 class="estate-ease_logo-1 lexendzetta-medium-beaver-25px">PROPERTY DETAILS</h1>
              <div class="navbar montserrat-bold-black-12px">
                <div class="navbar-link-property-id">PROPERTY ID:</div>
                   <!-- Property ID -->
    <div class="pro_id">
        {{ $property->property_ID }}
    </div>
                <div class="navbar-link-rent">RENT:</div>
    <!-- Property Rent -->
    <div class="pro_rent">
        {{ $property->rent }} tk
    </div>
                    <div class="navbar-link-payment-status">PAYMENT STATUS:</div>


                    <div class="overlap-group16 {{ $paymentStatus == 'paid' ? 'paid-status' : 'unpaid-status' }}">
    <div class="pro_detail_btn {{ $paymentStatus == 'paid' ? 'btn-paid' : 'btn-unpaid' }}"></div>
    <div class="unpaid montserrat-normal-white-11px {{ $paymentStatus == 'paid' ? '' : 'unpaid-active' }}">
        UNPAID
    </div>
    <div class="paid montserrat-normal-mongoose-11px {{ $paymentStatus == 'paid' ? 'paid-active' : '' }}">
        PAID
    </div>
</div>





                <div class="navbar-link-rented-date">RENTED DATE:</div>
 <!-- Date Rented -->
 <div class="rented_date">

        @if ($tenant && $tenant->rental_start_date)
            {{ $tenant->rental_start_date }}
        @else
            <span>Not Rented</span>
        @endif
    </div>
    <div class="property-details-page">

</div>

              </div>
            </div>
            <div class="flex-row flex">
              <div class="flex-col-2">
                <div class="overlap-group7">
                  <div class="images montserrat-bold-black-12px">IMAGES (click to view)</div>

                  <div class="overlap-group-container-1">
                  @php
    // Fetch up to 15 images for the property from the PropertyImage model
    $propertyImages = \App\Models\PropertyImage::where('property_ID', $property->property_ID)->limit(15)->get();
@endphp

@if ($propertyImages->isNotEmpty())
    @foreach ($propertyImages as $image)
        <div class="overlap-group1">
            <img src="{{ asset($image->image_path) }}" alt="Property Image" class="pro_pic pro_pic-2">
        </div>
    @endforeach
@else
    <p>No images available for this property.</p>
@endif

</div>


                </div>
                <div class="overlap-group-container-2">
                  <div class="overlap-group4">
                    <div class="x-information montserrat-bold-black-12px">BASIC INFORMATION</div>
                    <div class="flex-row-1 flex-row-3">
                      <div class="flex-col-3 montserrat-normal-black-12px">
                        <div class="bedroom">BEDROOM:</div>
                        <div class="bathroom">BATHROOM:</div>
                        <div class="balcony">BALCONY:</div>
                        <div class="floor-no">FLOOR NO.:</div>
                        <div class="size-sq-ft">SIZE (sq ft).:</div>
                      </div>
                      <div class="flex-col-4">
                      <div class="bed">
    {{ $property->num_of_rooms ?? 'N/A' }}
</div>

<div class="bath">
    {{ $property->num_of_bathrooms ?? 'N/A' }}
</div>

<div class="bal">
    {{ $property->num_of_balcony ?? 'N/A' }}
</div>

<div class="flex-col-item">
    {{ $property->floor ?? 'N/A' }}
</div>

<div class="flex-col-item">
    {{ $property->size ?? 'N/A' }} m²
</div>

                      </div>
                    </div>
                  </div>
                  <div class="overlap-group3">
                    <div class="x-information montserrat-bold-black-12px">LOCATION INFORMATION</div>
                    <div class="flex-row-2 flex-row-3">
                      <div class="flex-col-5 montserrat-normal-black-12px">
                        <div class="division">HOUSE NO.:</div>
                        <div class="district">AREA: </div>
                        <div class="area">THANA:</div>
                        <div class="surname surname-2">CITY:</div>
                        <div class="surname-1 surname-2">SHORT ADDRESS:</div>
                      </div>
                      <div class="flex-col-6">
                      <div class="division-1">
    {{ $property->house_no ?? 'N/A' }}
</div>

<div class="flex-col-item-1 flex-col-item-3">
   {{ $property->area ?? 'N/A' }}
</div>

<div class="flex-col-item-1 flex-col-item-3">
{{ $property->thana ?? 'N/A' }}
</div>

<div class="house_no">
{{ $property->city ?? 'N/A' }}
</div>

<div class="srt_add">
    {{ $property->house_no ? $property->house_no . ', ' : '' }}
    {{ $property->area ? $property->area . ', ' : '' }}
    {{ $property->thana ? $property->thana . ', ' : '' }}
    {{ $property->city ?? 'N/A' }}
    {{ $property->postal_code ? ' - ' . $property->postal_code : '' }} <!-- Postal code part -->
</div>


                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="overlap-group-container-3">
                <div class="overlap-group8">
                  <div class="pro-add-info_card"></div>

                  <div class="div_pro-add-info_card">
    <div class="checkbox-group">
    @php
    $amenities = json_decode($property->amenities) ?? [];
@endphp

<div class="checkbox-column">
    <div>
        <input type="checkbox" name="amenities[]" value="parking" id="parking"
            @if(in_array('parking', $amenities)) checked @endif disabled>
        <label for="parking">Parking</label>
    </div>
    <div>
        <input type="checkbox" name="amenities[]" value="lift" id="lift"
            @if(in_array('lift', $amenities)) checked @endif disabled>
        <label for="lift">Lift/Elevator</label>
    </div>
    <div>
        <input type="checkbox" name="amenities[]" value="generator_backup" id="generator_backup"
            @if(in_array('generator_backup', $amenities)) checked @endif disabled>
        <label for="generator_backup">Generator Backup</label>
    </div>
    <div>
        <input type="checkbox" name="amenities[]" value="security" id="security"
            @if(in_array('security', $amenities)) checked @endif disabled>
        <label for="security">Security</label>
    </div>
    <div>
        <input type="checkbox" name="amenities[]" value="gym" id="gym"
            @if(in_array('gym', $amenities)) checked @endif disabled>
        <label for="gym">Gym</label>
    </div>
</div>

<!-- Second Column -->
<div class="checkbox-column">
    <div>
        <input type="checkbox" name="amenities[]" value="swimming_pool" id="swimming_pool"
            @if(in_array('swimming_pool', $amenities)) checked @endif disabled>
        <label for="swimming_pool">Swimming Pool</label>
    </div>
    <div>
        <input type="checkbox" name="amenities[]" value="private_pool" id="private_pool"
            @if(in_array('private_pool', $amenities)) checked @endif disabled>
        <label for="private_pool">Private Pool (for villas)</label>
    </div>
    <div>
        <input type="checkbox" name="amenities[]" value="playground" id="playground"
            @if(in_array('playground', $amenities)) checked @endif disabled>
        <label for="playground">Playground</label>
    </div>
    <div>
        <input type="checkbox" name="amenities[]" value="garden" id="garden"
            @if(in_array('garden', $amenities)) checked @endif disabled>
        <label for="garden">Garden/Lawn</label>
    </div>
</div>

<!-- Third Column -->
<div class="checkbox-column">
    <div>
        <input type="checkbox" name="amenities[]" value="hot_water" id="hot_water"
            @if(in_array('hot_water', $amenities)) checked @endif disabled>
        <label for="hot_water">Hot Water</label>
    </div>
    <div>
        <input type="checkbox" name="amenities[]" value="gated_community" id="gated_community"
            @if(in_array('gated_community', $amenities)) checked @endif disabled>
        <label for="gated_community">Gated Community</label>
    </div>
    <div>
        <input type="checkbox" name="amenities[]" value="built_in_wardrobes" id="built_in_wardrobes"
            @if(in_array('built_in_wardrobes', $amenities)) checked @endif disabled>
        <label for="built_in_wardrobes">Built-in Wardrobes</label>
    </div>
    <div>
        <input type="checkbox" name="amenities[]" value="rooftop_access" id="rooftop_access"
            @if(in_array('rooftop_access', $amenities)) checked @endif disabled>
        <label for="rooftop_access">Rooftop Access</label>
    </div>
    <div>
        <input type="checkbox" name="amenities[]" value="pets_allowed" id="pets_allowed"
            @if(in_array('pets_allowed', $amenities)) checked @endif disabled>
        <label for="pets_allowed">Pets Allowed</label>
    </div>
</div>

    </div>
</div>

                  <div class="additional-information montserrat-bold-black-12px">ADDITIONAL INFORMATION</div>
                  <img class="line-1" src="img/line-1-2.svg" alt="Line 1" />
                </div>
                <div class="overlap-group2">
                  <div class="tenant-information montserrat-bold-black-12px">TENANT INFORMATION</div>
                  <div class="overlap-group15">
                    <div class="overlap-group10">
          </div>
                    <div class="flex-col-7 montserrat-normal-black-12px">
                      <div class="name">NAME:</div>
                      <div class="email">EMAIL:</div>
                      <div class="permanent-address">PERMANENT ADDRESS:</div>
                    </div>
                    <div class="flex-col-8">
                    <div class="name-1">
    @if($property->tenant)
        <span>{{ $property->tenant->full_name }}</span>
    @else
        <span>No tenant yet</span>
    @endif
</div>

<div class="flex-col-item-2 flex-col-item-3">
    @if($property->tenant)
        <span>{{ $property->tenant->email }}</span>
    @else
        <span>N/A</span>
    @endif
</div>

<div class="per_add">
    @if($property->tenant)
        <span>{{ $property->tenant->current_address }}</span>
    @else
        <span>N/A</span>
    @endif
</div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="overlap-group-container-4">
            <a href="{{ route('landlord.properties_list') }}">
            <div class="overlap-group5"><div class="go-back montserrat-black-beaver-16px">GO BACK</div></div>

</a>
            </div>

<!-- Modal for displaying the zoomed image -->
<div id="imageModal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="zoomedImage" src="" alt="Zoomed Image" class="img-fluid" />
            </div>
        </div>
    </div>
</div>







          </div>
        </div>
      </div>
    </div>



    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all property images
        const images = document.querySelectorAll('.pro_pic-2');

        // Add click event listener to each image
        images.forEach(image => {
            image.addEventListener('click', function() {
                // Get the source of the clicked image
                const imageSrc = this.src;

                // Set the source of the modal's image
                document.getElementById('zoomedImage').src = imageSrc;

                // Show the modal
                document.getElementById('imageModal').style.display = 'block';
            });
        });

        // Close the modal when the close button is clicked
        document.querySelector('.modal .close').addEventListener('click', function() {
            document.getElementById('imageModal').style.display = 'none';
        });

        // Close the modal when clicking outside the modal
        window.addEventListener('click', function(event) {
            if (event.target === document.getElementById('imageModal')) {
                document.getElementById('imageModal').style.display = 'none';
            }
        });
    });
</script>

  </body>
</html>
