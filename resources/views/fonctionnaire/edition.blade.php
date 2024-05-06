@extends('fonctionnaire.dashboard')
@section('fonctionnaire')

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edition Diplome</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xs-12 col-lg-12 col-xl-12">
                    <div class="card-box">

                        <h4 class="header-title m-t-0 m-b-20">Espace de fonctionnaire</h4>

                        <table id="datatable" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>Type</th>
                                <th>Date de libration</th>
                                <th>Action</th>
                                <th>CIN</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($diplomes as $diplome)
                                  <tr>
                                    <td>
                                     @switch($diplome->type_deplome)
                                         @case("deug")
                                         DEUG
                                         @break
                                         @case("licence")
                                         Licence
                                         @break
                                         @case("master")
                                         Master
                                         @break
                                         @default
                                     @endswitch
                                    </td>
                                    <td>{{$diplome->date_deliberation}}</td>
                                    <td>modifier</td>
                                    <td><a href="#" target="_blank" rel="noopener noreferrer">carte national</a></td>
                                  </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div><!-- end col-->
            </div>
            <!-- end row -->
        </div> <!-- container -->

    </div> <!-- content -->


</div>
<!-- End content-page -->


<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->

@endsection
