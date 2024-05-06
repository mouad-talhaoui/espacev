@include('etudiant.includes.header_start')

<!--Morris Chart CSS -->
<link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">

@include('etudiant.includes.header_end')

@yield('etudiant')


@include('etudiant.includes.footer_start')

<!--Morris Chart-->
<script src="{{ asset('assets/plugins/morris/morris.min.js')}}"></script>
<script src="{{ asset('assets/plugins/raphael/raphael-min.js')}}"></script>


<!-- Page specific js -->
<script src="{{ asset('assets/pages/jquery.dashboard.js')}}"></script>
<script>

    // function clickAnnulerAndPrint() {
   $("#imprimer").on('click',function(){

   const contentToPrint = document.getElementById('printable-content');
  const originalContent = document.body.innerHTML;
  document.body.innerHTML = contentToPrint.innerHTML;
  window.print();

  document.body.innerHTML = originalContent;
   })
window.onafterprint = function() {
  window.location.reload();
};
//    }
</script>
@include('etudiant.includes.footer_end')
