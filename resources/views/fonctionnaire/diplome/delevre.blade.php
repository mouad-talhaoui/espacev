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
                    <div class="card-box">
                        <table id="datatable" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>Apogee</th>
                                <th>CNE</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Type de Demande </th>
                                <th>date de delivré</th>

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
                                            @case("master")
                                            MASTER
                                            @break
                                            @case("deug")
                                           DEUG
                                            @break
                                            @case("licence")
                                            LICENCE
                                            @break
                                            @default
                                        @endswitch
                                    </td>
                                    <td>
                                    {{$demande->num_archive}}
                                    </td>
                                    <td>
                                       {{$demande->updated_at}}
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
