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
                            <h4 class="page-title">Confirmation de présence aux examens</h4>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xs-12 col-lg-12 col-xl-12">
                        <div class="card-box">

                            <h4 class="header-title m-t-0 m-b-20">Confirmation de ma présence aux examens</h4>

                            <div class="text-xs-center">
                                @if($confirm==false)
                                <form method="POST" action="{{ route("etudiant.confirmation") }}">
                                    @csrf
                                    {{-- <input type="hidden" name="session" value='{{$session}}'> --}}
                                    <button type="submit"
                                            class="btn btn-block btn-lg btn-primary waves-effect waves-light">Confirmer
                                </button>
                                </form>

                                <p class="text-warning m-b-20 font-16">
                                <br>
                                Attention : Il n'est pas possible d'assister à l'examen sans remplir la confirmation de présence.
                                <br>
                                الرجاء الانتباه: لا يمكن الحضور إلى الامتحان دون تعبئة تأكيد الحضور.
                                 </p>

                            </div>
                            @else
                            <p class="text-success m-b-20 font-16">
                               Vous avez déjà confirmé <br>
                               لقد سبق لك تأكيد الحضور
                           </p>
                            @endif
                        </div>
                    </div><!-- end col-->
                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

    </div>
    <!-- End content-page -->
@endsection
