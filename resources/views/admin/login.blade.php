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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/adminu95login.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/globals.css') }}" />
    
    

    <title>EstateEase-Admin</title>
  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="adminu95login" />
    <div class="container-center-horizontal">
      <div class="adminu95login screen">
        <div class="overlap-group">
          <div class="div_pic"></div>
          <h1 class="estate-ease_logo">EstateEase</h1>
          <div class="estate-ease_logo-1 estate-ease_logo-3">EstateEase</div>
          <div class="estate-ease_logo-2 estate-ease_logo-3">EstateEase</div>
          <div class="middle_box"></div>

          <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="login_logo">LOG IN</div>
        
            @if($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif
        
            <!-- Email Textbox -->
            <div class="email montserrat-medium-black-16px">EMAIL</div>
            <input type="email" class="email_txtbox" name="email" value="{{ old('email') }}" required>
            <div class="email_warnings">
                @error('email')
                    {{ $message }} <!-- This will show the error for email -->
                @enderror
            </div>
        
            <!-- Password Textbox -->
            <div class="password montserrat-medium-black-16px">PASSWORD</div>
            <input type="password" class="pass_txtbox" name="password" required>
            <div class="pass_warnings">
                @error('password')
                    {{ $message }} <!-- This will show the error for password -->
                @enderror
            </div>
        
            <!-- Login Button -->
            <button type="submit" class="login_btn">
                LOG IN
            </button>
        
            <div class="forgot-password">Forgot password?</div>
        </form>
        
    
        
        </div>
      </div>
  </body>
</html>
