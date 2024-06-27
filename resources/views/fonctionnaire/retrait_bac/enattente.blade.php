@extends('fonctionnaire.dashboard')
@section('fonctionnaire')

    <!-- DataTables -->
    <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <!-- Responsive datatable examples -->
    <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css"/>

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
                            <h4 class="page-title">LES DEMANDES DE RETRAIT DE BACCALAURÉAT EN ATTENTE</h4>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            @if (session('alert'))
                            <div class="alert alert-{{ session('alert')}}">
                                {{ session('msg') }}
                            </div>
                            @endif
                            <form action="{{route('fonctionnaire.to_encour')}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Changer l'état à 'ENCOUR'
                                </button>
                            </form>
                            <br>
                            <h5>Importer la liste pour changer l'état en masse:</h5><br>
                            <form action="{{route('fonctionnaire.excel_traite')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="excel_traite" required ><br><br>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Importer
                                </button>
                            </form>
                            <br><br>
                            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Type</th>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>date de</th>
                                        <th>Etat </th>
                                        <th>Classement</th>
                                        <th>Num Archive </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demandes as $demande)
                                    <tr>
                                        <td>{{$demande->id}}</td>
                                        <td>{{$demande->nom}}</td>
                                        <td>{{$demande->prenom}}</td>
                                        <td>
                                            @switch($demande->type_demande)
                                                @case("bac_rp")
                                                RP
                                                @break
                                                @case("bac_rdc")
                                                RDC
                                                @break
                                                @default
                                            @endswitch
                                        </td>
                                        <td>{{$demande->created_at}}</td>
                                        <td>{{$demande->etat_demande}}</td>
                                        <td>
                                            <form action="{{ route('fonctionnaire.traite_bac', $demande->id) }}" method="post">
                                                @csrf
                                            <input type="text" class="form-control" name="num_arrchive" id="" required>
                                            <button type="submit" class="btn btn-primary">Traiter</button>
                                            </form>
                                        </td>
                                        <td>@php
                                            $nums = App\Models\bac::where('codapo', $demande->codapo)->orwhere("cne",$demande->cne)->get();
                                            @endphp
                                        @foreach ($nums as $num)
                                        {{$num->num_archive}} / {{$num->annee_inscription}}
                                        <br>
                                        @endforeach
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
