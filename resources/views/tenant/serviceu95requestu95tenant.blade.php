<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('tenant-css/serviceu95requestu95tenant.css') }}">
  </head>
  
  <body style="margin: 0; background: #ffffff">
    <div class="container-center-horizontal">
      <div class="serviceu95requestu95tenant screen">
        <div class="overlap-group-container">
          <div class="overlap-group">
            <!-- Sidebar Links (Navigation) -->
            <a href="{{ route('tenant.payment-history') }}"><div class="payhistory_btn"></div></a>
            <a href="{{ route('tenant.help') }}"><div class="help_btn"></div></a>
            <a href="{{ route('tenant.rented-properties') }}"><div class="rented_btn"></div></a>
            <a href="{{ route('tenant.service-list') }}"><div class="service_btn"></div></a>
            <a href="{{ route('tenant.feedback') }}"><div class="feedback_btn"></div></a>

            <!-- Dashboard Links -->
            <a href="{{ route('tenant.dashboard') }}"><div class="profile_btn"></div></a>

            <!-- Top Navigation Links -->
            <div class="div_top"></div>
            <a href="{{ route('home') }}"><div class="place montserrat-normal-black-16px">Home</div></a>
            <a href="{{ route('tenant.property-list') }}"><div class="properties montserrat-normal-black-16px">Properties</div></a>
            <div class="estate-ease_logo lexendzetta-extra-bold-white-15px">TENANT DASHBOARD</div>
          </div>
          
          <div class="overlap-group1">
            <h1 class="estate-ease_logo-2 lexendzetta-medium-beaver-25px">SERVICE REQUEST</h1>
            
            <!-- Service Request Form -->
            <form action="{{ route('service_requests.store') }}" method="POST">
              @csrf
              <div class="flex-row montserrat-medium-black-16px">
                <div class="flex-col">
                  <div class="service-type">SERVICE TYPE</div>
                  <input type="text" name="service_type" class="service_type form-control" required>

                  <div class="problem-details">PROBLEM DETAILS</div>
                  <textarea name="problem_details" class="prblm_txtbox form-control" required></textarea>
                </div>

                <div class="flex-col-1">
                  <div class="choose-a-property">CHOOSE A PROPERTY</div>
                  <input type="number" name="property_id" class="choose_property form-control" required>

                  <div class="prefered-date-time">PREFERRED DATE & TIME</div>
                  <input type="datetime-local" name="preferred_date" class="date_time form-control" required>

                  <div class="urgency">URGENCY</div>
                  <select name="urgency" class="urgent_drop form-control" required>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                  </select>
                </div>
              </div>

              <!-- Charges Section -->
              <div class="flex-col-2">
                <div class="flex-row-1">
                  <p class="labor-charge montserrat-medium-black-16px">LABOR CHARGE :</p>
                  <div class="total_price">{{ $laborCharge ?? '0' }} TK</div>
                </div>

                <div class="flex-row-2">
                  <div class="service-charge">SERVICE CHARGE :</div>
                  <div class="service_charge">{{ $serviceCharge ?? '0' }} TK</div>
                </div>

                <p class="name_warnings">*** MATERIAL COSTS ARE SEPARATE AND WILL BE NOTIFIED IF NEEDED.**</p>

                <!-- Request Service Button -->
                <button type="submit" class="overlap-group2 request-service montserrat-black-white-16px">REQUEST SERVICE</button>
              </div>
            </form>
            
            <!-- Back Button -->
            <div class="back-container">
              <a href="{{ route('tenant.service-list') }}"><div class="go_back"></div></a>
              <div class="go-back montserrat-black-beaver-16px">GO BACK</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
