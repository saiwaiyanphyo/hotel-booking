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
                <li class="breadcrumb-item"><a href="{{ route('admin.employees.index') }}">Employees</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <div class="widget box box-shadow layout-top-spacing">

        <div class="widget-content widget-content-area">

            <div class="dashboard-form">
                <div class="row gx-5">
                    <div class="col-md-6">
                        <form class="row g-4" action="{{ route('admin.employees.update', $employee->id) }}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <h5>{{ $title }}</h5>
                            </div>
                            <div class="col-md-12 ">
                                <x-text-input name="name" :value="old('name', $employee->name)"
                                              :error="$errors->has('name') ? $errors->first('name') : null"
                                              label="Name" :required="true"/>
                            </div>

                            <div class="col-md-12 ">
                                <x-email-input name="email" label="Email"
                                               :value="old('email', $employee->email)"
                                               :error="$errors->has('email') ? $errors->first('email') : null"
                                               :required="true"/>
                            </div>

                            <div class="col-md-12 ">
                                <x-password-input name="password" label="Password"
                                                  :value="old('password')"
                                                  :error="$errors->has('password') ? $errors->first('password') : null"
                                                  :required="false"/>
                            </div>
                            <div class="col-md-12 ">
                                <x-text-input name="phone_number" label="Phone Number"
                                              :value="old('phone_number', $employee->phone_number)"
                                              :error="$errors->has('phone_number') ? $errors->first('phone_number') : null"
                                              :required="true"/>
                            </div>


                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('admin.employees.index') }}"
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