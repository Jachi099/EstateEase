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

    <link rel="stylesheet" type="text/css" href="{{ asset('css/tenant.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/globals.css') }}" />
  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="tenant" />
    <div class="container-center-horizontal">
      <div class="tenant screen">
      <div class="overlap-group">
          <div class="estate-ease estate lexendzetta-black-mongoose-20px">EstateEase</div>
          <div class="dashb-container">
            <a href="{{ route('admin.dashboard') }}"> <div class="link"></div></a>
            <div class="dashboard montserrat-extra-bold-mongoose-20px">Dashboard</div>
          </div>
          <div class="overlap-group6"><div class="profile montserrat-extra-bold-mongoose-20px">Profile</div></div>
          <div class="property-container">
            <a href="propertyu95listu95admin.html"> <div class="link"></div></a>
            <div class="property montserrat-extra-bold-mongoose-20px">Property</div>
          </div>
          <div class="overlap-group4"><div class="landlord montserrat-extra-bold-mongoose-20px">Landlord</div></div>
          <div class="overlap-group12">
            <div class="tenant-visitor montserrat-extra-bold-beaver-20px">Tenant &amp; Visitor</div>
          </div>
          <a href="{{ route('admin.services') }}"> <div class="overlap-group9">
            <div class="service service-1 montserrat-extra-bold-mongoose-20px">Service</div>
          </div></a>
          <a href="{{ route('admin.serviceProvider') }}"> <div class="overlap-group5">
            <div class="service-1 montserrat-extra-bold-mongoose-20px">Service Provider</div>
          </div></a>
          <div class="overlap-group7"><div class="feedback montserrat-extra-bold-mongoose-20px">Feedback</div></div>
          <div class="overlap-group11"><div class="log-out montserrat-extra-bold-mongoose-20px">Log out</div></div>
        </div>
        <div class="flex-col flex">
          <div class="flex-row flex">
            <h1 class="estate-ease_logo estate lexendzetta-medium-beaver-25px">TENANT AND VISITOR</h1>
            <a href="profileu95admin.html"> <div class="head_pic"></div></a>
          </div>
          <div class="overlap-group2">

            <div class="tenant_btn">  <div class="tenant-1">TENANT</div>
            </div>

            <a href="{{ route('admin.visitor') }}">
            <div class="visitor_btn"> </div>
            <div class="visitor">VISITOR</div>
            </a>
          </div>
          <div class="flex-row-2 montserrat-medium-black-16px">
                    <div class="total-properties">TOTAL VISIT REQUESTS:</div>
                    <div class="total">{{ $visitRequests->count() }}</div>

                  </div>

          <div class="list-of-visit-requests montserrat-semi-bold-black-20px">LIST OF VISIT REQUESTS</div>
          <div class="overlap-group3">

          <table class="visit_req_table">

             <thead>
                      <tr class="visit_req_list_heading">
                          <th>Visitor Name</th>
                          <th>Phone</th>
                          <th>Property Address</th>
                          <th>Visit Date</th>
                          <th>Visit Time</th>
                          <th>Status</th>
                          <th>Accept Request</th>
                          <th>Decline Request</th>
                      </tr>
                  </thead>
          <tbody>
                      @foreach($visitRequests as $request)
                          <tr>
                              <td>{{ $request->visitor->full_name ?? 'N/A' }}</td>
                              <td>{{ $request->visitor->phone_number ?? 'N/A' }}</td>
                              <td>{{ $request->property->property_ID ?? 'N/A' }}</td>
                              <td>{{ $request->visit_date }}</td>
                              <td>{{ $request->visit_time }}</td>
                              <td>{{ ucfirst($request->status) }}</td>

                              <td>
                                  <form action="{{ route('admin.updateRequestStatus', [$request->id, 'accepted']) }}" method="POST" class="action-form">
                                      @csrf
                                      @method('PATCH')
                                      <button type="submit" class="accept-btn">Accept</button>
                                  </form>

                              </td>
                              <td>
                                <form action="{{ route('admin.updateRequestStatus', [$request->id, 'rejected']) }}" method="POST" class="action-form">
                                  @csrf
                                  @method('PATCH')
                                  <button type="submit" class="reject-btn">Reject</button>
                              </form>
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
                  </table>

                  </div>
          <div class="list-of-tenants montserrat-semi-bold-black-20px">LIST OF TENANTS</div>
          <div class="overlap-group3">
            <div class="visit_accept_heading"></div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
