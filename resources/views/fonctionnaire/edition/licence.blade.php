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
                        <h4 class="page-title">LICENCE</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xs-12 col-lg-12 col-xl-12">
                    <div class="card-box">
                        <form action="{{route('fonctionnaire.to_enatente')}}" method="post">
                            @csrf
                            <input type="submit" value="change etat a en attente">
                        </form>
                        <form action="{{route('fonctionnaire.excel_diplome')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="excel_diplome" required >
                            <input type="submit" value="diplôme prêt">
                        </form>
                        <h4 class="header-title m-t-0 m-b-20">Espace de fonctionnaire</h4>
                        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0"
                            width="100%">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Apogee</th>
                                    <th>diplome</th>
                                    <th>Edition</th>
                                    <th>date Delibration</th>
                                    <th>filiére</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($diplomes as $diplome)
                                      <tr>
                                        <td>{{$diplome->id}}</td>
                                        <td>{{$diplome->codapo}}</td>
                                        <td>{{$diplome->type_deplome}}</td>
                                        <td>{{$diplome->date_edition}}</td>
                                        <td>{{$diplome->date_deliberation}}</td>
                                        <td>{{$diplome->filiere_get_id->libelle_diplome}}</td>
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
