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

    <link rel="stylesheet" type="text/css" href="{{ asset('css/profileu95admin.css') }}" />

<link rel="stylesheet" type="text/css" href="{{ asset('css/styleguide.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/globals.css') }}" />
  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="profileu95admin" />
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

            <div class="overlap-group8">
              <a href="">
                <div class="link"></div>
            </a>
              <div class="property montserrat-extra-bold-beaver-20px">Property</div>

          </div>

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
          <div class="flex-row flex">
            <h1 class="estate-ease_logo estate lexendzetta-medium-beaver-25px">EDIT PROFILE</h1>
          </div>
        

<div class="flex-row-1 flex-row-3">
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="flex-col-1">

            <div class="email montserrat-medium-black-16px">EMAIL</div>
            
                <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="email_txtbox" required>
   
            @error('email')
                <div class="email_warnings montserrat-medium-black-14px text-red-500">{{ $message }}</div>
            @enderror

            <div class="pass-container">
                <div class="password montserrat-medium-black-16px">PASSWORD</div>
          
                    <input type="password" name="password" class="pass_txtbox">
     
            </div>

            <div class="pass-container-1">
                <div class="password montserrat-medium-black-16px">RE-TYPE PASSWORD</div>
        
                    <input type="password" name="password_confirmation" class="repass_txtbox">

            </div>
            @error('password')
                <div class="pass_warnings montserrat-medium-black-14px text-red-500">{{ $message }}</div>
            @enderror


        
                <button type="submit" class="overlap-group2">
                    UPDATE PROFILE
                </button>
    
        </div>
    </form>
</div>


        </div>
      </div>
    </div>
  </body>
</html>