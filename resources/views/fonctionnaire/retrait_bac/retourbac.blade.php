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
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="page-title-box">
                        <h4 class="page-title">Retrait Bac</h4>
                        <div class="clearfix"></div>
                            <form action="{{route('fonctionnaire.activer_between')}}" method="post">
                                @csrf
                                <input type="date" placeholder="debut" name="date_debut" required>
                                <br>
                                <input type="date" placeholder="fin" name="date_fin" required>
                                <br>
                                <input type="submit" value="Activer">
                            </form>
                            <form action="{{route('fonctionnaire.bac_expiree')}}" method="post">
                                @csrf
                                <input type="submit" value="Supprimer les demandes expirées">
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
                                            <input type="submit" value="َActiver">
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('fonctionnaire.traite_bac', $demande->id) }}" method="post">
                                                @csrf
                                            <input type="text" name="num_arrchive" id="" required>
                                            <input type="submit" value="Traité">
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
