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

    <link rel="stylesheet" type="text/css" href="{{ asset('css/serviceu95admin.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('globals.css') }}" />
  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="serviceu95admin" />
    <div class="container-center-horizontal">
      <div class="serviceu95admin screen">
        <div class="overlap-group">
          <div class="estate-ease estate lexendzetta-black-mongoose-20px">EstateEase</div>

          <a href="{{ route('admin.dashboard') }}"><div class="overlap-group8"><div class="dashboard montserrat-extra-bold-mongoose-20px">Dashboard</div></div>
          </a> <div class="overlap-group-item">
            <a href="profileu95admin.html"> <div class="link"></div></a>
            <div class="profile montserrat-extra-bold-mongoose-20px">Profile</div>
          </div>
          <div class="overlap-group2"><div class="property montserrat-extra-bold-mongoose-20px">Property</div></div>
          <div class="overlap-group9"><div class="landlord montserrat-extra-bold-mongoose-20px">Landlord</div></div>
          <a href="{{ route('admin.visitor') }}">  <div class="overlap-group7">
            <div class="tenant-visitor montserrat-extra-bold-mongoose-20px">Tenant &amp; Visitor</div>
          </div></a>
          <div class="overlap-group5"><div class="service montserrat-extra-bold-beaver-20px">Service</div></div>
          <div class="overlap-group-item">
            <a href="{{ route('admin.serviceProvider') }}"> <div class="link"></div></a>
            <div class="service-provider montserrat-extra-bold-mongoose-20px">Service Provider</div>
          </div>
          <div class="overlap-group-item">
            <a href="visitor.html"> <div class="link"></div></a>
            <div class="feedback montserrat-extra-bold-mongoose-20px">Feedback</div>
          </div>
          <div class="overlap-group10"><div class="log-out montserrat-extra-bold-mongoose-20px">Log out</div></div>
        </div>
        <div class="flex-col flex">
          <div class="flex-row flex">
            <div class="flex-col-1 flex-col-3">
              <h1 class="estate-ease_logo estate lexendzetta-medium-beaver-25px">SERVICES</h1>
              <div class="service-container">
                <a href="{{ route('admin.add_service') }}"
                  ><div class="add-services montserrat-bold-black-20px">ADD SERVICES</div> </a
                ><a href="{{ route('admin.service-requests') }}">
  <div class="check-service-requests montserrat-bold-black-20px">CHECK SERVICE REQUESTS</div>
</a>

              </div>
              <div class="list-of-services montserrat-semi-bold-black-20px">LIST OF SERVICES</div>
            </div>
            <div class="flex-row-1">
              <div class="total-properties montserrat-medium-black-16px">TOTAL SERVICES :</div>
              <div class="flex-col-2 flex-col-3">
                <a href="profileu95admin.html" class="align-self-flex-end"> <div class="head_pic"></div></a>
                <div class="total">
    {{ count($services) }}
</div>
              </div>
            </div>
          </div>
 <!-- Scrollable Table with Services -->
<div class="table-container">
    <table class="basic-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Picture</th>
                <th>Type</th>
                <th>Cost (৳)</th>
                <th>Description</th>
                <th>Action</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($services as $service)
            <tr>
                <td>{{ $service->id }}</td>
                <td>

                <img src="{{ asset($service->picture) }}" alt="{{ $service->type }}" class="service-img" />
                </td>
                <td>{{ $service->type }}</td>
                <td>৳{{ number_format($service->cost, 2) }}</td>
                <td>{{ $service->description }}</td>
                <td>
                    <!-- Edit button -->
                    <a href="" class="action-button">
                        <img src="{{ asset('img/edit.svg') }}" alt="Edit" class="icon" />
                    </a>

                    <!-- Delete button -->
                    <form action="" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')

                            <img src="{{ asset('img/trash-2.svg') }}" alt="Delete" class="icon" />
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

        </div>
      </div>
    </div>
  </body>
</html>
