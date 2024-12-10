<html>
  <head>
    <meta charset="utf-8" />
    <!--<meta name=description content="This site was generated with Anima. www.animaapp.com"/>-->
    <!-- <link rel="shortcut icon" type=image/png href="https://animaproject.s3.amazonaws.com/home/favicon.png" /> -->
    <meta name="viewport" content="width=1440, maximum-scale=1.0" />
    <link rel="shortcut icon" type="image/png" href="https://animaproject.s3.amazonaws.com/home/favicon.png" />
    <meta name="og:type" content="website" />
    <meta name="twitter:card" content="photo" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/visitor.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/globals.css') }}" />
  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="visitor" />
    <div class="container-center-horizontal">
      <div class="visitor screen">
        <div class="overlap-group">
          <div class="estate-ease estate lexendzetta-black-mongoose-20px">EstateEase</div>
          <div class="dashb-container">
            <a href="admin-dashboard.html"> <div class="link"></div></a>
            <div class="dashboard montserrat-extra-bold-mongoose-20px">Dashboard</div>
          </div>
          <div class="overlap-group6"><div class="profile montserrat-extra-bold-mongoose-20px">Profile</div></div>
          <div class="property-container">
            <a href="propertyu95listu95admin.html"> <div class="link"></div></a>
            <div class="property montserrat-extra-bold-mongoose-20px">Property</div>
          </div>
          <div class="overlap-group4"><div class="landlord montserrat-extra-bold-mongoose-20px">Landlord</div></div>
          <div class="overlap-group12">
            <div class="tenant-visitor tenant-1 montserrat-extra-bold-beaver-20px">Tenant &amp; Visitor</div>
          </div>
          <div class="overlap-group9">
            <div class="service service-1 montserrat-extra-bold-mongoose-20px">Service</div>
          </div>
          <div class="overlap-group5">
            <div class="service-1 montserrat-extra-bold-mongoose-20px">Service Provider</div>
          </div>
          <div class="overlap-group7"><div class="feedback montserrat-extra-bold-mongoose-20px">Feedback</div></div>
          <div class="overlap-group11"><div class="log-out montserrat-extra-bold-mongoose-20px">Log out</div></div>
        </div>
        <div class="flex-col flex">
          <div class="flex-row flex">
            <h1 class="estate-ease_logo estate lexendzetta-medium-beaver-25px">TENANT AND VISITOR</h1>
            <div class="head_pic"></div>
          </div>
          <div class="overlap-group1">

          <a href="{{ route('admin.tenant') }}">
    <div class="tenant_btn">
        <div class="tenant tenant-1">TENANT</div>
    </div>
</a>

            <div class="visitor_btn"></div>

            <div class="visitor-1">VISITOR</div>
          </div>

          <div class="flex-row-2 montserrat-medium-black-16px">
    <div class="total-properties">PENDING VISIT REQUESTS:</div>
    <div class="total">{{ $visitRequests->where('status', 'pending')->count() }}</div>
</div>


          <div class="list-of-visit-requests montserrat-semi-bold-black-20px">LIST OF VISIT REQUESTS</div>
          <div class="overlap-group3">
          <table class="visit_req_table">
    <thead>
        <tr class="visit_req_list_heading">
            <th>Visitor Name</th>
            <th>Phone</th>
            <th>Property ID</th>
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
                <td>{{ \Carbon\Carbon::parse($request->visit_date)->format('Y-m-d') }}</td> <!-- Format Date -->
                <td>{{ $request->visit_time }}</td>
                <td>{{ ucfirst($request->status) }}</td>

                <td>
                    <!-- Accept Button - Only show if status is not 'rejected' -->
                    @if($request->status !== 'rejected')
                        <form action="{{ route('admin.updateRequestStatus', [$request->id, 'accepted']) }}" method="POST" class="action-form">
                            @csrf
                            @method('PATCH')  <!-- Use PATCH method for the update -->
                            <button type="submit" class="accept-btn">Accept</button>
                        </form>
                    @endif
                </td>

                <td>
                    <!-- Reject Button - Only show if status is not 'rejected' -->
                    @if($request->status !== 'rejected')
                        <form action="{{ route('admin.updateRequestStatus', [$request->id, 'rejected']) }}" method="POST" class="action-form">
                            @csrf
                            @method('PATCH')  <!-- Use PATCH method for the update -->
                            <button type="submit" class="reject-btn">Reject</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>

<div class="list-of-potential-tenants montserrat-semi-bold-black-20px">LIST OF POTENTIAL TENANTS</div>

<div class="overlap-group2">
<table class="accepted_req_table">
    <thead>
        <tr class="accepted_req_list_heading">
            <th>Visitor Name</th>
            <th>Phone</th>
            <th>Property ID</th>
            <th>Visit Date</th>
            <th>Visit Time</th>
            <th>Status</th>
            <th>Remove Request</th>
            <th>Confirm to Rent</th>
        </tr>
    </thead>
    <tbody>
        @foreach($acceptedRequests as $request)
            <tr>
                <td>{{ $request->visitor->full_name ?? 'N/A' }}</td>
                <td>{{ $request->visitor->phone_number ?? 'N/A' }}</td>
                <td>{{ $request->property->property_ID ?? 'N/A' }}</td>
                <td>{{ \Carbon\Carbon::parse($request->visit_date)->format('Y-m-d') }}</td> <!-- Format Date -->
                <td>{{ $request->visit_time }}</td>
                <td>{{ ucfirst($request->status) }}</td>

                <td>
                    <!-- Remove Button -->
                    <form action="{{ route('admin.removeVisitRequest', $request->id) }}" method="POST" class="action-form" style="display: inline;">
                        @csrf
                        @method('PATCH')  <!-- Use PATCH method to update status or remove -->
                        <button type="submit" class="remove-btn">Remove</button>
                    </form>
                </td>

                <td>
                    <!-- Change to Tenant Button -->
                    <form action="{{ route('admin.changeToTenant', $request->id) }}" method="POST" class="action-form" style="display: inline;">
    @csrf
    @method('PATCH')  <!-- This tells Laravel to treat this as a PATCH request -->
    <button type="submit" class="tenant-btn">Change to Tenant</button>
</form>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger" id="payment-error">{{ session('error') }}</div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check if there's an error message in the session
        var errorMessage = document.getElementById('payment-error');

        if (errorMessage) {
            // Show a confirmation window with the error message
            alert(errorMessage.innerText);
        }
    });
</script>

        </div>
      </div>
    </div>
  </body>
</html>
