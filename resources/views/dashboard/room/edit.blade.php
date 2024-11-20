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
                <li class="breadcrumb-item"><a href="{{ route('admin.rooms.index') }}">Rooms</a></li>
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
                        <form class="row g-4" action="{{ route('admin.rooms.update', $room->id) }}"
                            enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <h5>{{ $title }}</h5>
                            </div>
                            <div class="col-md-12 ">
                                <x-text-input name="room_number" :value="old('room_number', $room->room_number)"
                                    :error="$errors->has('room_number') ? $errors->first('room_number') : null"
                                    label="Room Number" required="true" />
                            </div>

                            <div class="col-md-12 ">
                                <x-select-input-edit name="room_type_id" label="Room Type" :options="$roomTypes"
                                    :selected="old('room_type_id', $room->room_type_id)" :roomTypeId=$roomTypeId
                                    :error="$errors->has('room_type_id') ? $errors->first('room_type_id') : null"
                                    required="true" />
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select id="status" class="form-select @error('status') is-invalid @enderror"
                                        name="status" required>
                                        @foreach($statuses as $status)
                                        <option value="{{ $status }}"
                                            {{ old('status', $room->status) == $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}</option>
                                        @endforeach
                                    </select>
                                    <label for="status">Status <span class="text-danger">&nbsp;&lowast;</span></label>
                                </div>
                                @if ($errors->has('status'))
                                <span class="text-danger small fw-bolder"
                                    role="alert">{{ $errors->first('status') }}</span>
                                @endif
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('admin.rooms.index') }}" class="btn btn-danger">Cancel</a>
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