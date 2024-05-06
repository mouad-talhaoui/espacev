@extends('professeur.dashboard')
@section('professeur')

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
                        <h4 class="page-title">Réclamations des notes</h4>

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
                                    <th>Code réclamation</th>
                                    <th>code apogee</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Type de réclamation</th>
                                    <th>Date de réclamation</th>
                                    <th>salle d'examen</th>
                                    <th>Num d'examen</th>
                                    <th>Matiére</th>
                                    <th>Section</th>
                                    </tr>
                            </thead>
                            <tbody>
                                @foreach ($reclamations as $reclamation)
                                @php
                                
                                  $convocation = App\Models\Convocation::where('id_ip', $reclamation->id_ip)->first();
                                  $ip = App\Models\Ip::where('id', $reclamation->id_ip)->first();

                                 @endphp
                                 <input type="hidden" id="changenom" value="Section {{$ip->section_get_id->section}}-{{$ip->section_get_id->module_get_id->lib_module}}-{{Auth::guard('professeur')->user()->nom}}">
                                  @if($reclamation->salle_examen=="NULL")
                                <tr>
                                    <td>{{ $reclamation->id }}</td>
                                    <td>{{$convocation->ip_get_id->codeapo }}</td>
                                    <td>{{$convocation->ip_get_id->etudiant_get_id->nom}}</td>
                                    <td>{{$convocation->ip_get_id->etudiant_get_id->prenom }}</td>
                                    @if ($reclamation->type_reclamation=="note")
                                    <td>إعادة التصحيح</td>
                                    @else
                                    <td> مسجل غائب</td>
                                    @endif
                                    <td>{{ $reclamation->date_reclamation }}</td>
                                    <td>{{$convocation->numerotation_get_id->local_get_id->id}}</td>
                                    <td>{{$convocation->numerotation_get_id->numero_place}}</td>
                                    <td>{{$convocation->ip_get_id->section_get_id->module_get_id->lib_module}}</td>
                                    <td>{{$convocation->ip_get_id->section_get_id->section}}</td>
                                </tr>
                                @else
                                <tr>
                                    <td>{{ $reclamation->id }}</td>
                                    <td>{{$ip->codeapo}}</td>
                                    <td>{{$ip->etudiant_get_id->nom}}</td>
                                    <td>{{$ip->etudiant_get_id->prenom }}</td>
                                    @if ($reclamation->type_reclamation=="note")
                                    <td>إعادة التصحيح</td>
                                    @else
                                    <td> مسجل غائب</td>
                                    @endif
                                    <td>{{ $reclamation->date_reclamation }}</td>
                                    <td>{{$reclamation->salle_examen}}</td>
                                    <td>-</td>
                                    <td>{{$ip->section_get_id->module_get_id->lib_module}}</td>
                                    <td>{{$ip->section_get_id->section}}</td>

                                </tr>
                                @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
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

