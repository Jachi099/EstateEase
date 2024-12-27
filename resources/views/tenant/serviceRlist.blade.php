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
                <div class="visit_btn1">
                    <div class="visit-requested-properties1">RENTED PROPERTIES</div>
                </div>
            </a>


            <a href="{{ route('tenant.serviceRlist') }}">
                <div class="help_btn1">
                   REQUEST SERVICES</div>

            </a>
            </div>


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
HISTORY OF SERVICE REQUESTS              </h1>
           <div class="sort-by montserrat-medium-black-16px">SORT BY</div>
              <div class="sort"></div>
            </div>

            <a href="{{ route('tenant.serviceRequestT') }}">
    <div class="add-property-btn">REQUEST SERVICE</div>
</a>

    @if($serviceRequests->isEmpty())
    <table class="overlap-group21">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Type</th>
                    <th>Cost</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <tr>
        <p>You have no service requests at the moment.</p>
            </tr>
        </tbody>
    </table>
    @else
        <table class="overlap-group21">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Type</th>
                    <th>Cost</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($serviceRequests as $request)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $request->service->picture) }}" alt="Service: {{ $request->service->description }}" width="50">
                            {{ $request->service->description }}
                        </td>
                        <td>{{ $request->service->type }}</td>
                        <td>৳{{ number_format($request->service->cost, 2) }}</td>
                        <td>{{ ucfirst($request->status) }}</td>
                        <td>
                            @if($request->status == 'pending' && is_null($request->service_provider_id))
                                <form action="{{ route('tenant.cancelServiceRequest', $request->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                </form>
                            @else
                                <span class="text-muted">Not cancellable</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>





          </div>
        </div>
      </div>
    </div>
  </body>
</html>
