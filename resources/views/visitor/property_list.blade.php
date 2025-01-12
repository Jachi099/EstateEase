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
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/propertyu95listu95foru95visitor.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/styleguide.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/globals.css') }}" />

  </head>
  <body style="margin: 0; background: #ffffff">
    <input type="hidden" id="anPageName" name="page" value="propertyu95listu95foru95visitor" />
    <div class="container-center-horizontal">
      <div class="propertyu95listu95foru95visitor screen">
        <div class="flex-col flex">
          <div class="navbar">
            <div class="navbar-link-estate-ease_logo montserrat-semi-bold-beaver-18px">EstateEase</div>
            <a href="{{ route('visitor.user_home') }}"><div class="navbar-link-place navbar-link montserrat-normal-black-16px">Home</div> </a
            > <a href="{{ route('visitor.user_home') }}"><div class="navbar-link-about navbar-link montserrat-normal-black-16px">About</div> </a
            >

            <a href="{{ route('visitor.property_list') }}"><div class="navbar-link-properties navbar-link montserrat-normal-black-16px">Properties</div>
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





          <div class="flex-row flex">
            <h1 class="estate-ease_logo lexendzetta-medium-beaver-25px">PROPERTIES</h1>
            <div class="sort montserrat-medium-black-16px">SORT:</div>



            <select id="sort-options" class="sort-1" onchange="sortProperties()">
    <option value="rent_asc" {{ request('sort') == 'rent_asc' ? 'selected' : '' }}>Rent (Low to High)</option>
    <option value="rent_desc" {{ request('sort') == 'rent_desc' ? 'selected' : '' }}>Rent (High to Low)</option>
    <option value="type" {{ request('sort') == 'type' ? 'selected' : '' }}>Property Type</option>
    <option value="availability" {{ request('sort') == 'availability' ? 'selected' : '' }}>Availability</option>
</select>




          </div>
        </div>
        <form action="{{ route('visitor.filter') }}" method="GET">

<div class="flex-row-1">
    <div class="location location-2 montserrat-medium-black-16px">LOCATION:</div>

    <input list="locations" name="location" id="location" class="sort-2" value="{{ request('location') }}" placeholder="Type location...">
<datalist id="locations">
    <option value="Adabor"></option>
    <option value="Badda"></option>
    <option value="Banani"></option>
    <option value="Bangshal"></option>
    <option value="Bhashantek"></option>
    <option value="Cantonment"></option>
    <option value="Chawkbazar"></option>
    <option value="Darus Salam"></option>
    <option value="Dhanmondi"></option>
    <option value="Gendaria"></option>
    <option value="Gulshan"></option>
    <option value="Hazaribagh"></option>
    <option value="Jatrabari"></option>
    <option value="Kalabagan"></option>
    <option value="Kadamtali"></option>
    <option value="Kafrul"></option>
    <option value="Kamrangirchar"></option>
    <option value="Kotwali"></option>
    <option value="Lalbagh"></option>
    <option value="Mirpur"></option>
    <option value="Mohammadpur"></option>
    <option value="Motijheel"></option>
    <option value="New Market"></option>
    <option value="Pallabi"></option>
    <option value="Paltan"></option>
    <option value="Ramna"></option>
    <option value="Rampura"></option>
    <option value="Sabujbagh"></option>
    <option value="Shah Ali"></option>
    <option value="Shahbagh"></option>
    <option value="Shyampur"></option>
    <option value="Sutrapur"></option>
    <option value="Tejgaon"></option>
    <option value="Uttara"></option>
    <option value="Wari"></option>
</datalist>

    <div class="rent-range rent-1 montserrat-medium-black-16px">RENT RANGE:</div>
    <select name="rent_range" class="sort-3">
        <option value="">Select Rent Range</option>
        <!-- Updated rent ranges to start from more than 10,000 BDT -->
        <option value="10000-20000" {{ request('rent_range') == '10000-20000' ? 'selected' : '' }}>Above 10,000 BDT - 20,000 BDT</option>
        <option value="20000-30000" {{ request('rent_range') == '20000-30000' ? 'selected' : '' }}>20,000 BDT - 30,000 BDT</option>
        <option value="30000-40000" {{ request('rent_range') == '30000-40000' ? 'selected' : '' }}>30,000 BDT - 40,000 BDT</option>
        <option value="40000-50000" {{ request('rent_range') == '40000-50000' ? 'selected' : '' }}>40,000 BDT - 50,000 BDT</option>
        <option value="50000-100000" {{ request('rent_range') == '50000-100000' ? 'selected' : '' }}>Above 50,000 BDT</option>
    </select>

    <div class="overlap-group2">
        <button type="submit" class="update_btn update_btn-2">
            <div class="filter">FILTER</div>
        </button>
    </div>
</div>
</form>




        <div class="container1">


            @foreach ($properties as $property)
            <div class="property-card">

            @php
    $propertyImage = \App\Models\PropertyImage::where('property_ID', $property->property_ID)->first();
@endphp

@if ($propertyImage)
    <!-- Display the first image from PropertyImage model -->
    <a href="{{ route('visitor.details', $property->property_ID) }}" class="property-image-link">
        <img src="{{ asset('storage/' . $propertyImage->image_path) }}" alt="Property Image" class="property-image">
        <span class="tooltip">More Details</span>
    </a>
@else
    <!-- Fallback to default image if no property images exist -->
    <a href="{{ route('visitor.details', $property->property_ID) }}" class="property-image-link">
        <img src="{{ asset('path/to/default/image.png') }}" alt="Default Property Image" class="property-image">
        <span class="tooltip">More Details</span>
    </a>
@endif



<div class="property-header1">
    <h2 class="property-title1">{{ strtoupper($property->type) }}</h2>
    @php
        // Get the tenant and available_from date
        $tenant = $property->tenant; // Use the `tenant` relationship loaded earlier
        $availableFrom = \Carbon\Carbon::parse($property->available_from); // Convert available_from to a Carbon instance
        $currentDate = \Carbon\Carbon::now(); // Get the current date
    @endphp

    <div class="tenant-info-item1 normal-text
        @if($tenant)
            tenant-info-rented
        @elseif($availableFrom->isFuture())
            tenant-info-coming-soon
        @else
            tenant-info-available
        @endif">

        @if($tenant)
            Rented
        @elseif($availableFrom->isFuture())
            Coming Soon
        @else
            Available
        @endif
    </div>
</div>






    <div class="property-details1">
    <div class="detail-item1">
        <strong>Rent:</strong> <span>{{ $property->rent }}tk</span>
    </div>

    <div class="detail-item1">
        <strong>Size:</strong> <span>{{ $property->size }} sq ft</span>
    </div>
    <div class="detail-item1">
        <strong>Floor:</strong> <span>{{ $property->floor }}</span>
    </div>
    <div class="detail-item1">
        <strong>Bedrooms:</strong> <span>{{ $property->num_of_rooms }}</span>
    </div>

    <div class="detail-item12">
    <strong>Address:</strong>
    <span>
        {{ $property->house_no }}, {{ $property->area }}, {{ $property->thana }},
        {{ $property->city }} - {{ $property->postal_code }}
    </span>
</div>

    <div class="detail-item12">
        <strong>Available From:</strong> <span>{{ $property->available_from }}</span>
    </div>

</div>
</div>
            @endforeach
        </div>


    </div>

    <script>
function sortProperties() {
    const sortOption = document.getElementById('sort-options').value;

    // Append the sort query parameter to the URL and reload the page
    const url = new URL(window.location.href);
    url.searchParams.set('sort', sortOption);  // Set the sort parameter
    window.location.href = url.toString();  // Reload the page with updated sort parameter
}


</script>
  </body>
</html>
