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
        <div class="overlap-group">
          <div class="estate-ease estate lexendzetta-black-mongoose-20px">EstateEase</div>
          <div class="overlap-group10"><div class="dashboard montserrat-extra-bold-beaver-20px">Dashboard</div></div>
          <div class="overlap-group8"><div class="profile montserrat-extra-bold-mongoose-20px">Profile</div></div>
          <div class="x-container1">
          <a href="{{ route('admin.property_list') }}"> <div class="link"> <div class="property">Property</div></div></a>
          
          </div>

          <div class="overlap-group14"><div class="landlord montserrat-extra-bold-mongoose-20px">Landlord</div></div>


          <div class="x-container2">
            <a href="{{ route('admin.visitRequests') }}">
              <div class="link"></div>
          </a>
            <div class="tenant-visitor montserrat-extra-bold-mongoose-20px">Tenant &amp; Visitor</div>
          </div>


          <div class="overlap-group9"><div class="service montserrat-extra-bold-mongoose-20px">Service</div></div>
          <div class="overlap-group6">
            <div class="service-provider montserrat-extra-bold-mongoose-20px">Service Provider</div>
          </div>
          <div class="overlap-group12"><div class="feedback montserrat-extra-bold-mongoose-20px">Feedback</div></div>
          <div class="overlap-group11"><div class="log-out montserrat-extra-bold-mongoose-20px">Log out</div></div>
        </div>
        <div class="flex-col flex">
          <h1 class="estate-ease_logo estate lexendzetta-medium-beaver-25px">ADMIN DASHBOARD</h1>
          <div class="flex-row flex">
            <div class="overlap-group-container">
              <div class="total-container">
                <div class="total montserrat-medium-black-15px">TOTAL PROPERTIES</div>
                <div class="total-1"></div>
              </div>
              <div class="provider-container">
                <div class="total-service-providers montserrat-medium-black-15px">TOTAL SERVICE PROVIDERS</div>
                <div class="totalprovider"></div>
              </div>
            </div>
            <div class="total-container-1 total-container-4">
              <div class="total montserrat-medium-black-15px">TOTAL LANDLORDS</div>
              <div class="totalland"></div>
            </div>
          </div>
        </div>
        <div class="flex-row-1">
          <div class="total-container-2 total-container-4">
            <div class="total-tenants montserrat-medium-black-15px">TOTAL TENANTS</div>
            <div class="total-1"></div>
          </div>
          <div class="flex-col-1">
            <div class="head_pic"></div>
            <div class="total-container-3 total-container-4">
              <div class="total-services montserrat-medium-black-15px">TOTAL SERVICES</div>
              <div class="total-1"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
