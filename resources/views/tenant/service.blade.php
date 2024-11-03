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

    <link rel="stylesheet" type="text/css" href="{{ asset('css1/visitoru95dashboard.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/globals.css') }}" />
   
  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="visitoru95dashboard" />
    <div class="container-center-horizontal">
      <div class="visitoru95dashboard screen">
        <div class="overlap-group-container">
          <div class="overlap-group2">
            <div class="side_div"></div>
<!-- Logout Button -->
<form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: inline;">
    @csrf
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout_btn" style="cursor: pointer;">
        LOGOUT
    </a>
</form>
<a href="{{ route('tenant.profile') }}">
            <div class="profile_btn"></div>
</a>
            
            <a href="{{ route('tenant.rented_properties_list') }}">  <!-- Link to the property list page -->
    <div class="visit_btn">
        <div class="add-property">RENTED PROPERTY LIST</div>  <!-- Updated text -->
    </div>
</a>


<a href="{{ route('tenant.service') }}">
    <div class="help_btn">
        <div class="help-center">SERVICE</div>
    </div>
</a>
        
   
                <div class="navbar-link-container">
                  <div class="navbar-link-estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
                  <a href="{{ route('tenant.user_home') }}"><div class="navbar-link-place navbar-link montserrat-normal-black-16px">Home</div> </a
            > <a href="{{ route('tenant.user_home') }}"><div class="navbar-link-about navbar-link montserrat-normal-black-16px">About</div> </a
            > <a href="{{ route('tenant.property_list') }}"><div class="navbar-link-properties montserrat-normal-black-16px">Properties</div> </a
            >  <a href="{{ route('user.service') }}"><div class="navbar-link-services montserrat-normal-black-16px">Services</div> </a>
            
            
              <a href="{{ route('tenant.profile') }}"><div class="head_pic">
                  @if($profilePicture)
                      <img src="{{ asset('storage/' . $profilePicture) }}" alt="User Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
                  @else
                      <img src="path/to/default/image.png" alt="Default Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
                  @endif
              </div>
              
          </a>
            <div class="estate-ease_logo-1 estate-ease_logo-4 lexendzetta-extra-bold-white-15px">TENANT DASHBOARD</div>
            <div class="profile montserrat-medium-white-16px">PROFILE</div>
          </div>
          <div class="flex-col">
            <div class="flex-row">
              <h1 class="estate-ease_logo-2 estate-ease_logo-4 lexendzetta-medium-beaver-25px">PROPERTY LISTING</h1>
             

            </div>
          
            <div class="container">
    <h2>Request Home Service</h2>

    <form action="{{ route('tenant.service.request') }}" method="POST">
        @csrf

        <!-- Property Selection -->
        <div class="form-group">
            <label for="property">Select Property:</label>
            <select id="property" name="property_id" class="form-control" required>
                @foreach ($properties as $property)
                    <option value="{{ $property->property_ID }}">{{ $property->type }} - {{ $property->address }}</option>
                @endforeach
            </select>
        </div>

        <!-- Service Type Selection -->
        <div class="form-group">
            <label for="service_type">Select Service Type:</label>
            <select id="service_type" name="service_type" class="form-control" required>
                <option value="plumbing">Plumbing</option>
                <option value="electrical">Electrical</option>
                <option value="cleaning">Cleaning</option>
                <option value="repair">Repair</option>
                <option value="maintenance">Maintenance</option>
                <!-- Add more service types as needed -->
            </select>
        </div>

        <!-- Date of Service -->
        <div class="form-group">
            <label for="service_date">Date of Service:</label>
            <input type="date" id="service_date" name="service_date" class="form-control" required>
        </div>

        <!-- Time of Service -->
        <div class="form-group">
            <label for="service_time">Time of Service:</label>
            <input type="time" id="service_time" name="service_time" class="form-control" required>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Request Service</button>
    </form>

    <!-- Service Request History Table -->
    <h3 class="mt-5">Service Request History</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Service Type</th>
                <th>Date of Service</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($serviceRequests as $request)
                <tr>
                    <td>{{ $request->service_type }}</td>
                    <td>{{ $request->service_date }} at {{ $request->service_time }}</td>
                    <td>{{ ucfirst($request->status) }}</td>
                    <td>
                        @if ($request->status === 'pending')
                            <form action="{{ route('tenant.service.cancel', $request->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                            </form>
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    </div>
    </div>
        </div>
        </div>
      </div>
    </div>
  </body>
</html>
