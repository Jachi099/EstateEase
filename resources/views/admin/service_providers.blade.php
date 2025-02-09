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

    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin_service-providers.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/globals.css') }}" />


  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="propertyu95listu95admin" />
    <div class="container-center-horizontal">
        <div class="propertyu95listu95admin screen">
          <div class="overlap-group1">
            <div class="estate-ease estate lexendzetta-black-mongoose-20px">EstateEase</div>



            <div class="dashb-container">
              <a href="{{ route('admin.dashboard') }}">
                  <div class="link"></div>
              </a>
              <div class="dashboard montserrat-extra-bold-mongoose-20px">Dashboard</div>
          </div>

            <div class="overlap-group6"><div class="profile montserrat-extra-bold-mongoose-20px">Profile</div></div>

            <div class="overlap-group8">
              <a href="{{ route('admin.property_list') }}">
                <div class="link"></div>
            </a>
              <div class="property montserrat-extra-bold-beaver-20px">Property</div>

          </div>

            <div class="overlap-group4"><div class="landlord montserrat-extra-bold-mongoose-20px">Landlord</div></div>

            <div class="tenant-container">
            <a href="{{ route('admin.visitor') }}">
                <div class="link"></div>
            </a>
              <div class="tenant-visitor montserrat-extra-bold-mongoose-20px">Tenant &amp; Visitor</div>
            </div>
            <div class="overlap-group5">
              <div class="service service-1 montserrat-extra-bold-mongoose-20px">Service</div>
            </div>
            <div class="overlap-group7">
              <a href="{{ route('admin.serviceProviders') }}">
              <div class="link"></div>
          </a>
              <div class="service-1 montserrat-extra-bold-mongoose-20px">Service Providers</div>
            </div>
            <div class="overlap-group10"><div class="feedback montserrat-extra-bold-mongoose-20px">Feedback</div></div>
            <div class="overlap-group12"><div class="log-out montserrat-extra-bold-mongoose-20px">Log out</div></div>



          </div>

          <div class="flex-col">
            <div class="flex-row">
              <div class="flex-col-1 flex-col-3">
                <h1 class="estate-ease_logo estate lexendzetta-medium-beaver-25px">SERVICE PROVIDERS</h1>



                <div class="flex-row-2 montserrat-medium-black-16px">
                    <div class="total-properties">TOTAL SERVICE PROVIDERS:</div>
                    <div class="total">{{ $serviceProviders->count() }}</div>

                  </div>





            <!-- Display Service providers -->
            <div class="visit-requests-container">
              <br><br>
              <h2> </h2>
              <br>
              <table class="visit-requests-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Service</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($serviceProviders as $provider)
                        <tr>
                            <td>{{ $provider->id }}</td>
                            <td>{{ $provider->name }}</td>
                            <td>{{ $provider->phone }}</td>
                            <td>{{ $provider->service }}</td>
                            <td>
                              <form action="{{ route('admin.serviceProviders.delete', $provider->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this service provider?');">Delete</button>
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>




        </div>
      </div>
    </div>
  </body>
</html>



