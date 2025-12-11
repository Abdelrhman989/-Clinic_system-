@extends('front.layouts.master')
@section('front-content')
@if(session()->has('info'))
<div class="alert alert-info">
  {{ session()->get('info') }}
</div>
@endif
@if(session()->has('success'))
<div class="alert alert-success">
  {{ session()->get('success') }}
</div>
@endif
<div class="container">
  <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb" class="fw-bold my-4 h4">
    <ol class="breadcrumb justify-content-center">
      <li class="breadcrumb-item">
        <a class="text-decoration-none" href="{{ route('front.home') }}">Home</a>
      </li>
      <li class="breadcrumb-item">
        <a class="text-decoration-none" href="{{ route('front.doctors') }}">doctors</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
        doctor name
      </li>
    </ol>
  </nav>
  <div class="d-flex flex-column gap-3 details-card doctor-details">
    <div class="details d-flex gap-2 align-items-center">
      <img src="{{ asset('front/assets/images/major.jpg') }}" alt="doctor" class="img-fluid rounded-circle" height="150"
        width="150" />
      <div class="details-info d-flex flex-column gap-3">
        <h4 class="card-title fw-bold"> {{$doctor->name }}</h4>
        <h6 class="card-title fw-bold">
          {{ $doctor->bio }}
        </h6>
        <h6 class="card-title fw-bold">
          {{ $doctor->major->name }}
        </h6>
        <h6 class="card-title fw-bold">
          {{ $doctor->major->description }}
        </h6>
      </div>
    </div>
    <hr />
    <form class="form" method="post" action="{{ route('front.doctor-form', $doctor->id) }}">
      @csrf
      <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
      <div class="form-items">
        <div class="mb-3">
          <label class="form-label required-label" for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name"
            value="{{ old('name', $existingAppointment?->name) }}" required />
          <x-erorr-component name="name" />
        </div>
        <div class="mb-3">
          <label class="form-label required-label" for="phone">Phone</label>
          <input type="tel" class="form-control" id="phone" name="phone"
            value="{{ old('phone', $existingAppointment?->phone) }}" required />
          <x-erorr-component name="phone" />
        </div>
        <div class="mb-3">
          <label class="form-label required-label" for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email"
            value="{{ old('email', $existingAppointment?->email) }}" required />
          <x-erorr-component name="email" />
        </div>
      </div>
      <button type="submit" class="btn btn-primary">
        {{ $existingAppointment ? 'Update Appointment' : 'Confirm Booking' }}
      </button>
    </form>
  </div>
</div>

@push('scripts')
<script>
  const phoneInput = document.getElementById('phone');
  const emailInput = document.getElementById('email');
  const nameInput = document.getElementById('name');
  const submitBtn = document.querySelector('button[type="submit"]');
  const doctorId = {
    {
      json_encode($doctor - > id)
    }
  };
  let checkTimeout;

  function checkExistingAppointment() {
    const phone = phoneInput.value;
    const email = emailInput.value;

    if (phone.length < 10 && email.length < 5) return;

    clearTimeout(checkTimeout);
    checkTimeout = setTimeout(() => {
      fetch('{{ route("front.check-appointment") }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({
            doctor_id: doctorId,
            phone: phone,
            email: email
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.exists && data.appointment) {
            // Fill form with existing data
            nameInput.value = data.appointment.name;
            phoneInput.value = data.appointment.phone;
            emailInput.value = data.appointment.email;

            // Show info message
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-info alert-dismissible fade show mt-3';
            alertDiv.innerHTML = `
                  You already have an appointment with Dr. {{ $doctor->name }}. 
                  You can update your information below.
                  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;

            // Remove old alert if exists
            const oldAlert = document.querySelector('.alert-info');
            if (oldAlert) oldAlert.remove();

            // Add new alert before form
            document.querySelector('.form').insertAdjacentElement('beforebegin', alertDiv);
            submitBtn.textContent = 'Update Appointment';
          } else {
            submitBtn.textContent = 'Confirm Booking';
            const oldAlert = document.querySelector('.alert-info');
            if (oldAlert) oldAlert.remove();
          }
        });
    }, 500);
  }

  phoneInput.addEventListener('blur', checkExistingAppointment);
  emailInput.addEventListener('blur', checkExistingAppointment);
</script>
@endpush
@endsection