<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=1440, maximum-scale=1.0" />
    <link rel="shortcut icon" type="image/png" href="https://animaproject.s3.amazonaws.com/home/favicon.png" />
    <meta name="og:type" content="website" />
    <meta name="twitter:card" content="photo" />
    
    <!-- Link CSS files using Laravel's asset() helper -->
    <link rel="stylesheet" href="{{asset('tenant-css/tenantu95dashboard.css')}}">
  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="tenantu95dashboard" />
    <div class="container-center-horizontal">
      <div class="tenantu95dashboard screen">
        <div class="overlap-group-container">
          <div class="overlap-group2">
            <div class="side_div"></div>
            <a href="tenantu95paymentu95history.html"> <div class="payhistory_btn"></div></a>
            <div class="payment-history montserrat-medium-white-16px">PAYMENT HISTORY</div>
            <a href="tenantu95help.html"> <div class="help_btn"></div></a>
            <div class="help-center montserrat-medium-white-16px">HELP CENTER</div>
            <a href="tenantu95rentedu95property.html"> <div class="rented_btn"></div></a>
            <div class="rented-properties rented montserrat-medium-white-16px">RENTED PROPERTIES</div>
            <a href="tenantu95service.html"> <div class="service_btn"></div></a>
            <div class="service-list montserrat-medium-white-16px">SERVICE LIST</div>
            <a href="tenantu95feedback.html"> <div class="feedback_btn"></div></a>
            <div class="feedbacks montserrat-medium-white-16px">FEEDBACKS</div>
            <div class="div_top"></div>
            <div class="notification montserrat-normal-black-16px">Notification</div>
            <div class="services montserrat-normal-black-16px">Services</div>
            <div class="about montserrat-normal-black-16px">About</div>
            <a href="propertyu95listu95foru95tenant.html"
              ><div class="properties montserrat-normal-black-16px">Properties</div>
            </a>
            <div class="place montserrat-normal-black-16px">Home</div>
            <div class="estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
            <div class="head_pic"></div>
            <div class="profile_btn"></div>
            <div class="profile montserrat-medium-white-16px">PROFILE</div>
            <div class="estate-ease_logo-1 estate-ease_logo-5 lexendzetta-extra-bold-white-15px">TENANT DASHBOARD</div>
          </div>
          <div class="flex-col">
            <div class="flex-row">
              <h1 class="estate-ease_logo-2 estate-ease_logo-5 lexendzetta-medium-beaver-25px">TENANT DASHBOARD</h1>
              <a href="tenantu95dashboardu95edit.html"><img class="edit" src="{{ asset('img/edit.svg') }}" alt="edit" /> </a
              ><img class="trash-2" src="{{ asset('img/trash-2.svg') }}" alt="trash-2" />
            </div>
            <div class="flex-row-1">
              <div class="flex-col-1 flex-col-4">
                <div class="pic"></div>
                <div class="account-type montserrat-medium-black-12px">ACCOUNT TYPE</div>
                <div class="acc_type"></div>
              </div>
              <div class="flex-col-2 flex-col-4">
                <div class="name-container">
                  <div class="full-name montserrat-medium-black-16px">FULL NAME :</div>
                  <div class="_txt"></div>
                </div>
                <div class="email-container">
                  <div class="email montserrat-medium-black-16px">EMAIL :</div>
                  <div class="_txt"></div>
                </div>
                <div class="address-container">
                  <div class="current-address montserrat-medium-black-16px">CURRENT ADDRESS :</div>
                  <div class="_txt"></div>
                </div>
                <div class="flex-row-2">
                  <div class="phone-number montserrat-medium-black-16px">PHONE NUMBER :</div>
                  <div class="_txt"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="overlap-group">
            <img class="arrow-left-circle" src="{{ asset('img/arrow-left-circle.svg') }}" alt="arrow-left-circle" />
            <div class="flex-col-3 flex-col-4">
              <div class="estate-ease_logo-3 estate-ease_logo-5 montserrat-bold-beaver-20px">
                CURRENTLY RENTED PROPERTY LIST
              </div>
              <div class="overlap-group4">
                <div class="pro_card"></div>
                <div class="rented_date"></div>
                <div class="rented-date rented montserrat-normal-black-12px">RENTED DATE:</div>
                <div class="property-address montserrat-normal-black-12px">PROPERTY ADDRESS:</div>
                <div class="pro_pic"></div>
                <div class="pro_add"></div>
                <div class="pro_detail_btn"></div>
                <div class="details montserrat-normal-white-11px">DETAILS</div>
                <div class="status"></div>
              </div>
            </div>
            <img class="arrow-right-circle" src="{{ asset('img/arrow-right-circle.svg') }}" alt="arrow-right-circle" />
          </div>
          <div class="overlap-group3">
            <div class="estate-ease_logo-4 estate-ease_logo-5 montserrat-bold-beaver-20px">
              PENDING SERVICE REQUEST LIST
            </div>
            <div class="overlap-group5">
              <div class="table_heading"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
