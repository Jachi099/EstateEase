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

    <link rel="stylesheet" type="text/css" href="{{ asset('css1/visitu95property.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/globals.css') }}" />
  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="visitu95property" />
    <div class="container-center-horizontal">
      <div class="visitu95property screen">
        <div class="overlap-group-container">
          <div class="overlap-group">
            <div class="side_div"></div>

            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: inline;">
    @csrf
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
    class="logout_btn" style="cursor: pointer;">
        LOGOUT
    </a>
</form>
<a href="{{ route('tenant.profile') }}">
            <div class="profile_btn">
            <div class="profile ">PROFILE</div>
            </div>
            </a>

            <a href="{{ route('tenant.rentedProperties') }}">
                <div class="visit_btn">
                    <div class="visit-requested-properties">RENTED PROPERTIES</div>
                </div>
            </a>


            <div class="navbar-link-container">
                  <div class="navbar-link-estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
                  <a href="{{ route('tenant.user_home') }}"><div class="navbar-link-place navbar-link montserrat-normal-black-16px">Home</div> </a
            > <a href="{{ route('tenant.user_home') }}"><div class="navbar-link-about navbar-link montserrat-normal-black-16px">About</div> </a
            >  <a href=""><div class="navbar-link-properties montserrat-normal-black-16px">Properties</div> </a
              >


              <a href="{{ route('tenant.profile') }}"><div class="head_pic">
                  @if($profilePicture)
                      <img src="{{ asset('storage/' . $profilePicture) }}" alt="User Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
                  @else
                      <img src="path/to/default/image.png" alt="Default Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
                  @endif
              </div>

          </a>
            <div class="estate-ease_logo-1 estate-ease_logo-4 lexendzetta-extra-bold-white-15px">TENANT DASHBOARD</div>
          </div>

          <div class="overlap-group1">
            <div class="flex-row">
              <h1 class="estate-ease_logo-2 estate-ease_logo-3 lexendzetta-medium-beaver-25px">
              RENTED PROPERTIES STATUS
              </h1>
             <!--  <div class="sort-by montserrat-medium-black-16px">SORT BY</div>
              <div class="sort"></div> -->
            </div>
            @foreach ($properties as $property)
    <div class="overlap-group2">
        <!-- Property Card -->
        <div class="pro_card1">
            <!-- Property Picture -->
            @php
    $propertyImage = \App\Models\PropertyImage::where('property_ID', $property->property_ID)->first();
@endphp

@if ($propertyImage)
    <!-- Display the first image from PropertyImage model -->

        <img src="{{ asset('storage/' . $propertyImage->image_path) }}" alt="Property Image" class="pro_pic">

@else
    <!-- Fallback to default image if no property images exist -->

        <img src="{{ asset('path/to/default/image.png') }}" alt="Default Property Image" class="pro_pic">

@endif

<div class="visit_date">
@if ($tenant && $tenant->rental_start_date)
            {{ $tenant->rental_start_date }}
        @else
            <span>Not Rented</span>
        @endif
</div>


            <!-- Requested Visit Date -->
            <div class="visit-requested-date visit-requested montserrat-normal-black-12px">
               RENTED DATE:
            </div>

            <!-- Property Address -->
            <div class="property-address montserrat-normal-black-12px">
                PROPERTY ADDRESS:
            </div>

            <div class="pro_add">
                {{ $property->house_no }}, {{ $property->area }}, {{ $property->thana }},
                {{ $property->city }} - {{ $property->postal_code }}
            </div>

            @php
            // Check if the tenant has paid this month
            $currentMonthPayment = \App\Models\TenantPayment::where('tenant_id', $tenant->id)
                ->whereMonth('payment_date', now()->month)
                ->whereYear('payment_date', now()->year)
                ->first();
        @endphp

        <div class="status">
            <div class="payment-status {{ $currentMonthPayment && $currentMonthPayment->status == 'paid' ? 'status-paid' : 'status-overdue' }}">
                @if ($currentMonthPayment && $currentMonthPayment->status == 'paid')
                    <span class="status-accepted">Paid</span>
                @else
                    <span class="status-rejected">Overdue</span>
                @endif
            </div>
        </div>


            <!-- View Details Button -->
            <a href="{{ route('tenant.showRentedPropertyDetails', $property->property_ID) }}">
    <div class="pro_detail_btn">
        DETAILS
    </div>
</a>

        </div>
    </div>
@endforeach





          </div>
        </div>
      </div>
    </div>
  </body>
</html>
