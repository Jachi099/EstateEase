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
<a href="{{ route('visitor.profile') }}">
            <div class="profile_btn">
            <div class="profile ">PROFILE</div>
            </div>
            </a>

            <a href="{{ route('visitor.visit_req_list') }}">
                <div class="visit_btn">
                    <div class="visit-requested-properties">VISIT REQUESTED PROPERTIES</div>
                </div>
            </a>


            <div class="navbar-link-container">
                  <div class="navbar-link-estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
                  <a href="{{ route('visitor.user_home') }}"><div class="navbar-link-place navbar-link montserrat-normal-black-16px">Home</div> </a
            > <a href="{{ route('visitor.user_home') }}"><div class="navbar-link-about navbar-link montserrat-normal-black-16px">About</div> </a
            >  <a href="{{ route('visitor.property_list') }}"><div class="navbar-link-properties montserrat-normal-black-16px">Properties</div> </a
              >


              <a href="{{ route('visitor.profile') }}"><div class="head_pic">
                  @if($profilePicture)
                      <img src="{{ asset('storage/' . $profilePicture) }}" alt="User Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
                  @else
                      <img src="path/to/default/image.png" alt="Default Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
                  @endif
              </div>

          </a>
            <div class="estate-ease_logo-1 estate-ease_logo-4 lexendzetta-extra-bold-white-15px">VISITOR DASHBOARD</div>
          </div>

          <div class="overlap-group1">
            <div class="flex-row">
              <h1 class="estate-ease_logo-2 estate-ease_logo-3 lexendzetta-medium-beaver-25px">
                VISIT REQUESTED PROPERTIES STATUS
              </h1>
              <div class="sort-by montserrat-medium-black-16px">SORT BY</div>
              <div class="sort"></div>
            </div>
            @foreach ($properties as $property)
    <div class="overlap-group2">
        <!-- Property Card -->
        <div class="pro_card">
            <!-- Property Picture -->
            <div class="pro_pic">
                <!-- Assuming the property has images associated with it -->
                @if($property->propertyImages->isNotEmpty())
                    <img src="{{ asset('storage/property_images/' . $property->propertyImages->first()->image_path) }}" alt="Property Image" class="property-image">
                @else
                    <img src="{{ asset('images/default-property.jpg') }}" alt="No Image" class="property-image">
                @endif
            </div>
            <div class="visit_date">
                @foreach ($property->visitRequests as $visitRequest)
                    @if ($visitRequest->user_id == auth()->user()->id)
                        <span>{{ $visitRequest->visit_date->format('d M, Y') }}</span> <!-- Updated date format -->
                    @endif
                @endforeach
            </div>
            <!-- Requested Visit Date -->
            <div class="visit-requested-date visit-requested montserrat-normal-black-12px">
                VISIT REQUESTED DATE:
            </div>

            <!-- Property Address -->
            <div class="property-address montserrat-normal-black-12px">
                PROPERTY ADDRESS:
            </div>

            <div class="pro_add">
                {{ $property->house_no }}, {{ $property->area }}, {{ $property->thana }},
                {{ $property->city }} - {{ $property->postal_code }}
            </div>

            <!-- Status Section -->
            <div class="status">
                @foreach ($property->visitRequests as $visitRequest)
                    @if ($visitRequest->user_id == auth()->user()->id)
                        <div class="visit-status {{ $visitRequest->status }}">
                            <!-- Display status: Accepted, Rejected, or Pending -->
                            Status:
                            @if($visitRequest->status == 'accepted')
                                <span class="status-accepted">Accepted</span>
                            @elseif($visitRequest->status == 'rejected')
                                <span class="status-rejected">Rejected</span>
                            @else
                                <span class="status-pending">Pending</span>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- View Details Button -->
            <a href="{{ route('visitor.bookedproperty_details', ['property_id' => $property->property_ID]) }}">
                <div class="pro_detail_btn">
                    <div class="details">DETAILS</div>
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
