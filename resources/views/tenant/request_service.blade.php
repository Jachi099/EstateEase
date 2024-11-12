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
     <a href="{{ route('tenant.user_home') }}"><div class="navbar-link-place navbar-link montserrat-normal-black-16px">Home</div> </a
      ><a href="{{ route('tenant.user_home') }}"><div class="navbar-link-about navbar-link montserrat-normal-black-16px">About</div> </a
      >  <a href="{{ route('tenant.property_list') }}"><div class="navbar-link-properties montserrat-normal-black-16px">Properties</div> </a
        >
      
      
        <a href="{{ route('tenant.profile') }}"><div class="head_pic">
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
                <h1 class="estate-ease_logo lexendzetta-medium-beaver-25px">REQUEST SERVICE</h1>
            </div>
            </div>
          </div>


          @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form action="{{  route('tenant.service.request') }}" method="POST">
        @csrf

        <div class="form-container">

        <div class="left-side">
        <div class="form-group">
            <label for="property_id">Select Property:</label>
            <select id="property_id" name="property_id" class="name_txtbox form-control" required>
                @foreach ($properties as $property)
                    <option value="{{ $property->property_ID }}">{{ $property->type }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="service_type" >Service Type:</label>
            <select id="service_type" name="service_type" class="name_txtbox form-control" required>
                <option value="Plumbing">Plumbing</option>
                <option value="Electrical">Electrical</option>
                <option value="Carpentry">Carpentry</option>
                <option value="Cleaning">Cleaning</option>
                <option value="HVAC">HVAC</option>
                <!-- Add more service types as needed -->
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="name_txtbox form-control"   rows="3" required></textarea>
        </div>
        </div>
        <div class="right-side">

        <div class="form-group">
            <label for="service_date">Service Date:</label>
            <input type="date" id="service_date" class="name_txtbox form-control" name="service_date"  required>
        </div>

        <div class="form-group">
            <label for="service_time">Service Time:</label>
            <input type="time" id="service_time" class="name_txtbox form-control" name="service_time"  required>
        </div>


        <div class="button-column">
            <div class="add-button-container">
        <button type="submit" class="add-property-button">REQUEST SERVICE</button>
    </div>
    <div class="back-button-container">
        <button type="button" onclick="window.history.back();" class="back-button">Go Back</button>
    </div>
        </div>
</div>
        </div>
    </form>
           




            
            
           
       
        </div>
      </div>
    </div>
  </body>
</html>
