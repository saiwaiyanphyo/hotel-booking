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
    <label for="month-year">Select Month and Year:</label>
    <input type="month" id="month-year" name="month-year">

<table id="bankTable" class="table table-striped dt-table-hover" style="width:100%">
      <thead>
      <tr>
            <th>No</th>
            <th>Room Type</th>
            <th>Income</th>
      </tr>
      </thead>
      <tbody>
      </tbody>
 </table>



</div>

</div>

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
     <script src="{{ asset('plugins/global/vendors.min.js') }}"></script>
        <script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
        <script src="{{asset('plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>

           <script>
      $(document).ready(function() {
            $('#bankTable').DataTable({
                 paging: false, // Disable pagination
                 searching: false, // Disable search
                 info: false // Disable info
            });
      });
 </script>
            <script>
            $(document).ready(function() {
                var table = $('#bankTable').DataTable();

                $('#month-year').on('change', function() {
                    var selectedDate = $(this).val();
                
                    $.ajax({
                        url: '{{ route('ajax.monthly_income') }}', 
                        type: 'POST',
                        data: { 
                            date: selectedDate,
                            _token: '{{ csrf_token() }}' 
                        },
                        success: function(response) {
                            console.log(response);
                            // Clear the table
                           table.clear();
                            // Add new data to the table
                          table.rows.add(response.data);
                            // Redraw the table
                            table.draw();
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                        }
                    });
                });
            });
        </script>
      
    </x-slot:footerFiles>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-main-layout>
