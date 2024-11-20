<x-main-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}}
    </x-slot:pageTitle>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        @vite(['resources/scss/assets/pages/contact_us.scss'])
        <link rel="stylesheet" type="text/css" href="{{asset('plugins/tomSelect/tom-select.default.min.css')}}">
        @vite(['resources/scss/plugins/tomSelect/custom-tomSelect.scss'])
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot:headerFiles>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.privacy.admins.index') }}">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <div class="widget box box-shadow layout-top-spacing">

        <div class="widget-content widget-content-area">

            <div class="contact-us-form">
                <div class="row gx-5">
                    <div class="col-md-6">
                        <form class="row g-4" action="{{ route('admin.privacy.admins.store') }}" method="POST">
                            @csrf
                            <div class="col-md-12">
                                <h5>Admin Create</h5>
                            </div>
                            <div class="col-md-12">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ old('name') ?? '' }}">
                                @error('name')
                                <span class="mt-2 text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{ old('email') ?? '' }}">
                                @error('email')
                                <span class="mt-2 text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                @error('password')
                                <span class="mt-2 text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                @error('password_confirmation')
                                <span class="mt-2 text-sm text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-md-12">
                                <label for="select-roles" class="form-label">Roles</label>
                                <select class="form-select" id="select-roles" name="role_id" style="height: 50px">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->uuid }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>

                                @error('role_id')
                                <span class="mt-2 text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Create</button>
                                <a href="{{ route('admin.privacy.admins.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script src="{{asset('plugins/tomSelect/tom-select.complete.js')}}"></script>
        <script>
            new TomSelect("#select-permissions", {
                plugins: {
                    remove_button: {
                        title: 'Remove this item',
                    }
                }
            });
        </script>

    </x-slot:footerFiles>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-main-layout>
