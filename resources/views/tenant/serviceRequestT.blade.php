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
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/serviceu95requestu95tenant.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/globals.css') }}" />
<!-- Add Bootstrap CSS to your page -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Add Bootstrap JS and dependencies (for dismissing alerts) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="serviceu95requestu95tenant" />
    <div class="container-center-horizontal">
      <div class="serviceu95requestu95tenant screen">
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
PROFILE            </div>
            </a>

            <a href="{{ route('tenant.rentedProperties') }}">
                <div class="visit_btn1">
                    <div class="visit-requested-properties1">RENTED PROPERTIES</div>
                </div>
            </a>


            <a href="{{ route('tenant.serviceRlist') }}">
                <div class="help_btn1">
                   REQUEST SERVICES</div>
            </a>

            </div>

            <div class="div_top"></div>

            <a href="{{ route('tenant.user_home') }}"><div class="place montserrat-normal-black-16px">Home</div> </a
            > <a href="{{ route('tenant.user_home') }}"><div class="about montserrat-normal-black-16px">About</div> </a
            >  <a href=""><div class="properties montserrat-normal-black-16px">Properties</div> </a
              >


              <a href="{{ route('tenant.profile') }}">
    <div class="head_pic">
        @if($profilePicture)
            <img src="{{ asset($profilePicture) }}" alt="User Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
        @else
            <img src="{{ asset('path/to/default/image.png') }}" alt="Default Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
        @endif
    </div>
</a>
              </div>

            <div class="notification montserrat-normal-black-16px">Notification</div>

            <div class="estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
            <div class="estate-ease_logo-1 estate-ease_logo-3 lexendzetta-extra-bold-white-15px">TENANT DASHBOARD</div>
          <div class="overlap-group1">
          @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

            <h1 class="estate-ease_logo-2 estate-ease_logo-3 lexendzetta-medium-beaver-25px">SERVICE REQUEST</h1>
            <form action="{{ route('tenant.serviceRequestT') }}" method="POST">

    @csrf
    <div class="flex-row montserrat-medium-black-16px">
        <div class="flex-col">
            <div class="service-type service">SERVICE TYPE</div>
            <select name="service_id" class="service_type" id="service" class="form-control" required>
                <option value="">Select a service</option>
                @if($services->isEmpty())
                    <option value="">No services available</option>
                @else
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" data-labor-cost="{{ $service->cost }}">{{ $service->type }}</option>
                    @endforeach
                @endif
            </select>

            <div class="problem-details">PROBLEM DETAILS</div>
            <textarea class="prblm_txtbox" name="description" id="description" class="form-control" rows="3" placeholder="Describe the issue in detail" required></textarea>
        </div>

        <div class="flex-col-1 flex-col-4">
            <div class="choose-a-property">CHOOSE A PROPERTY</div>
            <select class="choose_property" name="property_id" id="property_id" class="form-control" required>
                <option value="">Select a property</option>
                @if($tenantWithProperty->property)
                    <option value="{{ $tenantWithProperty->property->property_ID }}">{{ $tenantWithProperty->property->house_no }} - {{ $tenantWithProperty->property->area }}</option>
                @else
                    <p>No property found for this tenant.</p>
                @endif
            </select>

            <div class="prefered-date-time">PREFERRED DATE &amp; TIME</div>
            <input class="date_time" type="datetime-local" name="service_date" id="service_date" class="form-control" required>

            <div class="urgency">URGENCY</div>
            <select name="urgency" class="urgent_drop" id="urgency" class="form-control" required>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>
    </div>

    <div class="flex-col-2 flex-col-4">
        <div class="flex-row-2">
            <div class="flex-col-3 flex-col-4">
                <div class="flex-row-3 montserrat-medium-black-16px">
                    <div class="service-charge-label service">LABOR CHARGE&nbsp;</div>
                    <div id="labor_charge" class="service_charge">0.00</div> <!-- Display labor charge -->
                    <div class="tk-2 montserrat-medium-black-16px">TK</div>
                </div>

                <div class="flex-row-3 montserrat-medium-black-16px">
                    <div class="service-charge-label service">PLATFORM CHARGE&nbsp;</div>
                    <div id="platform_fee" class="service_charge">0.00</div> <!-- Display platform fee -->
                    <div class="tk-2">TK</div>
                </div>

                <div class="flex-row-3 montserrat-medium-black-16px">
                    <div class="service-charge-label service">URGENCY FEE&nbsp;</div>
                    <div id="urgency_fee" class="service_charge">0.00</div> <!-- Display urgency fee -->
                    <div class="tk-2">TK</div>
                </div>

                <div class="flex-row-3 montserrat-medium-black-16px">
                    <div class="service-charge-label service">TOTAL COST&nbsp;</div>
                    <div id="total_cost" class="service_charge">0.00</div> <!-- Display total cost -->
                    <div class="tk-2">TK</div>
                </div>

                <p class="name_warnings">*** MATERIAL COSTS ARE SEPARATE AND WILL BE NOTIFIED IF NEEDED.**</p>
            </div>

            <div class="back-container">
                <button type="submit" class="overlap-group2">REQUEST SERVICE</button>
                <a href="{{ route('tenant.serviceRlist') }}">
                    <div class="go_back"></div>
                    <div class="go-back montserrat-black-beaver-16px">GO BACK</div>
                </a>
            </div>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const serviceSelect = document.getElementById('service');
    const urgencySelect = document.getElementById('urgency');
    const laborCostElement = document.getElementById('labor_charge');
    const platformFeeElement = document.getElementById('platform_fee');
    const urgencyFeeElement = document.getElementById('urgency_fee');
    const totalCostElement = document.getElementById('total_cost');

    let baseLaborCost = 0;
    let urgencyFee = 0;

    // Calculate costs on form changes
    function calculateCost() {
        const laborCost = baseLaborCost;
        const platformFee = (laborCost + urgencyFee) * 0.10;  // Platform fee 10%
        const totalCost = laborCost + urgencyFee + platformFee;

        // Update the displayed costs
        laborCostElement.textContent = `৳${laborCost.toFixed(2)}`;
        platformFeeElement.textContent = `৳${platformFee.toFixed(2)}`;
        urgencyFeeElement.textContent = `৳${urgencyFee.toFixed(2)}`;
        totalCostElement.textContent = `৳${totalCost.toFixed(2)}`;
    }

    // Handle service type change
    serviceSelect.addEventListener('change', function () {
        const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
        baseLaborCost = parseFloat(selectedOption.getAttribute('data-labor-cost')) || 0;
        calculateCost();  // Recalculate cost based on the selected service
    });

    // Handle urgency change
    urgencySelect.addEventListener('change', function () {
        const urgency = this.value;
        if (urgency === 'low') {
            urgencyFee = 100; // low urgency fee
        } else if (urgency === 'medium') {
            urgencyFee = 300; // medium urgency fee
        } else if (urgency === 'high') {
            urgencyFee = 500; // high urgency fee
        }
        calculateCost();  // Recalculate cost based on selected urgency
    });
});
</script>


  </body>
</html>
