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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/servicerequ95admin.css') }}" />

<link rel="stylesheet" type="text/css" href="{{ asset('css/styleguide.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('globals.css') }}" />
  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="servicerequ95admin" />
    <div class="container-center-horizontal">
      <div class="servicerequ95admin screen">
        <div class="overlap-group">
          <div class="estate-ease estate lexendzetta-black-mongoose-20px">EstateEase</div>
          <a href="{{ route('admin.dashboard') }}"> <div class="overlap-group10"><div class="dashboard montserrat-extra-bold-mongoose-20px">Dashboard</div></div>
          </a>  <div class="overlap-group-item">
            <a href="profileu95admin.html"> <div class="link"></div></a>
            <div class="profile montserrat-extra-bold-mongoose-20px">Profile</div>
          </div>
          <div class="overlap-group6"><div class="property montserrat-extra-bold-mongoose-20px">Property</div></div>
          <div class="overlap-group4"><div class="landlord montserrat-extra-bold-mongoose-20px">Landlord</div></div>
          <a href="{{ route('admin.visitor') }}"><div class="overlap-group8">
            <div class="tenant-visitor montserrat-extra-bold-mongoose-20px">Tenant &amp; Visitor</div>
          </div></a>
          <a href="{{ route('admin.services') }}"><div class="overlap-group12">
            <div class="service service-1 montserrat-extra-bold-beaver-20px">Service</div>
          </div></a>
          <div class="overlap-group-item">
            <a href="{{ route('admin.serviceProvider') }}"> <div class="link"></div></a>
            <div class="service-provider service-1 montserrat-extra-bold-mongoose-20px">Service Provider</div>
          </div>
          <div class="overlap-group-item">
            <a href="visitor.html"> <div class="link"></div></a>
            <div class="feedback montserrat-extra-bold-mongoose-20px">Feedback</div>
          </div>
          <div class="overlap-group5"><div class="log-out montserrat-extra-bold-mongoose-20px">Log out</div></div>
        </div>
        <div class="flex-col">
          <div class="flex-row">
            <div class="flex-col-1 flex-col-3">
              <h1 class="estate-ease_logo estate lexendzetta-medium-white-25px">
                <span class="lexendzetta-medium-beaver-25px">SERVICES - </span
                ><span class="lexendzetta-medium-black-25px">SERVICE REQUESTS</span>
              </h1>
              <p class="list-of-pending-services-requests montserrat-semi-bold-black-20px">
                LIST OF PENDING SERVICES REQUESTS
              </p>
            </div>
            <div class="sort montserrat-medium-black-16px">SORT:</div>
            <div class="flex-col-2 flex-col-3">
              <a href="profileu95admin.html" class="align-self-flex-end"> <div class="head_pic"></div></a>
              <div class="sort-1"></div>
            </div>
          </div>

          <div class="overlap-group3">
    <table class="table">
        <thead>
            <tr>
                <th>Property</th>
                <th>Service Type</th>
                <th>Description</th>
                <th>Cost</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($pendingRequests->isEmpty())
                <tr>
                    <td colspan="8" class="text-center montserrat-regular-black-16px">No pending service requests available.</td>
                </tr>
            @else
                @foreach($pendingRequests as $request)
                    <tr>
                        <td>
                            {{ $request->property->floor ?? 'N/A' }} Floor,
                            {{ $request->property->house_no ?? 'N/A' }},
                            {{ $request->property->area ?? 'N/A' }}
                        </td>
                        <td>{{ $request->service->type ?? 'N/A' }}</td>
                        <td>{{ $request->description ?? 'N/A' }}</td>
                        <td>{{ $request->total_cost }}</td>
                        <td>{{ \Carbon\Carbon::parse($request->requested_date)->format('d M, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($request->requested_date)->format('H:i') }}</td>
                        <td><span class="badge badge-warning">Pending</span></td>
                        <td>
                            <!-- Assign Provider -->
                            @if(!$request->service_provider_id)
                                <form action="{{ route('admin.service-request.assign', $request->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <select name="provider_id" class="form-control" required>
                                            <option value="" disabled selected>Select Provider</option>
                                            @foreach($providers as $provider)
                                                <option value="{{ $provider->id }}">
                                                    {{ $provider->name }} - {{ $provider->phone_number }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Assign</button>
                                </form>
                            @else
                                <!-- Approve/Reject -->
                                <form action="{{ route('admin.service-request.update', $request->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                </form>
                            @endif

                            <!-- Reject Button (always visible) -->
                            <form action="{{ route('admin.service-request.update', $request->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>





<div class="history-of-services-requests montserrat-semi-bold-black-20px">HISTORY OF SERVICES REQUESTS</div>

<!-- Completed Requests Table -->
<div class="overlap-group2">
    <table class="table">
        <thead>
            <tr>
                <th>Property</th>
                <th>Service Type</th>
                <th>Description</th>
                <th>Cost</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @if($completedRequests->isEmpty())
                <tr>
                    <td colspan="7" class="text-center montserrat-regular-black-16px">No completed service requests available.</td>
                </tr>
            @else
                @foreach($completedRequests as $request)
                    <tr>
                        <td>{{ $request->property->floor ?? 'N/A' }}, {{ $request->property->house_no ?? 'N/A' }}, {{ $request->property->area ?? 'N/A' }}</td>
                        <td>{{ $request->service->type ?? 'N/A' }}</td>
                        <td>{{ $request->description ?? 'N/A' }}</td>
                        <td>{{ $request->total_cost }}</td>
                        <td>{{ \Carbon\Carbon::parse($request->requested_date)->format('d M, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($request->requested_date)->format('H:i') }}</td>
                        <td>
                            @if($request->status === 'approved')
                                <span class="badge badge-success">Approved</span>
                            @elseif($request->status === 'rejected')
                                <span class="badge badge-danger">Rejected</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>


          <div class="back-container">
            <a href="{{ route('admin.services') }}"> <div class="goback_btn"></div></a>
            <div class="go-back montserrat-black-white-16px">GO BACK</div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
