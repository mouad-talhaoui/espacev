@extends('professeur.dashboard')
@section('professeur')

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
                        <h4 class="page-title">Réclamations des notes</h4>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-xs-12 col-lg-12 col-xl-12">
                    <div class="card-box">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Module</th>
                                    <th>Section</th>
                                    <th>Lists</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($seances as $seance)
                                    <tr>
                                        <td>{{ $seance->lib_module }}</td>
                                        <td>{{ $seance->id_section }}</td>
                                        <td><a href="{{ route('professeur.reclamation.list', ['section' => $seance->id_section]) }}" class="btn btn-primary waves-effect waves-light">Afficher</a></td>
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


<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->

@endsection
