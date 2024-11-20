<x-auth-layout :scrollspy="false">

    <x-slot:pageTitle>
        Admin Login
    </x-slot:pageTitle>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        @vite(['resources/scss/auth-boxed.scss'])

        <style>
            #load_screen {
                display: none;
            }
        </style>
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot:headerFiles>
    <!-- END GLOBAL MANDATORY STYLES -->

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">

            <div class="row">

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">

                            <div class="row">
                                <form action="{{ route('admin.login') }}" method="post">
                                    @csrf

                                    <div class="col-md-12 mb-3">

                                        <h2>Sign In</h2>
                                        <p>Enter your email and password to login</p>

                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input name="email" id="email" type="email" autocomplete="off"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   value="{{ old('email') }}">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label for="password" class="form-label ">Password</label>
                                            <input name="password" id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror">

                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input me-3" type="checkbox"
                                                       id="form-check-default">
                                                <label class="form-check-label" for="form-check-default">
                                                    Remember me
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-4">
                                            <button class="btn btn-secondary w-100">SIGN IN</button>
                                        </div>
                                    </div>

                                </form>

                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <x-slot:footerFiles>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <script src="{{ asset('plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('plugins/mousetrap/mousetrap.min.js') }}"></script>
{{--        <script src="{{ asset('plugins/waves/waves.min.js') }}"></script>--}}
{{--        <script src="{{ asset('plugins/highlight/highlight.pack.js') }}"></script>--}}

    </x-slot:footerFiles>

</x-auth-layout>
