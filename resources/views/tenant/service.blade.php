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
              <h1 class="estate-ease_logo-2 estate-ease_logo-4 lexendzetta-medium-beaver-25px">SERVICE</h1>
             

            </div>
          
            <a href="{{ route('tenant.service.request.form') }}">
            <div class="add-property-btn">SERVICE REQUEST</div>
        </a>     

    <!-- Success/Error messages -->
  

    <table class="table">
        <thead>
            <tr>
                <th>Service Type</th>
                <th>Problem</th>
                <th>Service Date</th>
                <th>Service Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($serviceRequests as $request)
                <tr>
                    <td>{{ $request->service_type }}</td>
                    <td>{{ $request->description }}</td> <!-- Show the description -->
                    <td>{{ $request->service_date }}</td>
                    <td>{{ $request->service_time }}</td>
                    <td>{{ ucfirst($request->status) }}</td>
                    <td>


                    @if ($request->status === 'pending')
        <form action="{{ route('tenant.service.cancel', $request->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Cancel</button>
        </form>
    @endif
</td>

                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No service requests found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
        </div>

    </div>
    </div>
        </div>
        </div>
      </div>
  </body>
</html>
