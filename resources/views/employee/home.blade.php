<x-employee-layout :scrollspy="false">

    <x-slot:pageTitle>
        Home
    </x-slot:pageTitle>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot:headerFiles>
    <!-- END GLOBAL MANDATORY STYLES -->

    <div class="row layout-top-spacing">
    <div class="container py-4">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-door-open text-primary fa-2x mr-3"></i>
                    <div>
                        <h5 class="card-title text-primary">Room Count</h5>
                        <p class="card-text display-4 font-weight-bold">{{$room_count}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-percentage text-success fa-2x mr-3"></i>
                    <div>
                        <h5 class="card-title text-success">Room Percentage</h5>
                        <p class="card-text display-4 font-weight-bold">{{$room_percentage}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-book text-info fa-2x mr-3"></i>
                    <div>
                        <h5 class="card-title text-info">Booking Count</h5>
                        <p class="card-text display-4 font-weight-bold">{{$booking_count}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
    </x-slot:footerFiles>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-employee-layout>
