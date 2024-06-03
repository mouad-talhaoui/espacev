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
                        <h4 class="page-title">LES ATTESTATIONS</h4>
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
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Changer l'état à 'En attente'
                            </button>
                        </form>
                        <br>
                            <table id="datatable" class="table table-striped table-bordered" >
                                <thead>
                                <tr>
                                    <th>Apogee</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Type</th>
                                    <th>date de</th>
                                    <th>Etat </th>

                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demandes as $demande)
                                      <tr>
                                        <td>{{$demande->codapo}}</td>
                                        <td>{{$demande->nom}}</td>
                                        <td>{{$demande->prenom}}</td>
                                        <td>
                                         @switch($demande->type_demande)
                                             @case("attestation_inscription")
                                             Attestation d'inscription
                                             @break
                                             @case("releve_note")
                                             @foreach ($demande->releve_note as $item)
                                               {{$item}}
                                                <br>
                                             @endforeach
                                             @break
                                             @case("attestation_reussit")
                                             Attestation Reussit S1 & S2
                                             @break
                                             @case("attestation_deug")
                                             Attestation DEUG
                                             @break
                                             @case("attestation_licence")
                                             Attestation LICENCE
                                             @break
                                             @default
                                         @endswitch
                                        </td>
                                        <td>{{$demande->created_at}}</td>
                                        <td>{{$demande->etat_demande}}</td>
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
