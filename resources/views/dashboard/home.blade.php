<x-main-layout :scrollspy="false">

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

        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing rounded-8">
{{--            <x-widgets._w-card-four title="Customers" total="100"/>--}}
        </div>

    </div>

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
    </x-slot:footerFiles>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-main-layout>
