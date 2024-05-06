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
                            <h4 class="page-title">Reclamations des notes</h4>

                            <div class="clearfix"></div>

                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xs-12 col-lg-12 col-xl-12">
                        <div class="card-box">
                           <h4 class="header-title m-t-0 m-b-20">Votre Reclamation</h4>
                            <form action="{{route('etudiant.backtoreclamer')}}" method="post">
                                @csrf

                                    <div class="col-xs-12 m-3">
                                        <h5>Soumettre une réclamation sur le module:<br></h5> <br>
                                        <h4><span class="pull-xs-right"> : تقديم شكاية تخص مادة</span></h4>
                                        <br>
                                        <h5 class="text-xs-center text-info">{{$module->section_get_id->module_get_id->lib_module}}</h5>
                                    </div>
                                <div class="row">
                                    <div class="col-xs-4 col-md-4 m-t-3">
                                    </div>
                                    <div class="col-xs-4 col-md-4 m-t-3">
                                        <input type="hidden" name="idip" value="{{$module->id}}">
                                        <select class="form-control" name="type_reclamation" aria-label=".form-select-lg example">
                                            <option selected disabled>نوع الشكاية</option>
                                            <option value="note">إعادة التصحيح</option>
                                            <option value="abscent">(ABP)مسجل غائب</option>
                                        </select>
                                        <br>

                                        @if ($countConvocation==0)
                                        <input class="form-control" type="text" name="salle" placeholder="Salle Examen">
                                        @endif
                                    </div>
                                    <div class="col-xs-4 col-md-4 m-t-3">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-md-12">
                                        <a href="{{ route('etudiant.reclamationNote') }}" class="btn btn-primary">رجوع</a>
                                        <input type="submit" class="btn btn-success ml-2" value="تقديم شكاية">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- end col-->
                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

    </div>
    <!-- End content-page -->
@endsection
