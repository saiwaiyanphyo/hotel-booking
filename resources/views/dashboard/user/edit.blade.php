<x-main-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}}
    </x-slot:pageTitle>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot:headerFiles>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <div class="widget box box-shadow layout-top-spacing">

        <div class="widget-content widget-content-area">

            <div class="dashboard-form">
                <div class="row gx-5">
                    <div class="col-md-12">
                        <form class="row g-4" action="{{ route('admin.users.update', $user->uuid) }}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="col-md-4 mb-3">
                                <h5>{{ $title }}</h5>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <x-text-input name="name" :value="old('name', $user->name)" label="Name"
                                                      :error="$errors->first('name')" :required="true"/>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-email-input name="email" :value="old('email', $user->email)" label="Email"
                                                       :error="$errors->first('email')" :required="true"/>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-password-input name="password" :value="old('password')" label="Password"
                                                          :error="$errors->first('password')" :required="false"/>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-text-input name="position" :value="old('position', $user->position)" label="Position"
                                                      :error="$errors->first('position')" :required="true"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('admin.users.index') }}"
                                   class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>

    </x-slot:footerFiles>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-main-layout>