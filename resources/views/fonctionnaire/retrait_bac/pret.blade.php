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
                                    <th>RP ou RDC</th>
                                    <th>Etat </th>
                                    <th>classement du demande</th>
                                    <th>retour baccalauréat ?</th>
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
                                        <td>{{$demande->etat_demande}}</td>
                                        <td>
                                        {{$demande->num_archive}}
                                        </td>
                                        <td>
                                            @if($demande->type_demande==="bac_rp")
                                            <form action="{{ route('fonctionnaire.retour_bac', $demande->id) }}" method="post">
                                                @csrf
                                                <input type="submit" value="OUI">
                                            </form>
                                            @endif
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
