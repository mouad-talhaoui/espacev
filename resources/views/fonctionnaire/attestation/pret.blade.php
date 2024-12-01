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
                        <h5>Choisissez un Intervalle de Dates</h5>
                        <div class="row">
                            <form action="{{route('fonctionnaire.activer_between')}}" method="post" class="form-inline">
                                @csrf
                                   <div class="form-group">
                                        <input type="date" placeholder="debut" name="date_debut" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="date" placeholder="fin" name="date_fin" class="form-control" required>
                                    </div>
                                    <br><br>

                                    <div class="form-group row">
                                        <label class="col-sm-2">Type</label>
                                        <div class="col-sm-10">
                                            <div class="radio">
                                                <input type="radio" name="myOption" id="option1" value="releve_note"
                                                    checked>
                                                <label for="option1">
                                                    Relvé note
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <input type="radio" name="myOption" id="option2" value="attestation_inscription">
                                                <label for="option2">
                                                    Attestation d'inscription
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <input type="radio" name="myOption" id="option3" value="attestation_reussit">
                                                <label for="option3">
                                                    Attestation reussit
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <input type="radio" name="myOption" id="option4" value="attestation_deug">
                                                <label for="option4">
                                                    Attestation Deug
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <input type="radio" name="myOption" id="option5" value="attestation_licence">
                                                <label for="option5">
                                                    Attestation Licence
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    <br><br>
                                <button type="submit" class="btn btn-primary">Activer</button>
                            </form>
                    </div>
                    <br><br>
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
