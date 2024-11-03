<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=1440, maximum-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('tenant-css/tenantu95rentedu95property.css') }}">
  </head>
  <body>
    <div class="container">
      <h1>Rented Properties History</h1>

      <!-- Sorting Dropdown -->
      <form method="GET" action="{{ route('tenant.rented_properties') }}">
        <label for="sort">Sort by:</label>
        <select name="sort" onchange="this.form.submit()">
          <option value="rented_date" {{ request('sort') == 'rented_date' ? 'selected' : '' }}>Rented Date</option>
          <option value="address" {{ request('sort') == 'address' ? 'selected' : '' }}>Property Address</option>
        </select>
      </form>

      <!-- Rented Properties List -->
      <div class="rented-properties-list">
        @forelse ($rentals as $rental)
          <div class="property-card">
            <h2>{{ $rental->property->address }}</h2>
            <p>Rented Date: {{ $rental->rented_date->format('d M Y') }}</p>
            <p>Status: {{ $rental->property->status }}</p>
            <a href="{{ route('property.details', $rental->property->id) }}">View Details</a>
          </div>
        @empty
          <p>No rented properties found.</p>
        @endforelse
      </div>

      <a href="{{ url('/tenant/dashboard') }}">Go Back</a>
    </div>
  </body>
</html>
