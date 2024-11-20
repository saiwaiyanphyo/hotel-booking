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
                <li class="breadcrumb-item"><a href="{{ route('admin.room-types.index') }}">Room Types</a></li>
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
                        <form class="row g-4" action="{{ route('admin.room-types.store') }}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="col-md-12">
                                <h5>{{ $title }}</h5>
                            </div>
                            <div class="col-md-12 ">
                                <x-text-input name="name" :value="old('name')"
                                              :error="$errors->has('name') ? $errors->first('name') : null"
                                              label="Name" required="true"/>
                            </div>

                            <div class="col-md-12 ">
                                <x-number-input name="price_per_night" label="Price Per Night"
                                                :value="old('price_per_night')"
                                                :error="$errors->has('price_per_night') ? $errors->first('price_per_night') : null"
                                                required="true"/>
                            </div>
                            <div class="col-md-12 ">
                                <x-number-input name="max_occupancy" label="Max Occupancy"
                                                :value="old('max_occupancy')"
                                                :error="$errors->has('max_occupancy') ? $errors->first('max_occupancy') : null"
                                                required="true"/>
                            </div>

                            <div class="col-md-12 ">
                                <x-text-area-input name="description" label="Description"
                                                   :value="old('description')"
                                                   :error="$errors->has('description') ? $errors->first('description') : null"
                                                   required="true"/>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Create</button>
                                <a href="{{ route('admin.room-types.index') }}"
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
