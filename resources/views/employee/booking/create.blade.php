<x-employee-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}}
    </x-slot:pageTitle>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->

        <link rel="stylesheet" href="{{ asset('plugins/flatpickr/flatpickr.css') }}">
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot:headerFiles>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('employee.home')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('employee.bookings.index') }}">Bookings</a></li>
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
                        <form class="row g-4" action="{{ route('employee.bookings.store') }}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="col-md-12">
                                <h5>{{ $title }}</h5>
                            </div>
                            <div class="col-md-4 ">
                                <x-text-input name="first_name" :value="old('first_name')"
                                              :error="$errors->has('first_name') ? $errors->first('first_name') : null"
                                              label="First Name" required="true"/>
                            </div>
                            <div class="col-md-4 ">
                                <x-text-input name="last_name" :value="old('last_name')"
                                              :error="$errors->has('last_name') ? $errors->first('last_name') : null"
                                              label="Last Name" required="true"/>
                            </div>
                            <div class="col-md-4 ">
                                <x-email-input name="email" label="Email"
                                               :value="old('email')"
                                               :error="$errors->has('email') ? $errors->first('email') : null"
                                               required="true"/>
                            </div>

                            <div class="col-md-4 ">
                                <x-text-input name="phone_number" label="Phone Number"
                                              :value="old('phone_number')"
                                              :error="$errors->has('phone_number') ? $errors->first('phone_number') : null"
                                              required="true"/>
                            </div>

                            <div class="col-md-4 ">
                                <x-text-input name="identity_number" label="Identity Number"
                                              :value="old('identity_number')"
                                              :error="$errors->has('identity_number') ? $errors->first('identity_number') : null"
                                              required="true"/>
                            </div>

                            <div class="col-md-4">
                                <x-date-time-input name="check_in_date" id="check_in_date" label="Choose Date"
                                                   value="{{ now()->format('d-m-Y') }}"/>
                            </div>

                            @include('components.booking.room')

                            <div class="col-md-4">
                                <div class="form-floating">
                                    <select id="status" class="form-select @error('status') is-invalid @enderror" name="status" required>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                        @endforeach
                                    </select>
                                    <label for="status">Status <span class="text-danger">&nbsp;&lowast;</span></label>
                                </div>
                                @if ($errors->has('status'))
                                    <span class="text-danger small fw-bolder" role="alert">{{ $errors->first('status') }}</span>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating">
                                    <select id="payment_status" class="form-select @error('payment_status') is-invalid @enderror" name="payment_status" required>
                                        @foreach($paymentStatuses as $payment_status)
                                            <option value="{{ $payment_status }}" {{ old('payment_status') == $payment_status ? 'selected' : '' }}>{{ ucfirst($payment_status) }}</option>
                                        @endforeach
                                    </select>
                                    <label for="payment_status">Payment Status <span class="text-danger">&nbsp;&lowast;</span></label>
                                </div>
                                @if ($errors->has('payment_status'))
                                    <span class="text-danger small fw-bolder" role="alert">{{ $errors->first('payment_status') }}</span>
                                @endif
                            </div>

                            <div class="col-md-4 ">
                                <x-text-area-input name="address" :value="old('address')"
                                                   :error="$errors->has('address') ? $errors->first('address') : null"
                                                   label="Address" required="true"/>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Create</button>
                                <a href="{{ route('employee.bookings.index') }}"
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
        <script src="{{ asset('plugins/global/vendors.min.js') }}"></script>

        <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>
        <script>
            $(document).ready(function () {
                flatpickr(document.getElementById('check_in_date'), {
                    enableTime: false,
                    mode: "range",
                    dateFormat: "d-m-Y",
                    defaultDate: new Date()
                });

            });

            $('#addMoreRoom').on('click', function () {
                let count = $('.room-clone-div').length;

                // Ensure the roomCloneDiv element exists
                let clone = $('#roomCloneDiv').clone(true, true);

                // Update the ID and button of the cloned element
                clone.attr('id', `roomCloneDiv${count}`);
                clone.find('button#addMoreRoom').replaceWith(
                    `<button type="button" class="btn btn-outline-danger custom-btn-width float-end"
         id="roomCloneDiv${count}" onclick="removeDiv(this.id)">Remove</button>`
                );

                // Modify the input fields of the cloned element
                modifyInput(clone, count, true);

                // Insert the cloned element after the last room-clone-div
                clone.insertAfter('div.room-clone-div:last');
            });

            // Function to remove a cloned element
            function removeDiv(id) {
                $('#' + id).remove();
            }

            // Function to modify the input fields of the cloned element
            function modifyInput(clone, count, isRequired = false) {
                if (isRequired) {
                    clone.find('input, select').prop("required", true);
                }
                clone.find('input, select').each(function () {
                    this.value = null;
                    this.id = this.id.replace(/\d+$/, count);
                    this.name = this.name.replace(/\[\d+\]/, '[' + count + ']');
                });
            }

        </script>

    </x-slot:footerFiles>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-employee-layout>
