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
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/signup.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/globals.css') }}" />

  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="signup" />
    <div class="container-center-horizontal">
      <div class="signup screen">
        <div class="navbar-link-container">
          <div class="navbar-link-estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
          <a href="{{ route('public.home') }}"><div class="navbar-link-place montserrat-normal-black-16px">Home</div> </a
            ><a href="{{ route('public.home') }}"><div class="navbar-link-about montserrat-normal-black-16px">About</div> </a
            ><a href="propertyu95detailsu95guest.html#propertyu95listu95foru95guest" data-turbolinks="false"
              ><div class="navbar-link-properties montserrat-normal-black-16px">Properties</div> </a
            > <a href="{{ route('user.service') }}"><div class="navbar-link-services montserrat-normal-black-16px">Services</div> </a
            ><a href="#div_top"><div class="navbar-link-sign-up montserrat-normal-black-16px">Sign Up</div> </a>
        </div>
        <div class="overlap-group">
          <img class="all-room-header-1" src="img/all-room-header-1-1.png" alt="All-Room-Header 1" />
          <div class="div_pic"></div>

    
          <div class="middle_box"></div>
        
          
          <div class="already-have-an-account">ALREADY HAVE AN ACCOUNT?</div>
          <div class="login montserrat-bold-black-12px">LOGIN</div>
        
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
    
            <div class="full-name montserrat-medium-black-16px">FULL NAME</div>

            <input type="text" id="full_name" class="name_txtbox"
             name="full_name" value="{{ old('full_name') }}" required><br><br>
            @error('full_name')<span>{{ $message }}</span>@enderror

            <div class="current-address montserrat-medium-black-16px">CURRENT ADDRESS</div>

            <input type="text" id="current_address" class="address_txtbox"
             name="current_address" value="{{ old('current_address') }}" required><br><br>
            @error('current_address')<span>{{ $message }}</span>@enderror
    
            <div class="phone-number montserrat-medium-black-16px">PHONE NUMBER</div>

            <input type="tel" id="phone_number" class="phn_txtbox" name="phone_number" value="{{ old('phone_number') }}" required><br><br>
            @error('phone_number')<span>{{ $message }}</span>@enderror
    
            <div class="account-type montserrat-medium-black-16px">ACCOUNT TYPE</div>

            <input type="radio" name="account_type" class="radio1"
            value="landlord" required>    <div class="landlord montserrat-medium-black-14px ">LANDLORD</div>

            <input type="radio"  name="account_type"  class="radio2"
            value="visitor" required> 
            <div class="visitor montserrat-medium-black-14px ">VISITOR</div><br><br>
            @error('account_type')<span>{{ $message }}</span>@enderror
    
            <div class="email montserrat-medium-black-16px">EMAIL</div>

            <input type="email" id="email" class="email_txtbox" name="email" value="{{ old('email') }}" required><br><br>
            @error('email')<span>{{ $message }}</span>@enderror
    
            <div class="password-1 password-2 montserrat-medium-black-16px">PASSWORD</div>

            <input type="password" class="pass_txtbox-1 pass_txtbox-3" id="password" name="password" required><br><br>
            @error('password')<span>{{ $message }}</span>@enderror
    
            <div class="re-type-password montserrat-medium-black-16px">RE-TYPE PASSWORD</div>

            <input type="password" id="password_confirmation" class="pass_txtbox-2 pass_txtbox-3" 
            name="password_confirmation" required><br><br>
    
            <div class="add-picture montserrat-medium-black-16px">ADD PICTURE</div>
            
            <input type="file" id="picture" class="upload_pic" name="picture" accept="image/*" required><br><br>
            @error('picture')<span>{{ $message }}</span>@enderror
    
            <button type="submit" class="sign_up_btn">SIGN UP</button>
        </form>
        </div>
      </div>
    </div>
  </body>
</html>
