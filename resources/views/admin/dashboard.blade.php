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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin-dashboard.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/globals.css') }}" />

  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="admin-dashboard" />
    <div class="container-center-horizontal">
      <div class="admin-dashboard screen">
      <div class="overlap-group1">
            <div class="estate-ease estate lexendzetta-black-mongoose-20px">EstateEase</div>



            <div class="dashb-container">
              <a href="{{ route('admin.dashboard') }}">
                  <div class="link"></div>
              </a>
              <div class="dashboard montserrat-extra-bold-mongoose-20px">Dashboard</div>
          </div>

          <a href="{{ route('admin.profile.edit') }}">
    <div class="overlap-group6">
        <div class="profile montserrat-extra-bold-mongoose-20px">Profile</div>
    </div>
</a>

<a href="{{ route('admin.property_list') }}">
    <div class="overlap-group8">
        <div class="link"></div>
        <div class="property montserrat-extra-bold-beaver-20px">Property</div>
    </div>
</a>


            <div class="overlap-group4"><div class="landlord montserrat-extra-bold-mongoose-20px">Landlord</div></div>
            <div class="tenant-container">
              <a href="{{ route('admin.visitor') }}"> <div class="link"></div></a>
              <div class="tenant-visitor montserrat-extra-bold-mongoose-20px">Tenant &amp; Visitor</div>
            </div>
            <a href="{{ route('admin.services') }}">
            <div class="overlap-group5">
              <div class="service service-1 montserrat-extra-bold-mongoose-20px">Service</div>
            </div></a>
            <a href="{{ route('admin.serviceProvider') }}"> <div class="overlap-group7">
              <div class="service-1 montserrat-extra-bold-mongoose-20px">Service Provider</div>
            </div></a>
            <div class="overlap-group10"><div class="feedback montserrat-extra-bold-mongoose-20px">Feedback</div></div>
            <form action="{{ route('logout') }}" method="POST" id="logoutForm">
    @csrf <!-- CSRF Token for security -->
    <div class="overlap-group12">
        <button type="submit" class="log-out montserrat-extra-bold-mongoose-20px">
            Log out
        </button>
    </div>
</form>



          </div>
        <div class="flex-col flex">
          <h1 class="estate-ease_logo estate lexendzetta-medium-beaver-25px">ADMIN DASHBOARD</h1>
          <div class="flex-row flex">
            <div class="overlap-group-container">
              <div class="total-container">
                <div class="total montserrat-medium-black-15px">TOTAL PROPERTIES</div>
                <div class="total-1">{{ $totalProperties }}</div> <!-- Display total properties -->
                </div>
              <div class="provider-container">
                <div class="total-service-providers montserrat-medium-black-15px">TOTAL SERVICE PROVIDERS</div>
                <div class="total-1">{{ $totalServiceProviders }}</div> <!-- Display total service providers -->
                </div>
            </div>
            <div class="total-container-1 total-container-4">
              <div class="total montserrat-medium-black-15px">TOTAL LANDLORDS</div>
              <div class="total-1">{{ $totalLandlords }}</div> <!-- Display total landlords -->
              </div>
          </div>
        </div>
        <div class="flex-row-1">
          <div class="total-container-2 total-container-4">
            <div class="total-tenants montserrat-medium-black-15px">TOTAL TENANTS</div>
            <div class="total-1">{{ $totalTenants }}</div> <!-- Display total tenants -->
            </div>
          <div class="flex-col-1">
            <div class="head_pic"></div>
            <div class="total-container-3 total-container-4">
              <div class="total-services montserrat-medium-black-15px">TOTAL SERVICES</div>
              <div class="total-1">{{ $totalServices }}</div> <!-- Display total services -->
              </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
