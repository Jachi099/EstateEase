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
     <a href="{{ route('landlord.user_home') }}"><div class="navbar-link-place navbar-link montserrat-normal-black-16px">Home</div> </a
      ><a href="{{ route('landlord.user_home') }}"><div class="navbar-link-about navbar-link montserrat-normal-black-16px">About</div> </a
      >  <a href="{{ route('landlord.properties_list') }}"><div class="navbar-link-properties montserrat-normal-black-16px">Properties</div> </a
        > 
        
      
      
        <a href="{{ route('landlord.profile') }}">
    <div class="head_pic">
        @if($profilePicture)
            <img src="{{ asset($profilePicture) }}" alt="User Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
        @else
            <img src="{{ asset('path/to/default/image.png') }}" alt="Default Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
        @endif
    </div>
</a>


        </div>


        <div class="flex-col flex">
          <div class="flex-row flex">
            <div class="flex-col-1 flex-col-7">
              <div class="flex-row-1">
                <h1 class="estate-ease_logo lexendzetta-medium-beaver-25px">TENANT DASHBOARD</h1>
                <img class="trash-2" src="{{ asset('img/trash-2.svg') }}" alt="trash-2" onclick="deleteProfile()" style="background-color: rgba(255, 0, 0, 0.5);" />
                </div>


            <form action="{{ route('landlord.update_profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
            
                <div class="flex-row-2">
                    <div class="flex-col-2 flex-col-7">
                    <div class="pic">      @if($profilePicture)
            <img src="{{ asset($profilePicture) }}" alt="User Profile Picture" style="width: 100%; height: 100%;">
        @else
            <img src="{{ asset('path/to/default/image.png') }}" alt="Default Profile Picture" style="width: 100%; height: 100%;">
        @endif
  </div>


                        </div>
                    <div class="flex-col-3 flex-col-7">
                        <div class="full-name montserrat-medium-black-16px">FULL NAME</div>
                        <input type="text" class="name_txtbox" name="full_name" id="full_name" value="{{ old('full_name', $landlord->name) }}" />
                    
                      <div class="current-address montserrat-medium-black-16px">CURRENT ADDRESS</div>
                      <input type="text" class="address_txtbox" name="current_address" id="current_address" value="{{ old('current_address', $landlord->current_address) }}" />
                      <div class="phone-number montserrat-medium-black-16px">PHONE NUMBER</div>
                      <input type="text" class="phn_txtbox" name="phone_number" id="phone_number" value="{{ old('phone_number', $landlord->phone) }}" />

                    </div>
                  </div>
                </div>

                <div class="flex-col-4 flex-col-7">
                    <div class="email montserrat-medium-black-16px">EMAIL</div>
                    <input type="email" class="email_txtbox" name="email" id="email" value="{{ old('email', $landlord->email) }}" />

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
                <a href="{{ route('landlord.profile') }}"> <div class="go_back"> 
                    <div class="go-back">GO BACK</div>
                </div></a>
              </div>
            </div>
          </div>
            
            
            
            </form>

            
           
       
        </div>
      </div>
    </div>
<script>
    function deleteProfile() {
        if (confirm('Are you sure you want to delete your profile? This action cannot be undone.')) {
            // Send AJAX request to delete the profile
            fetch('{{ route('profile.delete') }}', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    // Redirect or perform further actions if needed
                    window.location.href = '/';  // Redirect to the homepage or another page
                } else {
                    alert(data.message); // Show the error message if payment is confirmed
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again later.');
            });
        }
    }
</script>



  </body>
</html>
