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
                        <h4 class="page-title">Dashboard</h4>
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
                                <strong></strong> {{ session('success') }}
                            </div>
                            @endif

                            <div class="card-box">
                                <h4 class="header-title m-t-0 m-b-20">Les paramètres de confirmation</h4>
                                <p class="text-muted m-b-20 font-13">
                                    vous pouvez verrouiller ou déverrouiller la confirmation de présence des étudiants.
                                </p>
                                <form method="POST" action="{{ route('apogee.checkconfirm') }}">
                                @csrf

                                <input type="hidden" name="id" value="{{ $parametre->id }}">

                                <input type="checkbox" onchange="changechecked()" id="checkboxconfirmation" name="checkboxconfirmation" data-plugin="switchery" data-color="#039cfd"
                                <?php if ($parametre->confirmation) { echo 'checked'; } ?> value="1" />

                                <div class="m-t-30">
                                    <h6 class="text-muted m-b-20 font-13">vous pouvez choisir la session.</h6>
                                    <label class="c-input c-radio">
                                        <input id="radio11" name="radiosession" value="automn" type="radio" <?php if ($parametre->session == 'automn') { echo 'checked'; } ?>>
                                        <span class="c-indicator"></span>
                                        Automn
                                    </label>
                                    </fieldset>

                                    <label class="c-input c-radio">
                                        <input id="radio21" name="radiosession" value="printemp" type="radio" <?php if ($parametre->session == 'printemp') { echo 'checked'; } ?>>
                                        <span class="c-indicator"></span>
                                        Printemp
                                    </label>
                                </div>
                                <br>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            </div>

                            <div class="card-box">
                                <h4 class="header-title m-t-0 m-b-20">Les paramètres de convocation</h4>
                                <p class="text-muted m-b-20 font-13">
                                    vous pouvez verrouiller ou déverrouiller l'affichage de convocation aux étudiants.
                                </p>
                                <form method="POST" action="{{ route('apogee.checkconvocation') }}">
                                @csrf

                                <input type="hidden" name="id" value="{{ $parametre->id }}">

                                <input type="checkbox" onchange="changechecked()" id="checkboxconvocation" name="checkboxconvocation" data-plugin="switchery" data-color="#039cfd"
                                <?php if ($parametre->convocation) { echo 'checked'; } ?> value="1" />

                                <div class="m-t-30">
                                    <h6 class="text-muted m-b-20 font-13">vous pouvez choisir la session.</h6>
                                    <label class="c-input c-radio">
                                        <input id="radio11" name="session_examen" value="normal" type="radio" <?php if ($parametre->session_examen == 'normal') { echo 'checked'; } ?>>
                                        <span class="c-indicator"></span>
                                        Normale
                                    </label>
                                    </fieldset>

                                    <label class="c-input c-radio">
                                        <input id="radio21" name="session_examen" value="rattrapage" type="radio" <?php if ($parametre->session_examen == 'rattrapage') { echo 'checked'; } ?>>
                                        <span class="c-indicator"></span>
                                        rattrapage
                                    </label>
                                </div>
                                <br>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            </div>
                            <div class="card-box">
                                <h4 class="header-title m-t-0 m-b-20">Les paramètres de Reclamation des Note</h4>
                                <p class="text-muted m-b-20 font-13">
                                    vous pouvez verrouiller ou déverrouiller l'affichage de Reclamation des Note aux étudiants.
                                </p>
                                <form method="POST" action="{{ route('apogee.checkreclamation') }}">
                                @csrf

                                <input type="hidden" name="id" value="{{ $parametre->id }}">

                                <input type="checkbox" onchange="changechecked()" id="checkboxreclamation" name="checkboxreclamation" data-plugin="switchery" data-color="#039cfd"
                                <?php if ($parametre->reclamation_note) { echo 'checked'; } ?> value="1" />

                                 <div class="m-t-30">
                                   <h6 class="text-muted m-b-20 font-13">vous pouvez choisir la session.</h6>
                                    <label class="c-input c-radio">
                                        <input id="radio11" name="session_reclamation" value="normal" type="radio" <?php if ($parametre->session_reclamation == 'normal') { echo 'checked'; } ?>>
                                        <span class="c-indicator"></span>
                                        Normale
                                    </label>
                                    </fieldset>

                                    <label class="c-input c-radio">
                                        <input id="radio21" name="session_reclamation" value="rattrapage" type="radio" <?php if ($parametre->session_reclamation == 'rattrapage') { echo 'checked'; } ?>>
                                        <span class="c-indicator"></span>
                                        rattrapage
                                    </label>
                                </div>
                                <br>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
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
