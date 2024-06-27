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
                            <h4 class="page-title">Convocation</h4>

                            <div class="clearfix"></div>

                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-xs-12 col-lg-12 col-xl-12">
                        <div class="card-box">
                            <div class="row">
                            <div class="col-xs-12 col-lg-12 col-xl-12">
                                <div class="d-flex justify-content-between">
                                <h4 class="header-title m-t-0 m-b-20">Votre convocation</h4>
                                <a href="{{route('etudiant.pdfconvocation')}}" target="_blank"class="btn btn-success btn-lg m-b-20 pull-lg-right" rel="noopener noreferrer">Imprimer</a>
                            </div>
                                <table id="datatable" class="table table-striped table-bordered" >
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Module</th>
                                        <th>filiére</th>
                                        <th>Semestre</th>
                                        <th>Section</th>
                                        <th>Date</th>
                                        <th>Heure</th>
                                        <th>Centre</th>
                                        <th>Salle/Amphi</th>
                                        <th>N° place</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                          @foreach ($queryConvocation as $convocation)
                          <tr>
                            <td>{{$convocation->id}}</td>
                            <td>{{$convocation->ip_get_id->section_get_id->module_get_id->lib_module}}</td>
                            <td>{{$convocation->ip_get_id->section_get_id->module_get_id->filiere_get_id->libelle_diplome}}</td>
                            <td>{{$convocation->ip_get_id->section_get_id->module_get_id->semester}}</td>
                            <td>{{$convocation->ip_get_id->section_get_id->section}}</td>
                            <td>{{$convocation->planning_get_id->creneau_get_id->date}}</td>
                            <td>{{$convocation->planning_get_id->creneau_get_id->heure}}</td>
                            <td>{{$convocation->numerotation_get_id->local_get_id->centre}}</td>
                            <td>{{$convocation->numerotation_get_id->local_get_id->id}}</td>
                            <td>{{$convocation->numerotation_get_id->numero_place}}</td>

                        </tr>
                          @endforeach
                        </table>

                    </div><!-- end col-->
                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

    </div>
    <!-- End content-page -->
</div>
@endsection
