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



    <script src="https://js.stripe.com/v3/"></script>
    <style>
        /* Add your custom styles here */
        .card-type-icon {
            margin-top: 10px;
        }
    </style>
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





                <div class="navbar-link-rented-date">RENTED DATE:</div>
 <!-- Date Rented -->

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
                        <div class="division">Amenities:</div>

                        <div class="surname surname-2">ADDRESS:</div>
                      </div>
                      <div class="flex-col-6">
                      <div class="division-1">
    {{ $property->amenities ?? 'N/A' }}
</div>



<div class="house_no">
{{ $property->house_no ? $property->house_no . ', ' : '' }}
    {{ $property->area ? $property->area . ', ' : '' }}
    {{ $property->thana ? $property->thana . ', ' : '' }}
    {{ $property->city ?? 'N/A' }}
    {{ $property->postal_code ? ' - ' . $property->postal_code : '' }}</div>




                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="overlap-group-container-3">

                <div class="overlap-group2">
                  <div class="tenant-information montserrat-bold-black-12px">TENANT INFORMATION</div>
                  <div class="overlap-group15112">

<!-- Left Column -->
<div class="flex-col-71 montserrat-normal-black-12px">
    <div class="name12">VISIT REQUESTED DATE:</div>
    <div class="phone12">RENT AMOUNT:</div>
    <div class="permanent-address12">PLATFORM CHARGE</div>
    <div class="email12">TOTAL</div>
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
    <span id="total-rent">
        @if ($property->rent)
            @php
                $totalRent = $property->rent;  // Only rent, no service charge here
                $platformCharge = $totalRent * 0.05; // 5% platform charge
                $totalAmount = $totalRent + $platformCharge; // Rent + Platform Charge
            @endphp
            <input type="hidden" name="amount" value="{{ $totalAmount }}"> <!-- Hidden amount input -->
            ৳ {{ number_format($totalRent, 2) }} <!-- Display only the rent -->
        @else
            N/A
        @endif
    </span>
</div>

<!-- Display the platform charge (5% of rent) -->
<div class="name-15">
    <span id="platform-charge-amount">
        @if ($property->rent)
            ৳ {{ number_format($platformCharge, 2) }}
        @else
            N/A
        @endif
    </span>
</div>

<!-- Display total amount (Rent + Platform Charge) -->
<div class="name-14" id="total-amount">
    <span id="total-amount-value">
        @if ($property->rent)
            ৳ {{ number_format($totalAmount, 2) }}
        @else
            N/A
        @endif
    </span>
</div>
<!-- Card Payment Section -->
<div id="card-element" class="name-16">

</div>
<div id="card-type-icon" class="card-type-icon">
            <img id="visa-icon" src="visa-icon.png" style="display:none" alt="Visa">
            <img id="mastercard-icon" src="mastercard-icon.png" style="display:none" alt="MasterCard">
            <img id="amex-icon" src="amex-icon.png" style="display:none" alt="American Express">
            <img id="discover-icon" src="discover-icon.png" style="display:none" alt="Discover">
        </div>

<div id="card-errors" role="alert"></div>

<button id="submit" class="btn">Pay Now</button>



</div>

</div>



                </div>
              </div>
            </div>
            <div class="overlap-group-container-4">
            <a href="{{ route('visitor.visit_req_list') }}">
            <div class="overlap-group5"><div class="go-back montserrat-black-beaver-16px">GO BACK</div></div>

</a>

            </div>







          </div>
        </div>
      </div>
    </div>

    </div>

    <script>
    const stripe = Stripe('your-publishable-key-here'); // Replace with your Stripe public key

    const payButton = document.getElementById('pay-now-btn');
    payButton.addEventListener('click', async () => {
        // Make a request to your server to create a Checkout session
        const response = await fetch('/create-checkout-session', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
        });

        const session = await response.json();

        // Redirect to the Stripe Checkout page
        const { error } = await stripe.redirectToCheckout({ sessionId: session.id });

        if (error) {
            console.error('Error redirecting to checkout:', error);
        }
    });
    </script>
  </body>
</html>
