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
                        <h4 class="page-title">RETRAIT DÉFINITIF</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0"
                        width="100%">
                                <thead>
                                <tr>
                                    <th>Apogee</th>
                                    <th>CNE</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>date de retrait</th>

                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demandes as $demande)
                                      <tr>
                                        <td>{{$demande->codapo}}</td>
                                        <td>{{$demande->cne}}</td>
                                        <td>{{$demande->nom}}</td>
                                        <td>{{$demande->prenom}}</td>
                                        <td>{{$demande->date_retrait}}</td>
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
