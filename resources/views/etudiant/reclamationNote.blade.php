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
                            <h4 class="page-title">Reclamations des notes</h4>

                            <div class="clearfix"></div>

                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xs-12 col-lg-12 col-xl-12">
                        <div class="card-box">
                           <h4 class="header-title m-t-0 m-b-20">Votre Reclamation</h4>
                           <div class="row">
                           <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-6">
                            <form action="{{route('etudiant.reclamer')}}" method="post">
                                @csrf
                                <select class="form-control" name="reclamer" aria-label=".form-select-lg example">
                                    <option selected disabled>Choisissez le module - اختر المادة</option>
                                    @foreach ($queryReclamtionNote as $reclamation )
                                    @if($reclamation->section_get_id->module_get_id->semester=="S5" || $reclamation->section_get_id->module_get_id->semester=="S3" )
                                    <option value="{{$reclamation->id}}" >{{$reclamation->section_get_id->module_get_id->lib_module}}</option>
                                    @endif
                                    @endforeach
                                  </select>
                                  <br>
                                  <input type="submit"  class="btn btn-primary" value="Suivant">
                                  <br><br>
                            </form>
                           </div>
                           </div>

                            @if (count($querygetReclamations) > 0)
                            <h4 class="header-title m-t-0 m-b-20">List des Reclamations</h4>
                            <table id="datatable" class="table table-striped table-bordered" >
                                <thead>
                                <tr>
                                    <th>Module</th>
                                    <th>date</th>
                                    <th>Type</th>
                                    <th>Etat</th>
                                    <th>Réponse</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($querygetReclamations as $getreclamation)
                                     <tr>
                                        <td>{{$getreclamation->ip_get_id->section_get_id->module_get_id->lib_module}}</td>
                                        <td>{{$getreclamation->created_at}}</td>
                                        @if ($getreclamation->type_reclamation=="note")
                                        <td>إعادة التصحيح</td>
                                        @else
                                        <td> مسجل غائب</td>
                                        @endif
                                        <td>{{$getreclamation->etat_reclamation}}</td>
                                        <td>{{$getreclamation->reponse_apogee}}</td>
                                     </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif

                        </div>
                    </div><!-- end col-->
                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

    </div>
    <!-- End content-page -->
@endsection
