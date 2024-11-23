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
  

    <link rel="stylesheet" type="text/css" href="{{ asset('css1/visitu95dashboardu95edit.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/globals.css') }}" />
  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="visitu95dashboardu95edit" />
    <div class="container-center-horizontal">
      <div class="visitu95dashboardu95edit screen">
     
        <div class="navbar-link-container">
            <div class="navbar-link-estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
     <a href="{{ route('visitor.user_home') }}"><div class="navbar-link-place navbar-link montserrat-normal-black-16px">Home</div> </a
      ><a href="{{ route('visitor.user_home') }}"><div class="navbar-link-about navbar-link montserrat-normal-black-16px">About</div> </a
      >  <a href="{{ route('visitor.property_list') }}"><div class="navbar-link-properties montserrat-normal-black-16px">Properties</div> </a
        > 
        
      
      
        <a href="{{ route('visitor.profile') }}"><div class="head_pic">
            @if($profilePicture)
                <img src="{{ asset('storage/' . $profilePicture) }}" alt="User Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
            @else
                <img src="path/to/default/image.png" alt="Default Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
            @endif
        </div>
        
    </a>

        </div>


        <div class="flex-col flex">
          <div class="flex-row flex">
            <div class="flex-col-1 flex-col-7">
              <div class="flex-row-1">
                <h1 class="estate-ease_logo lexendzetta-medium-beaver-25px">VISITOR DASHBOARD</h1>
                <img class="trash-2" src="{{ asset('img/trash-2.svg') }}" alt="trash-2" />
            </div>


            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
            
                <div class="flex-row-2">
                    <div class="flex-col-2 flex-col-7">
                        <div class="pic"> @if($profilePicture)
                            <img src="{{ asset('storage/' . $profilePicture) }}" alt="User Profile Picture" style="width: 100%; height: 100%; ">
                        @else
                            <img src="path/to/default/image.png" alt="Default Profile Picture" style="width: 100%; height: 100%; ">
                        @endif</div>

                        </div>
                    <div class="flex-col-3 flex-col-7">
                        <div class="full-name montserrat-medium-black-16px">FULL NAME</div>
                        <input type="text" class="name_txtbox" name="full_name" id="full_name" value="{{ old('full_name', $user->full_name) }}" />
                    
                      <div class="current-address montserrat-medium-black-16px">CURRENT ADDRESS</div>
                      <input type="text" class="address_txtbox" name="current_address" id="current_address" value="{{ old('current_address', $user->current_address) }}" />
                      <div class="phone-number montserrat-medium-black-16px">PHONE NUMBER</div>
                      <input type="text" class="phn_txtbox" name="phone_number" id="phone_number" value="{{ old('phone_number', $user->phone_number) }}" />

                    </div>
                  </div>
                </div>

                <div class="flex-col-4 flex-col-7">
                    <div class="email montserrat-medium-black-16px">EMAIL</div>
                    <input type="email" class="email_txtbox" name="email" id="email" value="{{ old('email', $user->email) }}" />

                    <div class="pass-container">
                      <div class="password montserrat-medium-black-16px">PASSWORD</div>
                      <input type="password" class="pass_txtbox pass_txtbox-2" name="password" id="password" />

                    </div>
                    <div class="pass-container-1">
                      <div class="password montserrat-medium-black-16px">RE-TYPE PASSWORD</div>
                      <input type="password" class="pass_txtbox-1 pass_txtbox-2" name="password_confirmation" id="password_confirmation" />

                    </div>
                  </div>

            
                </div>

                 
          <div class="flex-row-3">
            <div class="flex-col-5 flex-col-7">
              <div class="add-picture montserrat-medium-black-16px">ADD PICTURE</div>
            </div>
            <div class="flex-col-6 flex-col-7">
              <input type="file" name="picture" class="upload_pic" id="picture" />

              <button type="submit" class="overlap-group4"> 
                <div class="update-profile">UPDATE PROFILE</div>
              </button>
              <div class="back-container">
                <a href="{{ route('visitor.profile') }}"> <div class="go_back"> 
                    <div class="go-back">GO BACK</div>
                </div></a>
              </div>
            </div>
          </div>
            
            
            
            </form>

            
           
       
        </div>
      </div>
    </div>
  </body>
</html>
