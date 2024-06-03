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
                        <h4 class="page-title">Diplôme</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xs-12 col-lg-12 col-xl-12">
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
                            <input type="file" name="excel_traite" required >
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Importer
                            </button>
                        </form>
                        <br>
                        <table id="datatable-buttons" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>type </th>
                                <th>Traité </th>
                                <th>Refusé</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($demandes as $demande)
                                    <tr>
                                    <td>{{$demande->nom}}</td>
                                    <td>{{$demande->prenom}}</td>
                                    <td>@switch($demande->type_demande)
                                        @case("deug")
                                        DEUG
                                        @break
                                        @case("licence")
                                                Licence
                                        @break
                                        @case("master")
                                        Master
                                        @break
                                        @default
                                    @endswitch</td>
                                    <td>
                                        <form action="{{ route('fonctionnaire.traite_bac', $demande->id) }}" method="post">
                                            @csrf
                                        <input type="text" name="num_arrchive" id="" required>
                                        <input type="submit" value="Traité">
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('fonctionnaire.refus_bac', $demande->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
