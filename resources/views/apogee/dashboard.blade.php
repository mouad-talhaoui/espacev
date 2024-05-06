@include('apogee.includes.header_start')

<!--Morris Chart CSS -->
<link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">

@include('apogee.includes.header_end')

@yield('apogee')

@include('apogee.includes.footer_start')

<!--Morris Chart-->
<script src="{{ asset('assets/plugins/morris/morris.min.js')}}"></script>
<script src="{{ asset('assets/plugins/raphael/raphael-min.js')}}"></script>

<!-- Page specific js -->
<script src="{{ asset('assets/pages/jquery.dashboard.js')}}"></script>

@include('apogee.includes.footer_end')
