@include('professeur.includes.header_start')

<!--Morris Chart CSS -->
<link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">

    <!-- DataTables -->
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>

@include('professeur.includes.header_end')

@yield('professeur')


@include('professeur.includes.footer_start')

<!-- Required datatable js -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<!-- Buttons examples -->
<script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables/jszip.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.print.min.js')}}"></script>

<!-- Responsive examples -->
<script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>


<script type="text/javascript">
    $(document).ready(function () {

        $('#datatable').DataTable();

        //Buttons examples
        var table = $('#datatable-buttons').DataTable({
            lengthChange: false,
            buttons: [
           { extend: 'excelHtml5',
              title: $("#changenom").val(),
              text:"Télécharger EXCEL"
            }
        ],

        });

        table.buttons().container()
            .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
    });

</script>

@include('professeur.includes.footer_end')
