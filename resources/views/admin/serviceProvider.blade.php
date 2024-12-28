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

    <link rel="stylesheet" type="text/css" href="{{ asset('css/serviceu95provideru95admin.css') }}" />

<link rel="stylesheet" type="text/css" href="{{ asset('css/styleguide.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('globals.css') }}" />
  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="serviceu95provideru95admin" />
    <div class="container-center-horizontal">
      <div class="serviceu95provideru95admin screen">
        <div class="overlap-group">
          <div class="estate-ease estate lexendzetta-black-mongoose-20px">EstateEase</div>
          <div class="overlap-group7"><div class="dashboard montserrat-extra-bold-mongoose-20px">Dashboard</div></div>
          <div class="overlap-group-item">
            <a href="profileu95admin.html"> <div class="link"></div></a>
            <div class="profile montserrat-extra-bold-mongoose-20px">Profile</div>
          </div>
          <div class="overlap-group9"><div class="property montserrat-extra-bold-mongoose-20px">Property</div></div>
          <div class="overlap-group11"><div class="landlord montserrat-extra-bold-mongoose-20px">Landlord</div></div>
          <div class="overlap-group6">
            <div class="tenant-visitor montserrat-extra-bold-mongoose-20px">Tenant &amp; Visitor</div>
          </div>
          <div class="overlap-group-item">
            <a href="serviceu95admin.html"> <div class="link"></div></a>
            <div class="service service-1 montserrat-extra-bold-mongoose-20px">Service</div>
          </div>
          <div class="overlap-group5">
            <div class="service-provider service-1 montserrat-extra-bold-beaver-20px">Service Provider</div>
          </div>
          <div class="overlap-group-item">
            <a href="visitor.html"> <div class="link"></div></a>
            <div class="feedback montserrat-extra-bold-mongoose-20px">Feedback</div>
          </div>
          <div class="overlap-group4"><div class="log-out montserrat-extra-bold-mongoose-20px">Log out</div></div>
        </div>
        <div class="flex-col flex">
          <div class="flex-row flex">
            <div class="flex-col-1 flex-col-4">
              <h1 class="estate-ease_logo estate lexendzetta-medium-beaver-25px">SERVICE PROVIDER</h1>
              <a href="{{ route('admin.addProvider') }}"
                ><div class="add-service-provider montserrat-bold-black-20px">ADD SERVICE PROVIDER</div>
              </a>
              <div class="flex-row-1 montserrat-medium-black-16px">
                <div class="location">LOCATION:</div>
                <div class="location_opt"></div>
                <div class="service-type service-1">SERVICE TYPE:</div>
                <div class="servicetype_opt"></div>
              </div>
            </div>
            <div class="flex-col-2 flex-col-4">
              <a href="profileu95admin.html" class="align-self-flex-end"> <div class="head_pic"></div></a>
              <div class="overlap-group2"><div class="filter montserrat-black-white-16px">FILTER</div></div>
            </div>
          </div>
          <div class="flex-col-3 flex-col-4">
            <div class="sort-container">
              <div class="sort montserrat-medium-black-16px">SORT:</div>
              <div class="sort-1"></div>
            </div>
            <div class="flex-row-2">
              <div class="list-of-services-providers montserrat-semi-bold-black-20px">LIST OF SERVICES PROVIDERS</div>
              <div class="total-service-providers montserrat-medium-black-16px">TOTAL SERVICE PROVIDERS :</div>
              <div class="total"></div>
            </div>
            <div class="table-container">
    <table class="basic-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Address</th>
                <th>Specialization</th>
                <th>Hourly Rate (৳)</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($serviceProviders as $provider)
            <tr>
                <td>{{ $provider->id }}</td>
                <td>{{ $provider->name }}</td>
                <td>{{ $provider->phone_number }}</td>
                <td>{{ $provider->email }}</td>
                <td>{{ $provider->address }}</td>
                <td>{{ $provider->specialization }}</td>
                <td>৳{{ number_format($provider->hourly_rate, 2) }}</td>
                <td>{{ $provider->availability_status }}</td>
                <td>
                    <!-- Edit button -->
                    <a href="" class="action-button">
                        <img src="{{ asset('img/edit.svg') }}" alt="Edit" class="icon" />
                    </a>

                    <!-- Delete button -->
                    <form action="" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button" onclick="return confirm('Are you sure you want to delete this provider?')">
                            <img src="{{ asset('img/trash-2.svg') }}" alt="Delete" class="icon" />
                        </button>
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
    </div>
  </body>
</html>
