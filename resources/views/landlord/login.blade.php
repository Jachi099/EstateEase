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

    <link rel="stylesheet" type="text/css" href="{{ asset('css_landlord/login.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css_landlord/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css_landlord/globals.css') }}" />
  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="login" />
    <div class="container-center-horizontal">
      <div class="login screen">
        <div class="navbar-link-container">
          <div class="navbar-link-estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
          <a href="{{ route('public.home') }}"><div class="navbar-link-place montserrat-normal-black-16px">Home</div> </a
            ><a href="{{ route('public.home') }}"><div class="navbar-link-about montserrat-normal-black-16px">About</div> </a
            ><a href="propertyu95detailsu95guest.html#propertyu95listu95foru95guest" data-turbolinks="false"
            ><div class="navbar-link-properties montserrat-normal-black-16px">Properties</div> </a
          > <a href="{{ route('user.service') }}"><div class="navbar-link-services montserrat-normal-black-16px">Services</div> </a
          ><a href="{{ route('user.signup') }}"><div class="navbar-link-sign-up montserrat-normal-black-16px">Sign Up</div> </a>
        </div>
        <div class="overlap-group1">
          <img class="all-room-header-1" src="img/all-room-header-1-1.png" alt="All-Room-Header 1" />
          <div class="div_pic"></div>
          <div class="middle_box"></div>



    @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form action="{{ route('landlord.login.submit') }}" method="POST">
    @csrf
    <div class="mb-3">
        <div class="email montserrat-medium-black-16px">EMAIL</div>
        <input type="email" class="email_txtbox" name="email" id="email" required class="form-control" />
    </div>
    <div class="mb-3">
        <div class="password montserrat-medium-black-16px">PASSWORD</div>
        <input type="password" class="pass_txtbox" name="password" id="password" required class="form-control" />
    </div>
    <button type="submit" class="login_btn"><div class="log-in">LOG IN</div></button>
    <a href="{{ route('landlord.signup') }}" class="sign_up_btn"><div class="sign-up">SIGN UP</div></a>
</form>

          <div class="forgot-password">Forgot password?</div>
          <h1 class="estate-ease_logo">LOG IN</h1>
        </div>
      </div>
    </div>
  </body>
</html>
