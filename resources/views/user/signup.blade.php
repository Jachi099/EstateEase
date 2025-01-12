<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>EstateEase - SignUp</title> <!-- Website's Name in the Tab -->
    <link rel="icon" href="{{ asset('storage/favicon.ico') }}" type="image/x-icon">

    <!--<meta name=description content="This site was generated with Anima. www.animaapp.com"/>-->
    <!-- <link rel="shortcut icon" type=image/png href="https://animaproject.s3.amazonaws.com/home/favicon.png" /> -->
    <meta name="viewport" content="width=1440, maximum-scale=1.0" />
    <link rel="shortcut icon" type="image/png" href="https://animaproject.s3.amazonaws.com/home/favicon.png" />
    <meta name="og:type" content="website" />
    <meta name="twitter:card" content="photo" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/signup.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/globals.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="signup" />
    <div class="container-center-horizontal">
      <div class="signup screen">
        <div class="navbar-link-container">
          <div class="navbar-link-estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
          <a href="{{ route('public.home') }}"><div class="navbar-link-place montserrat-normal-black-16px">Home</div> </a
            ><a href="{{ route('public.home') }}"><div class="navbar-link-about montserrat-normal-black-16px">About</div> </a
            > <a href="{{ route('user.properties') }}">
              <div class="navbar-link-properties montserrat-normal-black-16px">Properties</div> </a
            > <a href="{{ route('user.service') }}"><div class="navbar-link-services montserrat-normal-black-16px">Services</div> </a
            >  <a href="{{ route('admin.login') }}"><div class="navbar-link-sign-up montserrat-normal-black-16px">ADMIN</div> </a>
        </div>
        <div class="overlap-group">
          <img class="all-room-header-1" src="img/all-room-header-1-1.png" alt="All-Room-Header 1" />
          <div class="div_pic"></div>


          <div class="middle_box"></div>


          <div class="already-have-an-account">ALREADY HAVE AN ACCOUNT?</div>
          <a href="{{ route('user.login') }}" > <div class="login montserrat-bold-black-12px">LOGIN</div>
          </a>
          <h1 class="estate-ease_logo">SIGN UP</h1>
          <p class="you-will-become-ten">*You will become tenant only if the admin approves.</p>

          @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif




      <form action="{{ route('user.signup.submit') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Full Name -->
    <div class="full-name montserrat-medium-black-16px">FULL NAME</div>
    <input type="text" id="full_name" class="name_txtbox"
           name="full_name" value="{{ old('full_name') }}"
           title="Enter your full name" required>
    @error('full_name')<span>{{ $message }}</span>@enderror

    <!-- Current Address -->
    <div class="current-address montserrat-medium-black-16px">CURRENT ADDRESS</div>
    <input type="text" id="current_address" class="address_txtbox"
           name="current_address" value="{{ old('current_address') }}"
           title="Enter your current address" required>
    @error('current_address')<span>{{ $message }}</span>@enderror

    <!-- Phone Number -->
    <div class="phone-number montserrat-medium-black-16px">PHONE NUMBER</div>
    <input type="tel" id="phone_number" class="phn_txtbox"
           name="phone_number" value="{{ old('phone_number') }}"
           title="Enter a valid phone number (e.g., +123456789)" required>
    @error('phone_number')<span>{{ $message }}</span>@enderror

    <!-- Account Type -->
    <div class="account-type montserrat-medium-black-16px">ACCOUNT TYPE</div>
    <input type="radio" name="account_type" class="radio1" value="landlord" required>
    <div class="landlord montserrat-medium-black-14px">LANDLORD</div>
    <input type="radio" name="account_type" class="radio2" value="visitor" required>
    <div class="visitor montserrat-medium-black-14px">VISITOR</div>
    @error('account_type')<span>{{ $message }}</span>@enderror

    <!-- Email -->
    <div class="email montserrat-medium-black-16px">EMAIL</div>
    <input type="email" id="email" class="email_txtbox"
           name="email" value="{{ old('email') }}"
           title="Enter a valid email address (e.g., user@example.com)" required>
    @error('email')<span>{{ $message }}</span>@enderror

    <!-- Password -->
    <div class="password-1 password-2 montserrat-medium-black-16px">PASSWORD</div>
    <input type="password" class="pass_txtbox-1 pass_txtbox-3" id="password"
           name="password" title="Must include: 1 capital letter, 1 special character, 1 number, and be at least 8 characters long" required>
    @error('password')<span>{{ $message }}</span>@enderror

    <!-- Confirm Password -->
    <div class="re-type-password montserrat-medium-black-16px">RE-TYPE PASSWORD</div>
    <input type="password" id="password_confirmation" class="pass_txtbox-2 pass_txtbox-3"
           name="password_confirmation" title="Re-enter the same password" required>

    <!-- Profile Picture -->
    <div class="add-picture montserrat-medium-black-16px">ADD PICTURE</div>
    <input type="file" id="picture" class="upload_pic" name="picture"
           accept="image/*" title="Upload your profile picture (jpeg,png,jpg|max:2048)" required>
    @error('picture')<span>{{ $message }}</span>@enderror

    <!-- Submit Button -->
    <button type="submit" class="sign_up_btn">SIGN UP</button>
</form>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

        </div>
      </div>
    </div>




  </body>
</html>
