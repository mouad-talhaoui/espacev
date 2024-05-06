@extends('etudiant.dashboard')

@section('etudiant')
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
                            <h4 class="page-title">INSCRIPTION PEDAGOGIQUE</h4>

                            <div class="clearfix"></div>

                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xs-12 col-lg-12 col-xl-12">
                        <div class="card-box">
                            <h4 class="header-title m-t-0 m-b-20">Votre inscription pédagogiques</h4>
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Module</th>
                                    <th>Section</th>
                                    <th>Semestre</th>
                                </tr>
                                </thead>

                                <tbody>
                        @foreach ($queryIps as $queryIp )
                        <tr>
                            <td>
                            {{$queryIp->section_get_id->module_get_id->lib_module}}
                            </td>
                            <td>
                                {{$queryIp->section_get_id->section}}
                            </td>
                            <td>
                                {{$queryIp->section_get_id->module_get_id->semester}}
                            </td>
                        </tr>
                        @endforeach
                            </table>
                        </div>
                    </div><!-- end col-->
                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

    </div>
    <!-- End content-page -->
@endsection
