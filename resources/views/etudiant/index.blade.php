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
                        <h4 class="page-title">Espace numérique de l'étudiant</h4>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

          <div class="row">
                <div class="col-xs-12 col-lg-12 col-xl-12">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="card-box">
                                <h4 class="header-title m-t-0 m-b-20">Les informations personnelles</h4>

                                <div class="inbox-widget nicescroll" style="height: 420px;">
                                    @if(Auth::guard('etudiant')->user()->nom || Auth::guard('etudiant')->user()->prenom)
                                        <div class="inbox-item">
                                            <p class="inbox-item-author header-title text-primary">Nom et prénom</p>
                                            <p class="inbox-item-text">
                                                @if(Auth::guard('etudiant')->user()->nom)
                                                    {{ Auth::guard('etudiant')->user()->nom }}
                                                @endif
                                                @if(Auth::guard('etudiant')->user()->prenom)
                                                    {{ Auth::guard('etudiant')->user()->prenom }}
                                                @endif
                                            </p>
                                        </div>
                                    @endif

                                    @if(Auth::guard('etudiant')->user()->email)
                                        <div class="inbox-item">
                                            <p class="inbox-item-author header-title text-primary">Email</p>
                                            <p class="inbox-item-text">{{ Auth::guard('etudiant')->user()->email }}</p>
                                        </div>
                                    @endif

                                    @if(Auth::guard('etudiant')->user()->date_naissance)
                                        <div class="inbox-item">
                                            <p class="inbox-item-author header-title text-primary">Date de naissance</p>
                                            <p class="inbox-item-text">{{ Auth::guard('etudiant')->user()->date_naissance }}</p>
                                        </div>
                                    @endif

                                    @if(Auth::guard('etudiant')->user()->id)
                                        <div class="inbox-item">
                                            <p class="inbox-item-author header-title text-primary">Code Apogée</p>
                                            <p class="inbox-item-text">{{ Auth::guard('etudiant')->user()->id }}</p>
                                        </div>
                                    @endif

                                    @if(Auth::guard('etudiant')->user()->cne)
                                        <div class="inbox-item">
                                            <p class="inbox-item-author header-title text-primary">Code national d'étudiant</p>
                                            <p class="inbox-item-text">{{ Auth::guard('etudiant')->user()->cne }}</p>
                                        </div>
                                    @endif

                                    @if(Auth::guard('etudiant')->user()->filiere_get_id->filiere_id)
                                    <div class="inbox-item">
                                        <p class="inbox-item-author header-title text-primary">Filière</p>
                                        <p class="inbox-item-text">
                                            <p class="inbox-item-text">Type de diplôme: {{ Auth::guard('etudiant')->user()->filiere_get_id->type_fil }}</p>
                                            <p class="inbox-item-text">{{ Auth::guard('etudiant')->user()->filiere_get_id->diplom }} : {{ Auth::guard('etudiant')->user()->filiere_get_id->libelle_diplome }}</p>
                                        </p>
                                    </div>
                                    @endif
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
