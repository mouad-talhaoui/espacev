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
                        <h4 class="page-title">Activation des demandes de retrait de Bac</h4>
                        <div class="breadcrumb p-0">
                            <form action="{{route('fonctionnaire.bac_expiree')}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger">Supprimer les demandes expirées</button>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xs-12 col-lg-12 col-xl-12">
                    <div class="card-box">
                        <h5>Choisissez un Intervalle de Dates</h5>

                        <form action="{{route('fonctionnaire.activer_between')}}" method="post" class="form-inline">
                            @csrf
                            <div class="form-group">
                            <input type="date" placeholder="debut" name="date_debut" class="form-control" required>
                            </div>
                            <div class="form-group">
                            <input type="date" placeholder="fin" name="date_fin" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Activer</button>
                        </form>
                        <br>
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        <br>
                         @endif
                        <table id="datatable" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>Apogee</th>
                                <th>CNE</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Réactivation</th>
                                <th>back to traité</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($demandes as $demande)
                                    <tr>
                                    <td>{{$demande->codapo}}</td>
                                    <td>{{$demande->cne}}</td>
                                    <td>{{$demande->nom}}</td>
                                    <td>{{$demande->prenom}}</td>
                                    <td>
                                        <form action="{{ route('fonctionnaire.activer_seul_bac', $demande->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Activer</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('fonctionnaire.traite_bac', $demande->id) }}" method="post">
                                            @csrf
                                        <input type="text" name="num_arrchive" id="" class="form-control form-control-warning" required>
                                        <button type="submit" class="btn btn-warning">Traité</button>
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
