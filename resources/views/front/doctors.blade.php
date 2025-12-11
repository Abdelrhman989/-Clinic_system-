@extends('front.layouts.master')

@section('front-content')
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('front.home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">doctors</li>
            </ol>
        </nav>
        <div class="doctors-grid">
            @foreach ($doctors as $doctor)
                <div class="card p-2" style="width: 18rem;">
                    <img src="{{ $doctor->image }}" class="card-img-top rounded-circle card-image-circle" alt="major">
                    <div class="card-body d-flex flex-column gap-1 justify-content-center">
                        <h4 class="card-title fw-bold text-center">{{ $doctor->name }}</h4>
                        <h6 class="card-title fw-bold text-center">{{ $doctor->major->name }}</h6>
                        <a href="{{ route('front.doctor-form', $doctor->id) }}" class="btn btn-outline-primary card-button">Book
                            an
                            appointment</a>
                    </div>
                </div>
            @endforeach


        </div>
        <nav class="mt-5" aria-label="navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link page-prev" href="{{ route('front.doctors') }}" aria-label="Previous">
                        <span aria-hidden="true">
                            < </span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="{{ route('front.doctors') }}">1</a></li>
                <li class="page-item"><a class="page-link" href="{{ route('front.doctors') }}">2</a></li>
                <li class="page-item"><a class="page-link" href="{{ route('front.doctors') }}">3</a></li>
                <li class="page-item">
                    <a class="page-link page-next" href="{{ route('front.doctors') }}" aria-label="Next">
                        <span aria-hidden="true"> > </span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endsection