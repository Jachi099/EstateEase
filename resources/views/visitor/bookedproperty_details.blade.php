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
    <style>
    #confirmation-popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.popup-content {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
}

#confirmation-popup button {
    margin: 10px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
}

#confirmation-popup button:hover {
    background-color: #ddd;
}


.text-warning {
    color: orange;
}

.text-success {
    color: green;
}

.text-danger {
    color: red;
}

.text-cancelled {
    color: purple;
}

.text-muted {
    color: gray;
}

</style>

    <script src="https://js.stripe.com/v3/"></script>

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
<a href="{{ route('visitor.profile') }}">
            <div class="profile_btn1">
           PROFILE
            </div>
            </a>

            <a href="{{ route('visitor.visit_req_list') }}">
                <div class="visit_btn1">
                    <div class="visit-requested-properties1">VISIT REQUESTED PROPERTIES</div>
                </div>
            </a>



            <div class="div_top"></div>
            <div class="about montserrat-normal-black-16px">Notifications</div>

            <div class="estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
                  <a href="{{ route('visitor.user_home') }}"><div class="place montserrat-normal-black-16px">Home</div> </a
            >
            <a href="{{ route('visitor.property_list') }}"><div class="navbar-link-properties montserrat-normal-black-16px">Properties</div> </a
            >

            <a href="{{ route('visitor.profile') }}">
                <div class="head_pic">
                    @if(isset($profilePicture) && $profilePicture)
                        <img src="{{ asset('storage/' . $profilePicture) }}" alt="User Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
                    @else
                        <img src="path/to/default/image.png" alt="Default Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
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
        $propertyImages = \App\Models\PropertyImage::where('property_ID', $property->property_ID)->limit(15)->get();
    @endphp

    @if($propertyImages->isNotEmpty())
        @foreach($propertyImages as $image)
            <div class="overlap-group1">
                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Property Image" class="pro_pic pro_pic-2">
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
        <!-- First Column -->
        <div class="checkbox-column">
            <div>
                <input type="checkbox" name="amenities[]" value="parking" id="parking"
                    @if(in_array('parking', json_decode($property->amenities))) checked @endif disabled>
                <label for="parking">Parking</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="lift" id="lift"
                    @if(in_array('lift', json_decode($property->amenities))) checked @endif disabled>
                <label for="lift">Lift/Elevator</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="generator_backup" id="generator_backup"
                    @if(in_array('generator_backup', json_decode($property->amenities))) checked @endif disabled>
                <label for="generator_backup">Generator Backup</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="security" id="security"
                    @if(in_array('security', json_decode($property->amenities))) checked @endif disabled>
                <label for="security">Security</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="gym" id="gym"
                    @if(in_array('gym', json_decode($property->amenities))) checked @endif disabled>
                <label for="gym">Gym</label>
            </div>
        </div>

        <!-- Second Column -->
        <div class="checkbox-column">
            <div>
                <input type="checkbox" name="amenities[]" value="swimming_pool" id="swimming_pool"
                    @if(in_array('swimming_pool', json_decode($property->amenities))) checked @endif disabled>
                <label for="swimming_pool">Swimming Pool</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="private_pool" id="private_pool"
                    @if(in_array('private_pool', json_decode($property->amenities))) checked @endif disabled>
                <label for="private_pool">Private Pool (for villas)</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="playground" id="playground"
                    @if(in_array('playground', json_decode($property->amenities))) checked @endif disabled>
                <label for="playground">Playground</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="garden" id="garden"
                    @if(in_array('garden', json_decode($property->amenities))) checked @endif disabled>
                <label for="garden">Garden/Lawn</label>
            </div>

        </div>

        <!-- Third Column -->
        <div class="checkbox-column">
        <div>
                <input type="checkbox" name="amenities[]" value="hot_water" id="hot_water"
                    @if(in_array('hot_water', json_decode($property->amenities))) checked @endif disabled>
                <label for="hot_water">Hot Water</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="gated_community" id="gated_community"
                    @if(in_array('gated_community', json_decode($property->amenities))) checked @endif disabled>
                <label for="gated_community">Gated Community</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="built_in_wardrobes" id="built_in_wardrobes"
                    @if(in_array('built_in_wardrobes', json_decode($property->amenities))) checked @endif disabled>
                <label for="built_in_wardrobes">Built-in Wardrobes</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="rooftop_access" id="rooftop_access"
                    @if(in_array('rooftop_access', json_decode($property->amenities))) checked @endif disabled>
                <label for="rooftop_access">Rooftop Access</label>
            </div>
            <div>
                <input type="checkbox" name="amenities[]" value="pets_allowed" id="pets_allowed"
                    @if(in_array('pets_allowed', json_decode($property->amenities))) checked @endif disabled>
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
                  <div class="overlap-group151">

<!-- Left Column -->
<div class="flex-col-71 montserrat-normal-black-12px">
    <div class="name12">VISIT REQUESTED DATE:</div>
    <div class="phone12">STATUS:</div>
    <div class="email12">CHOOSE PAYMENT METHOD:</div>
    <label id="payment-label" class="cardorphninfo">CARD NUMBER/PHONE:</label>
    <div class="permanent-address12">RENT AMOUNT:</div>
</div>

<!-- Right Column -->
<div class="flex-col-812">
    <div class="name-12">
        <!-- Display the visit requested date -->
        @if ($visitRequest)
            <span>{{ $visitRequest->visit_date->format('d M, Y') }}</span> <!-- Format as desired -->
        @else
            <span>No visit requested.</span>
        @endif
    </div>

    <div class="name-13">
    <!-- Display the status with conditional colors -->
    @if ($visitRequest)
        <span class="
            @if ($visitRequest->status == 'pending') text-warning
            @elseif ($visitRequest->status == 'accepted') text-success
            @elseif ($visitRequest->status == 'rejected') text-danger
            @elseif ($visitRequest->status == 'canceled') text-cancelled
            @endif
        ">
            {{ ucfirst($visitRequest->status) }}
        </span>
    @else
        <span class="text-muted">N/A</span>
    @endif
</div>




   <!-- The Form -->
<form id="payment-form" action="{{ route('payment.process', ['visitor_id' => auth()->user()->id]) }}" method="POST" onsubmit="submitPayment(event)">
    @csrf
    <!-- Payment Method Selection -->
    <select class="name-14" name="payment_method" id="payment-method" required>
        <option value="" disabled selected>Select Payment Method</option>
        <option value="nagad">Nagad</option>
        <option value="bkash">bKash</option>
        <option value="debit">Debit Card</option>
        <option value="credit">Credit Card</option>
    </select>

    <!-- Input for Credit/Debit Card -->
    <div id="card-input-container" style="display:none;">
        <div id="card-element" class="name-16"></div> <!-- Stripe Card input element -->
        <div id="card-errors" role="alert"></div> <!-- Error messages -->
    </div>

    <!-- Payment Method Details for bKash, Nagad -->
    <div id="payment-method-details" style="display:none;">
        <label for="payment-details" id="payment-label"></label>
        <input type="text" class="name-16" id="payment-input" name="payment_details" placeholder="Enter Payment Details" />
    </div>

    <!-- Display Total Rent with Service Charge -->
    <div class="name-15">
        <span id="total-rent">
            @if ($property->rent)
                @php
                    $serviceCharge = ($property->rent * 5) / 100; // 5% service charge
                    $totalRent = $property->rent + $serviceCharge;
                @endphp
                <input type="hidden" name="amount" value="{{ $totalRent }}"> <!-- Hidden amount input -->
                ৳ {{ number_format($totalRent, 2) }} <!-- Total Rent + Service Charge -->
            @else
                N/A
            @endif
        </span>
    </div>

    <!-- Hidden Fields for User Data -->
    <input type="hidden" name="name" value="{{ auth()->user()->full_name }}" />
    <input type="hidden" name="email" value="{{ auth()->user()->email }}" />
    <input type="hidden" name="phone" value="{{ auth()->user()->phone_number }}" />
    <input type="hidden" name="address" value="{{ auth()->user()->current_address }}" />
    <input type="hidden" name="property_id" value="{{ $property->property_ID }}">
    <input type="hidden" name="visitor_id" value="{{ auth()->user()->id }}" />

    @if ($visitRequest && $visitRequest->status == 'accepted')
    <!-- Show the Pay Now button only when the status is accepted -->
    <button id="pay-btn" class="pay-btn" type="button">Pay Now</button>
@endif
</form>


</div>

</div>

<div id="popup" class="popup" style="display: none;">
    <div id="popup-content">
        <p id="popup-message"></p>
        <button id="close-popup">Close</button>
    </div>
</div>

                </div>
              </div>
            </div>
            <div class="overlap-group-container-4">
            <a href="{{ route('visitor.visit_req_list') }}">
            <div class="overlap-group5"><div class="go-back montserrat-black-beaver-16px">GO BACK</div></div>

</a>
    @if ($visitRequest && $visitRequest->status == 'pending')
        <!-- Only show this button if the status is 'pending' -->
        <form action="{{ route('visitor.cancelVisitRequest', $property->property_ID) }}" method="POST">
            @csrf
            <button type="submit" class="overlap-group9">CANCEL REQUEST</button>
        </form>
    @endif


            </div>







          </div>
        </div>
      </div>
    </div>
    <div id="confirmation-popup" style="display:none;">
    <div class="popup-content">
        <h2>Are you sure you want to pay?</h2>
        <button id="confirm-payment">Yes, Pay Now</button>
        <button id="cancel-payment">Cancel</button>
    </div>
</div>
    <script>
// Initialize Stripe
var stripe = Stripe('pk_test_51QUU8KP2zO95Ub2TwNeybmjvtzavKiZPXeD2n7c5CdoWvwKDSdVtIf8W7C2sqoGdAHsk2PfkEwV1WOpiTjmsvAnr00VCJSHnh2');
var elements = stripe.elements();
var card = elements.create('card');

// Handle Payment Method Selection
document.getElementById('payment-method').addEventListener('change', function () {
    var paymentMethod = this.value;
    var cardInputContainer = document.getElementById('card-input-container');
    var paymentDetails = document.getElementById('payment-method-details');
    var paymentLabel = document.getElementById('payment-label');
    var paymentInput = document.getElementById('payment-input');

    if (paymentMethod === 'debit' || paymentMethod === 'credit') {
        card.mount('#card-element');  // Mount Stripe card only once
        cardInputContainer.style.display = 'block';
        paymentDetails.style.display = 'none';
    } else {
        cardInputContainer.style.display = 'none';
        paymentDetails.style.display = 'block';

        if (paymentMethod === 'bkash') {
            paymentLabel.textContent = 'bKash Number:';
            paymentInput.setAttribute('placeholder', 'Enter bKash Number');
        } else if (paymentMethod === 'nagad') {
            paymentLabel.textContent = 'Nagad Number:';
            paymentInput.setAttribute('placeholder', 'Enter Nagad Number');
        }
    }
});
// Show confirmation popup when 'Pay Now' is clicked
document.getElementById('pay-btn').addEventListener('click', function() {
    document.getElementById('confirmation-popup').style.display = 'flex';
});

// Close the confirmation popup when 'Cancel' is clicked
document.getElementById('cancel-payment').addEventListener('click', function() {
    document.getElementById('confirmation-popup').style.display = 'none';
});

// Proceed with payment when 'Confirm' is clicked
document.getElementById('confirm-payment').addEventListener('click', function() {
    document.getElementById('confirmation-popup').style.display = 'none';
    submitPayment(event); // Call the submitPayment function
});

// Function to handle payment submission
function submitPayment(event) {
    event.preventDefault();

    var paymentMethod = document.getElementById('payment-method').value;
    var visitorId = document.querySelector('input[name="visitor_id"]').value;

    if (paymentMethod === 'debit' || paymentMethod === 'credit') {
        stripe.createToken(card).then(function(result) {
            if (result.error) {
                showPopup('Payment failed: ' + result.error.message);
            } else {
                processPayment(result.token.id);
            }
        });
    } else {
        // Submit form for bKash or Nagad
        event.target.submit();
    }
}

// Process Payment (AJAX)
function processPayment(token) {
    var formData = new FormData(document.getElementById('payment-form'));
    formData.append('token', token);

    fetch("{{ route('payment.process', ['visitor_id' => auth()->user()->id]) }}", {
        method: "POST",
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showPopup('Payment successful!');
        } else if (data.error) {
            showPopup(data.error);  // Show error message (e.g., "You have already paid for this month.")
        }
    })
    .catch(error => {
        showPopup('Payment failed: ' + error.message);
    });
}

// Show Popup Message
function showPopup(message) {
    alert(message);  // Replace with custom popup logic if needed
}



        document.getElementById('payment-method').addEventListener('change', function() {
    var paymentMethod = this.value;
    var label = document.getElementById('payment-label');
    var input = document.getElementById('payment-input');

    // Change the label and placeholder text based on the selected payment method
    if (paymentMethod === 'bkash') {
        label.textContent = 'bKash Number:';
        input.setAttribute('placeholder', 'Enter bKash Number');
    } else if (paymentMethod === 'nagad') {
        label.textContent = 'Nagad Number:';
        input.setAttribute('placeholder', 'Enter Nagad Number');
    } else if (paymentMethod === 'debit' || paymentMethod === 'credit') {
        label.textContent = 'CARD Number:';
        input.setAttribute('placeholder', 'Enter Card Number');
    }
});





</script>

  </body>
</html>
