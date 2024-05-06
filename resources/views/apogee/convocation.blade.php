@extends('apogee.dashboard')
@section('apogee')

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
                        <h4 class="page-title">Gestion des convocations</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-lg-12 col-xl-12">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">

                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ session('success') }}
                            </div>
                            @endif


                            <div class="card-box">
                                <div class="col-md-12">
                                    <h4 class="header-title m-t-0">La gestion des convocations</h4>
                                    <p class="text-muted m-b-20 font-13">
                                        Le fichier Excel destiné à l'importation des convocations dans la base de données : <a href="{{ asset('assets/canvas/convocation.csv') }}">canvas</a>
                                    </p>

                                    <div class="button-list">

                                        <button class="btn btn-primary waves-effect waves-light" data-toggle="modal"
                                                data-target=".bs-example-modal-lg">Importer
                                        </button>

                                    </div>

                                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                        ×
                                                    </button>
                                                    <h4 class="modal-title" id="myLargeModalLabel">Importer la liste des convocations</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('apogee.store.convocation') }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="p-20">
                                                            <div class="form-group">
                                                                <label class="file">
                                                                    <input type="file" id="file" name="import_file" accept=".csv">
                                                                    <span class="file-custom"></span>
                                                                </label>
                                                            </div>

                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Importer</button>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                </div>

                            </div>
                        </div>

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
