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
                        <h4 class="page-title">ATtestation</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xs-12 col-lg-12 col-xl-12">
                    <div class="card-box">
                        @if (session('alert'))
                        <div class="alert alert-{{ session('alert')}}">
                            {{ session('msg') }}
                        </div>
                    @endif
                        <form action="{{route('fonctionnaire.to_encour')}}" method="post">
                            @csrf
                            <input type="submit" value="RTOUR A ETAT ُENCOUR">
                        </form>
                        <form action="{{route('fonctionnaire.excel_traite')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="excel_traite" required >
                            <input type="submit" value="Change Etat">
                        </form>
                        <h4 class="header-title m-t-0 m-b-20">Espace de fonctionnaire</h4>
                            <table id="datatable" class="table table-striped table-bordered" >
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
