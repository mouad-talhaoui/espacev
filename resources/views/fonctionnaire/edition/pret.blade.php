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
                        <h4 class="page-title">Retrait Bac</h4>
                        <div class="clearfix"></div>
                        <form action="{{route('fonctionnaire.activer_between')}}" method="post">
                            @csrf
                            <input type="date" placeholder="debut" name="date_debut" required>
                            <br>
                            <input type="date" placeholder="fin" name="date_fin" required>
                            <br>
                            <div class="form-group">
                                <label for="option1">Relvé note</label>
                                <input type="radio" name="myOption" id="option1" value="releve_note_master">
                                <label for="option2">Attestation d'inscription</label>
                                <input type="radio" name="myOption" id="option2" value="attestation_master">
                                <label for="option2">attestation reussit</label>
                                <input type="radio" name="myOption" id="option2" value="attestation_reussit_master">
                            </div>
                            <input type="submit" value="Activer">
                        </form>
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
                                    <th>Apogee</th>
                                    <th>CNE</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Type de Demande </th>
                                    <th>classement du demande</th>
                                    <th>Réactivation</th>

                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demandes as $demande)
                                      <tr>
                                        <td>{{$demande->codapo}}</td>
                                        <td>{{$demande->cne}}</td>
                                        <td>{{$demande->nom}}</td>
                                        <td>{{$demande->prenom}}</td>
                                        <td>@switch($demande->type_demande)
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
                                        @endswitch</td>
                                        <td>
                                        {{$demande->num_archive}}
                                        </td>
                                        <td>
                                            <form action="{{ route('fonctionnaire.activer_seul_bac', $demande->id) }}" method="post">
                                                @csrf
                                            <input type="submit" value="َActiver">
                                            </form>
                                        </td>
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
