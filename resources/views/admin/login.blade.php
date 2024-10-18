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
    <link rel="stylesheet" type="text/css" href="css/adminu95login.css" />
    <link rel="stylesheet" type="text/css" href="css/styleguide.css" />
    <link rel="stylesheet" type="text/css" href="css/globals.css" />

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
            <h2>Admin Login</h2>

            @if($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Email Textbox -->
            <div class="email_txtbox">
                <label for="email">Email</label>
                <input type="email" name="email" required>
            </div>

            <!-- Password Textbox -->
            <div class="pass_txtbox">
                <label for="password">Password</label>
                <input type="password" name="password" required>
            </div>

            <!-- Login Button -->
            <div class="login_btn">
                <button type="submit">
                    <div class="log-in montserrat-black-white-16px">LOG IN</div>
                </button>
            </div>
        </form>

          <div class="forgot-password">Forgot password?</div>
    
          <div class="pass_warnings">*</div>
          <div class="email_warnings">*</div>
          <div class="password montserrat-medium-black-16px">PASSWORD</div>
        
          <div class="login_logo">LOG IN</div>
          <div class="email montserrat-medium-black-16px">EMAIL</div>
        </div>
      </div>
    </div>
  </body>
</html>
