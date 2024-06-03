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
                            <h4 class="page-title">LES DEMANDES DE RETRAIT DE BACCALAURÉAT EN COURS</h4>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <form action="{{route('fonctionnaire.to_enatente')}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Changer l'état à 'En attente'
                                </button>
                            </form>
                            <br>

                            <table id="datatable" class="table table-striped table-bordered" cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>date demande</th>
                                    <th>Etat</th>
                                    <th>Num Archive</th>
                                </tr>
                                </thead>


                                <tbody>
                                    @foreach ($demandes as $demande)
                                    <tr>
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
                    </div>
                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

    </div>
    <!-- End content-page -->
    @endsection
