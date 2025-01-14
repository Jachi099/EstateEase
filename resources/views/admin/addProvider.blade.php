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


    <link rel="stylesheet" type="text/css" href="{{ asset('css/addu95serviceu95provideru95admin.css') }}" />

<link rel="stylesheet" type="text/css" href="{{ asset('css/styleguide.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('globals.css') }}" />
  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="addu95serviceu95provideru95admin" />
    <div class="container-center-horizontal">
      <div class="addu95serviceu95provideru95admin screen">
        <div class="overlap-group2">
          <div class="estate-ease estate lexendzetta-black-mongoose-20px">EstateEase</div>

          <a href="{{ route('admin.dashboard') }}"><div class="overlap-group15"><div class="dashboard montserrat-extra-bold-mongoose-20px">Dashboard</div></div>
          </a><div class="overlap-group2-item">
            <a href="profileu95admin.html"> <div class="link"></div></a>
            <div class="profile montserrat-extra-bold-mongoose-20px">Profile</div>
          </div>
          <div class="overlap-group9"><div class="property montserrat-extra-bold-mongoose-20px">Property</div></div>
          <div class="overlap-group13"><div class="landlord montserrat-extra-bold-mongoose-20px">Landlord</div></div>
          <a href="{{ route('admin.visitor') }}"> <div class="overlap-group11">
            <div class="tenant-visitor montserrat-extra-bold-mongoose-20px">Tenant &amp; Visitor</div>
          </div></a>
          <div class="overlap-group2-item">
            <a href="{{ route('admin.services') }}"> <div class="link"></div></a>
            <div class="service service-1 montserrat-extra-bold-mongoose-20px">Service</div>
          </div>
          <a href="{{ route('admin.serviceProvider') }}">
          <div class="overlap-group7">
            <div class="service-provider service-1 montserrat-extra-bold-beaver-20px">Service Provider</div>
          </div> </a>
          <div class="overlap-group2-item">
            <a href="visitor.html"> <div class="link"></div></a>
            <div class="feedback montserrat-extra-bold-mongoose-20px">Feedback</div>
          </div>
          <div class="overlap-group8"><div class="log-out montserrat-extra-bold-mongoose-20px">Log out</div></div>
        </div>
        <div class="flex-col flex">
          <div class="flex-row flex">
            <h1 class="estate-ease_logo estate lexendzetta-medium-white-25px">
              <span class="lexendzetta-medium-beaver-25px">SERVICE PROVIDER - </span
              ><span class="lexendzetta-medium-black-25px">ADD SERVICE PROVIDERS</span>
            </h1>
            <a href="profileu95admin.html"> <div class="head_pic"></div></a>
          </div>
          @if (session('success'))
    <div id="successModal" class="modal" style="display: block;">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>{{ session('success') }}</h2>
        </div>
    </div>
@endif
          <form action="{{ route('admin.storeProvider') }}" method="POST" enctype="multipart/form-data">
    @csrf


    <div class="flex-row-1 flex-row-3">
        <!-- Picture Preview -->
            <img src="#" alt="Profile Picture" id="profilePic" class="pic" />

        <!-- Form Fields -->
        <div class="flex-col-1">
            <!-- Full Name -->
            <div class="full-name montserrat-medium-black-16px">FULL NAME</div>
            <input type="text" class="name_txtbox" name="name" placeholder="Enter full name" required />

            <!-- Service Type -->
            <div class="service-type service-1 montserrat-medium-black-16px">SERVICE TYPE</div>
            <select class="sertype_txtbox" name="specialization" required>
                <option value="" disabled selected>Select service type</option>
                @foreach ($services as $service)
                    <option value="{{ $service->type }}">{{ $service->type }}</option>
                @endforeach
            </select>

            <!-- Email -->
            <div class="email-container">
                <div class="email montserrat-medium-black-16px">EMAIL</div>
                <input type="email" class="email_txtbox" name="email" placeholder="Enter email (optional)" />
            </div>

            <!-- Phone Number -->
            <div class="overlap-group5">
                <div class="phone-number montserrat-medium-black-16px">PHONE NUMBER</div>
                <input type="text" class="_txtbox" name="phone_number" placeholder="Enter phone number" required />
            </div>

            <!-- Service Area -->
            <div class="overlap-group">
                <div class="service-area service-1 montserrat-medium-black-16px">SERVICE AREA</div>
                <input type="text" class="_txtbox" name="address" placeholder="Enter service area" required />
            </div>



            <!-- Picture Upload -->
            <div class="flex-row-2 flex-row-3">
                <div class="add-picture montserrat-medium-black-16px">Add Picture</div>
                <input type="file" class="upload_pic" name="picture" accept="image/*" onchange="previewImage(event)" />
            </div>

            <!-- Submit Button -->
            <button type="submit" class="overlap-group1">ADD SERVICE PROVIDER</button>

            <div class="overlap-group6">
                <a href="{{ route('admin.serviceProvider') }}"> <div class="delete_btn"></div></a>
                <div class="go-back montserrat-black-beaver-16px">GO BACK</div>
              </div>
        </div>
    </div>
</form>

<script>
    function previewImage(event) {
        const img = document.getElementById('profilePic');
        img.src = URL.createObjectURL(event.target.files[0]);
        img.onload = () => URL.revokeObjectURL(img.src); // Free memory
    }

    var modal = document.getElementById('successModal');

// Get the <span> element that closes the modal
var span = document.getElementsByClassName('close-btn')[0];

// Close the modal when the user clicks on <span> (x)
span.onclick = function() {
    modal.style.display = "none";
}

// Close the modal after 5 seconds
setTimeout(function() {
    modal.style.display = "none";
}, 5000);  // Close after 5 seconds
</script>


        </div>
      </div>
    </div>
  </body>
</html>
