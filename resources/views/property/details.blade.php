<html>
  <head>
    <meta charset="utf-8" />
    <!--<meta name=description content="This site was generated with Anima. www.animaapp.com"/>-->
    <!-- <link rel="shortcut icon" type=image/png href="https://animaproject.s3.amazonaws.com/home/favicon.png" /> -->
    <meta name="viewport" content="width=1440, maximum-scale=1.0" />
    <link rel="shortcut icon" type="image/png" href="https://animaproject.s3.amazonaws.com/home/favicon.png" />
    <meta name="og:type" content="website" />
    <meta name="twitter:card" content="photo" />

 
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/visit-request.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/globals.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/propertyu95details.css') }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            display: none; /* Initially hidden */
        }

        .overlay-content {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 80%;
            max-width: 600px;
        }

        .close {
            cursor: pointer;
            float: right;
            font-size: 20px;
        }
    </style>
  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="propertyu95details" />
    <div class="container-center-horizontal">
      <div class="propertyu95details screen">
        <div class="flex-col">
          <div class="navbar navbar-2">
            <div class="navbar-link-estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
            <a href="{{ route('visitor.user_home') }}">
              <div class="navbar-link-place navbar-link montserrat-normal-black-16px">Home</div> </a
            ><a href="{{ route('visitor.user_home') }}">
              <div class="navbar-link-about navbar-link montserrat-normal-black-16px">About</div>
            </a>
           
            <a href="{{ route('user.properties_list') }}"><div class="navbar-link-properties navbar-link montserrat-normal-black-16px">Properties</div>
            </a>
                <a href="homepageu95loggedu95in.html"
              ><div class="navbar-link-services navbar-link montserrat-normal-black-16px">Services</div>
            </a>
         
            <a href="{{ route('visitor.profile') }}">
                <div class="head_pic">
                    @if(isset($profilePicture) && $profilePicture)
                        <img src="{{ asset('storage/' . $profilePicture) }}" alt="User Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
                    @else
                        <img src="path/to/default/image.png" alt="Default Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
                    @endif
                </div>
            </a>
          </div>
          <h1 class="estate-ease_logo lexendzetta-medium-beaver-25px">PROPERTY DETAILS</h1>
          <div class="navbar-1 navbar-2 montserrat-bold-black-12px">
            <div class="navbar-link-property-id">PROPERTY ID:</div>
            <div class="pro_id"></div>
            <div class="navbar-link-rent navbar-link">RENT:</div>
            <div class="rent"></div>
            <div class="navbar-link-payment-status">PAYMENT STATUS:</div>
            <div class="overlap-group10">
              <div class="pro_detail_btn"></div>
              <div class="unpaid">UNPAID</div>
              <div class="paid">PAID</div>
            </div>
            <div class="navbar-link-rented-date">RENTED DATE:</div>
            <div class="rent_date"></div>
          </div>
          <div class="overlap-group-container montserrat-bold-black-12px">
            <div class="overlap-group7">
              <div class="images">IMAGES</div>
              <img class="line-3 line" src="img/line-1.svg" alt="Line 3" />
              <div class="rectangle-59 rectangle"></div>
            </div>
            <div class="overlap-group4">
              <div class="additional-information">ADDITIONAL INFORMATION</div>
              <img class="line-5 line" src="img/line-1-2.svg" alt="Line 5" />
              <div class="rectangle-60 rectangle"></div>
            </div>
          </div>
        </div>
        <div class="flex-row">
          <div class="flex-col-1 flex-col-6">
            <div class="overlap-group">
              <div class="pro_pic"></div>
            </div>
            <div class="overlap-group-container-1 overlap-group-container-3 montserrat-bold-black-12px">
              <div class="overlap-group2">
                <div class="x-information">BASIC INFORMATION</div>
                <img class="line-2 line" src="img/line-2.svg" alt="Line 2" />
                <div class="flex-row-1">
                  <div class="bedroom montserrat-normal-black-12px">BEDROOM:</div>
                  <div class="bed_count"></div>
                </div>
                <div class="bath-container">
                  <div class="bathroom montserrat-normal-black-12px">BATHROOM:</div>
                  <div class="bath_count"></div>
                </div>
                <div class="balcony-container">
                  <div class="balcony montserrat-normal-black-12px">BALCONY:</div>
                  <div class="balcony_count"></div>
                </div>
                <div class="floor-container">
                  <div class="floor-no montserrat-normal-black-12px">FLOOR NO.:</div>
                  <div class="floor_count"></div>
                </div>
                <div class="size-container">
                  <div class="size-sq-ft montserrat-normal-black-12px">SIZE (sq ft).:</div>
                  <div class="size"></div>
                </div>
              </div>
              <div class="overlap-group3">
                <div class="x-information">LOCATION INFORMATION</div>
                <img class="line-4 line" src="img/line-1-1.svg" alt="Line 4" />
                <div class="division-container">
                  <div class="division montserrat-normal-black-12px">DIVISION:</div>
                  <div class="division-1"></div>
                </div>
                <div class="district-container">
                  <div class="district montserrat-normal-black-12px">DISTRICT:</div>
                  <div class="district-1"></div>
                </div>
                <div class="area-container">
                  <div class="area montserrat-normal-black-12px">AREA:</div>
                  <div class="area-1"></div>
                </div>
                <div class="flex-row-2">
                  <div class="surname surname-2 montserrat-normal-black-12px">HOUSE NO.:</div>
                  <div class="house_no"></div>
                </div>
                <div class="flex-row-3">
                  <div class="surname-1 surname-2 montserrat-normal-black-12px">SHORT ADDRESS:</div>
                  <div class="short_add"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="flex-col-2 flex-col-6">
            <div class="add_info"></div>
            <div class="flex-col-3 flex-col-6">
              <div class="flex-col-4 flex-col-6">
                <div class="tenant-information montserrat-bold-black-12px">TENANT INFORMATION</div>
                <img class="line-1 line" src="img/line-1-3.svg" alt="Line 1" />
              </div>
              <div class="flex-row-4">
                <div class="tenant_pic"></div>
                <div class="flex-col-5 flex-col-6">
                  <div class="name-container">
                    <div class="name montserrat-normal-black-12px">NAME:</div>
                    <div class="tenant"></div>
                  </div>
                  <div class="flex-row-5">
                    <div class="phone montserrat-normal-black-12px">PHONE:</div>
                    <div class="tenant"></div>
                  </div>
                  <div class="email-container">
                    <div class="email montserrat-normal-black-12px">EMAIL:</div>
                    <div class="tenant"></div>
                  </div>
                  <div class="flex-row-6">
                    <div class="permanent-address montserrat-normal-black-12px">PERMANENT ADDRESS:</div>
                    <div class="tenant_add"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="overlap-group-container-2 overlap-group-container-3">
          <div class="back-container">
            <a href="propertyu95detailsu95guest.html#propertyu95listu95foru95visitor" data-turbolinks="false">
              <div class="go_back"></div
            ></a>
            <div class="go-back montserrat-black-beaver-16px">GO BACK</div>
          </div>
          <div class="visit-container">
            <a onclick="ShowOverlay('visit-request', 'animate-appear');"> <div class="visit_req_btn"></div></a>
            <div class="visit-request montserrat-black-white-16px">VISIT REQUEST</div>
          </div>

        


        </div>
      </div>
    </div>
    <div id="overlay-visit-request" class="overlay-base">
      <div class="visit-request screen">
        <div class="visit-request-1">
          <div class="estate-ease_logo">PROPERTY VISIT REQUEST FORM</div>
          <div class="flex-row">
            <div class="flex-col montserrat-medium-black-16px">
              <div class="full-name">FULL NAME</div>
              <div class="name_txtbox"></div>
              <div class="email">EMAIL</div>
              <div class="email_txtbox"></div>
              <div class="phone-number">PHONE NUMBER</div>
              <div class="phn_txtbox"></div>
              <div class="available-date-slot">AVAILABLE DATE SLOT</div>
              <div class="date"></div>
            </div>
            <div class="overlap-group-container">
              <div class="overlap-group1">
                <div class="visit-request-2 montserrat-black-white-16px">VISIT REQUEST</div>
              </div>
              <div class="back-container">
                <a href="propertyu95details.html"> <div class="go_back"></div></a>
                <div class="go-back montserrat-black-beaver-16px">GO BACK</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <!-- Include Flatpickr CSS and JS -->
  <div class="visit-container">
    <a onclick="ShowOverlay('visit-request');">
        <div class="visit_req_btn">Request Visit</div>
    </a>
</div>

<!-- Overlay for the visit request -->
<div id="visit-request" class="overlay">
    <div class="overlay-content">
        <span class="close" onclick="ShowOverlay('visit-request');">&times;</span>
        <h2>Select Visit Date and Time</h2>
        <label for="visit-date">Visit Date:</label>
        <input type="date" id="visit-date" class="form-control">
        <label for="visit-time" style="margin-top: 10px;">Visit Time:</label>
        <input type="time" id="visit-time" class="form-control">
        <button id="submit-visit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>
    </div>
</div>

<!-- JavaScript -->
<script>
    function ShowOverlay(overlayId) {
        const overlay = document.getElementById(overlayId);
        overlay.style.display = overlay.style.display === 'none' || overlay.style.display === '' ? 'flex' : 'none';
    }

    document.getElementById('submit-visit').addEventListener('click', function() {
        const date = document.getElementById('visit-date').value;
        const time = document.getElementById('visit-time').value;

        if (date && time) {
            fetch('/visit-requests', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token for security
                },
                body: JSON.stringify({
                    visit_date: date,
                    visit_time: time
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                alert(data.success);
                ShowOverlay('visit-request'); // Hide overlay after scheduling
            })
            .catch((error) => {
                alert(error.message);
            });
        } else {
            alert('Please select both date and time.');
        }
    });
</script>


<!-- Bootstrap and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  </body>
</html>
