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
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/serviceu95listu95foru95guest.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/globals.css') }}" />

  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="serviceu95listu95foru95guest" />
    <div class="container-center-horizontal">
      <div class="serviceu95listu95foru95guest screen">

      <div class="flex-col flex">

      <div class="navbar">
          <div class="navbar-link-estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
          <a href="{{ route('public.home') }}">
            <div class="navbar-link-place montserrat-normal-black-16px">Home</div>
        </a>
        <a href="{{ route('public.home') }}">
            <div class="navbar-link-about montserrat-normal-black-16px">About</div>
        </a>

            <a href="{{ route('user.properties') }}">
                <div class="navbar-link-properties montserrat-normal-black-16px">Properties</div>
            </a>
            <a href="{{ route('user.service') }}">
                <div class="navbar-link-services montserrat-normal-black-16px">Services</div>
            </a>

        <a href="{{ route('admin.login') }}">
            <div class="navbar-link-sign-up montserrat-normal-black-16px">ADMIN</div>
        </a>

        </div>
        <h1 class="estate-ease_logo lexendzetta-medium-beaver-25px">SERVICES</h1>
        <div class="flex-row">

        <form action="{{ route('user.service') }}" method="GET" class="search-form">
    <input type="text" class="search-12" name="query" placeholder="Search for a service">
    <button class="search-container11" type="submit">
        <div class="search-21 montserrat-black-white-16px">SEARCH</div>
    </button>
</form>




          <div class="total-container2">
            <div class="total-services montserrat-medium-black-16px">TOTAL SERVICES :</div>
            <div class="total12">
    {{ $serviceCount }}
</div>

          </div>
        </div>
      </div>

        <div class="flex-col">

        <div class="overlap-group">
        @if($serviceCount > 0)
    @foreach($services as $service)

            <div class="card12">
                <div class="text12 lexendzetta-bold-mongoose-20px">{{ $service->type }}</div>
                <img class="service_pic1" src="{{ asset('img/'.$service->picture) }}" alt="service_pic">
                <p class="text22 montserrat-medium-black-14px">{{ $service->description }}</p>
            </div>
    @endforeach
@else
    <p>No services found for "{{ request()->get('query') }}"</p>
@endif
</div>

        </div>
      </div>
    </div>
  </body>
</html>
