     @extends('front.layouts.master')
@section('front-content')
<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('front.home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">register</li>
        </ol>
    </nav>
    <div class="d-flex flex-column gap-3 account-form mx-auto mt-5">
        <form class="form" action="{{ route('front.register') }}" method="post">
            @csrf
            <div class="form-items">
                <div class="mb-3">
                    <label class="form-label required-label" for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                    <x-erorr-component name="name" />
                </div>
                <div class="mb-3">
                    <label class="form-label required-label" for="phone">Phone</label>
                    <input type="tel" class="form-control" name="phone" id="phone" required>
                    <x-erorr-component name="phone" />
                </div>
                <div class="mb-3">
                    <label class="form-label required-label" for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                    <x-erorr-component name="email" />
                </div>
                <div class="mb-3">
                    <label class="form-label required-label" for="password">password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                    <x-erorr-component name="password" />
                </div>
                <div class="mb-3">
                    <label class="form-label required-label" for="password_confirmation">password confirmation</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                    <x-erorr-component name="password_confirmation" />
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Create account</button>
        </form>
        <div class="d-flex justify-content-center gap-2 flex-column flex-lg-row flex-md-row flex-sm-column">
            <span>already have an account?</span><a class="link" href="{{ route('front.login') }}">login</a>
        </div>
    </div>
</div>
@endsection