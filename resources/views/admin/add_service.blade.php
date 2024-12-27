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

    <link rel="stylesheet" type="text/css" href="{{ asset('css/serviceaddu95admin.css') }}" />

<link rel="stylesheet" type="text/css" href="{{ asset('css/styleguide.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('globals.css') }}"/>

  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="serviceaddu95admin" />
    <div class="container-center-horizontal">
      <div class="serviceaddu95admin screen">
        <div class="overlap-group">
          <div class="estate-ease estate lexendzetta-black-mongoose-20px">EstateEase</div>
          <div class="overlap-group7"><div class="dashboard montserrat-extra-bold-mongoose-20px">Dashboard</div></div>
          <div class="overlap-group-item">
            <a href="profileu95admin.html"> <div class="link"></div></a>
            <div class="profile montserrat-extra-bold-mongoose-20px">Profile</div>
          </div>
          <div class="overlap-group10"><div class="property montserrat-extra-bold-mongoose-20px">Property</div></div>
          <div class="overlap-group4"><div class="landlord montserrat-extra-bold-mongoose-20px">Landlord</div></div>
          <div class="overlap-group11">
            <div class="tenant-visitor montserrat-extra-bold-mongoose-20px">Tenant &amp; Visitor</div>
          </div>
          <div class="overlap-group8">
            <div class="service service-1 montserrat-extra-bold-beaver-20px">Service</div>
          </div>
          <div class="overlap-group-item">
            <a href="serviceu95provideru95admin.html"> <div class="link"></div></a>
            <div class="service-provider service-1 montserrat-extra-bold-mongoose-20px">Service Provider</div>
          </div>
          <div class="overlap-group-item">
            <a href="visitor.html"> <div class="link"></div></a>
            <div class="feedback montserrat-extra-bold-mongoose-20px">Feedback</div>
          </div>
          <div class="overlap-group5"><div class="log-out montserrat-extra-bold-mongoose-20px">Log out</div></div>
        </div>
        <div class="flex-col flex">
          <div class="flex-row flex">
            <h1 class="estate-ease_logo estate lexendzetta-medium-white-25px">
              <span class="lexendzetta-medium-beaver-25px">SERVICES - </span
              ><span class="lexendzetta-medium-black-25px">ADD SERVICES</span>
            </h1>
            <a href="profileu95admin.html"> <div class="head_pic"></div></a>
          </div>


          <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

          <div class="flex-row-1 flex-row-3">

          <div class="pic" onclick="document.getElementById('servicePicture').click();">
    <input type="file" id="servicePicture" name="picture" accept="image/*" style="display:none;" onchange="previewImage(event)">
    <span class="plus-sign">+</span>
    <img id="imagePreview" src="" alt="Service Picture" class="show" style="display:none; max-width: 100%; max-height: 100%;"/>
</div>




        <div class="flex-col-1 flex-col-3 montserrat-medium-black-16px">
              <div class="service-type service-1">SERVICE TYPE</div>

            <input type="text" class="servicetype_txt" id="type" name="type"  value="{{ old('type') }}" required>
            @error('type')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="add-picture add montserrat-medium-black-16px">COST</div>

<input type="number" id="cost" name="cost" class="upload_pic" value="{{ old('cost') }}" min="0" required>
@error('cost')
<span class="text-danger">{{ $message }}</span>
@enderror

        <div class="details">DETAILS</div>

              <textarea id="description" name="description" class="details_txtbox"  required>{{ old('description') }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror


            </div>
          </div>
          <div class="flex-col-2 flex-col-3">


            <div class="overlap-group-container">


            <button class="overlap-group3">
                <div class="add-service add montserrat-black-white-16px">ADD SERVICE</div>
                </button>
                </form>

              <div class="back-container">
                <a href="{{ route('admin.services') }}"> <div class="goback_btn">                GO BACK
                </div></a>
              </div>

        </div>



            <div class="list-of-services montserrat-semi-bold-black-20px">LIST OF SERVICES</div>
<!-- Scrollable Table with Services -->
<div class="table-container">
    <table class="basic-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Picture</th>
                <th>Type</th>
                <th>Cost (৳)</th>
                <th>Description</th>
                <th>Action</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($services as $service)
            <tr>
                <td>{{ $service->id }}</td>
                <td>
                <img src="{{ asset('storage/' . $service->picture) }}" alt="{{ $service->type }}" class="service-img" />
                </td>
                <td>{{ $service->type }}</td>
                <td>৳{{ number_format($service->cost, 2) }}</td>
                <td>{{ $service->description }}</td>
                <td>
                    <!-- Edit button -->
                    <a href="" class="action-button">
                        <img src="{{ asset('img/edit.svg') }}" alt="Edit" class="icon" />
                    </a>

                    <!-- Delete button -->
                    <form action="" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')

                            <img src="{{ asset('img/trash-2.svg') }}" alt="Delete" class="icon" />
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>




          </div>
        </div>
      </div>
    </div>


    <script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('imagePreview');
            output.src = reader.result;
            output.style.display = 'block'; // Show the image after selection
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
  </body>
</html>
