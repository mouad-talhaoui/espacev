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
                            <h4 class="page-title">Demandes des notes</h4>

                            <div class="clearfix"></div>

                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xs-12 col-lg-12 col-xl-12">
                        <div class="card-box">
                           <h4 class="header-title m-t-0 m-b-20">Votre demandes</h4>
                            <form action="{{route('etudiant.backtodemande')}}" method="post">
                                @csrf
                                @switch($demande[0])
                                    @case("attestation_reussit")
                                    <div class="col-xs-12 m-3">
                                        <div class="col-xs-12 text-xs-center">
                                            <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[2]}}</h6>
                                            <br>
                                            <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[1]}}</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4 col-md-4 m-t-3">
                                        </div>
                                        <div class="col-xs-4 col-md-4 m-t-3">
                                            <input type="hidden" name="type_demande" value="{{$demande[0]}}">
                                        </div>
                                        <div class="col-xs-4 col-md-4 m-t-3">
                                        </div>
                                    </div>
                                    @break
                            @case("retrait_bac")
                            <div class="col-xs-12 text-xs-center">
                                <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[2]}}</h6>
                                <br>
                                <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[1]}}</h6>
                            </div>
                            <div class="row">
                                <input type="hidden" name="type_demande" value="{{$demande[0]}}">
                                <div class="col-xs-4 col-md-4 m-t-3">
                                </div>
                                <div class="col-sm-10">
                                    <div class="radio">
                                        <input type="radio" name="type_retrait" id="radio1" value="bac_rp"
                                            checked>
                                        <label for="radio1">
                                            Retrait Provisoire du Baccaluréat - السحب المؤقت للباكلوريا
                                        </label>
                                    </div>
                                    <br>
                                    <div class="radio">
                                        <input type="radio" name="type_retrait" id="radio2" value="bac_rdc">
                                        <label for="radio2">
                                            Retrait Définitif du Baccaluréat - السحب النهائي للباكلوريا
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-md-4 m-t-3">
                                </div>
                            </div>
                                  @break
                            @case("releve_note")
                            <div class="col-xs-12 text-xs-center">
                                <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[2]}}</h6>
                                <br>
                                <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[1]}}</h6>
                            </div>

                            <div class="row">
                                <input type="hidden" name="type_demande" value="{{$demande[0]}}">

                                <div class="col-xs-4 col-md-4 m-t-3">
                                    @if(Auth::guard("etudiant")->user()->stuation_S1=="Valide" || Auth::guard("etudiant")->user()->stuation_S1=="Non Valide")
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkboxs1" type="checkbox" name="releve[]" value="releve_S1">
                                        <label for="checkboxs1">
                                            <strong> S1 </strong>
                                        </label>
                                    </div>
                                    @endif
                                    @if(Auth::guard("etudiant")->user()->stuation_S2=="Valide"|| Auth::guard("etudiant")->user()->stuation_S2=="Non Valide")
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkboxs2" type="checkbox" name="releve[]" value="releve_S2">
                                        <label for="checkboxs2">
                                            <strong> S2 </strong>
                                        </label>
                                    </div>
                                    @endif

                                    @if(Auth::guard("etudiant")->user()->stuation_S3=="Valide"|| Auth::guard("etudiant")->user()->stuation_S3=="Non Valide")
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkboxs3" type="checkbox" name="releve[]" value="releve_S3">
                                        <label for="checkboxs3">
                                            <strong> S3 </strong>
                                        </label>
                                    </div>
                                    @endif

                                    @if(Auth::guard("etudiant")->user()->stuation_S4=="Valide"|| Auth::guard("etudiant")->user()->stuation_S4=="Non Valide")
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkboxs4" type="checkbox" name="releve[]" value="releve_S4">
                                        <label for="checkboxs4">
                                            <strong> S4 </strong>
                                        </label>
                                    </div>
                                    @endif

                                    @if(Auth::guard("etudiant")->user()->stuation_S5=="Valide"|| Auth::guard("etudiant")->user()->stuation_S5=="Non Valide")
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkboxs5" type="checkbox" name="releve[]" value="releve_S5">
                                        <label for="checkboxs5">
                                            <strong> S5 </strong>
                                        </label>
                                    </div>
                                    @endif

                                    @if(Auth::guard("etudiant")->user()->stuation_S6=="Valide"|| Auth::guard("etudiant")->user()->stuation_S6=="Non Valide")
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkboxs6" type="checkbox" name="releve[]" value="releve_S6">
                                        <label for="checkboxs6">
                                            <strong> S6 </strong>
                                        </label>
                                    </div>
                                    @endif
                                </div>

                            </div>
                                  @break
                                  @case("releve_note_master")
                                  <div class="col-xs-12 text-xs-center">
                                      <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[2]}}</h6>
                                      <br>
                                      <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[1]}}</h6>
                                  </div>
                                  <div class="row">
                                      <input type="hidden" name="type_demande" value="{{$demande[0]}}">
                                      <div class="col-xs-4 col-md-4 m-t-3">
                                    @if(Auth::guard("etudiant")->user()->stuation_S7=="Valide"|| Auth::guard("etudiant")->user()->stuation_S7=="Non Valide")
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkboxs7" type="checkbox" name="releve[]" value="releve_S7">
                                        <label for="checkboxs7">
                                            <strong> S7 </strong>
                                        </label>
                                    </div>
                                    @endif
                                    @if(Auth::guard("etudiant")->user()->stuation_S8=="Valide" || Auth::guard("etudiant")->user()->stuation_S8=="Non Valide")
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkboxs8" type="checkbox" name="releve[]" value="releve_S8">
                                        <label for="checkboxs8">
                                            <strong> S8 </strong>
                                        </label>
                                    </div>
                                    @endif
                                    @if(Auth::guard("etudiant")->user()->stuation_S9=="Valide"|| Auth::guard("etudiant")->user()->stuation_S9=="Non Valide")
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkboxs9" type="checkbox" name="releve[]" value="releve_S9">
                                        <label for="checkboxs9">
                                            <strong> S9 </strong>
                                        </label>
                                    </div>
                                    @endif
                                    @if(Auth::guard("etudiant")->user()->stuation_S10=="Valide"|| Auth::guard("etudiant")->user()->stuation_S10=="Non Valide")
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkboxs10" type="checkbox" name="releve[]" value="releve_S10">
                                        <label for="checkboxs10">
                                            <strong> S10 </strong>
                                        </label>
                                    </div>
                                    @endif
                                      </div>
                                     @break
                                  @case("master")
                                  <div class="col-xs-12 text-xs-center">
                                    <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[2]}}</h6>
                                    <br>
                                    <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[1]}}</h6>
                                </div>
                              <div class="row">
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                  </div>
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                      <input type="hidden" name="type_demande" value="{{$demande[0]}}">
                                  </div>
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                  </div>
                              </div>
                                  @break
                                  @case("attestation_master")
                                  <div class="col-xs-12 text-xs-center">
                                    <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[2]}}</h6>
                                    <br>
                                    <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[1]}}</h6>
                                </div>
                              <div class="row">
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                  </div>
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                      <input type="hidden" name="type_demande" value="{{$demande[0]}}">
                                  </div>
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                  </div>
                              </div>
                                  @break
                                  @case("attestation_reussit_master")
                                  <div class="col-xs-12 text-xs-center">
                                    <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[2]}}</h6>
                                    <br>
                                    <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[1]}}</h6>
                                </div>
                              <div class="row">
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                  </div>
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                      <input type="hidden" name="type_demande" value="{{$demande[0]}}">
                                  </div>
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                  </div>
                              </div>
                                  @break
                                  @case("licence")
                                  <div class="col-xs-12 text-xs-center">
                                    <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[2]}}</h6>
                                    <br>
                                    <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[1]}}</h6>
                                </div>
                              <div class="row">
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                  </div>
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                      <input type="hidden" name="type_demande" value="{{$demande[0]}}">
                                  </div>
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                  </div>
                              </div>
                                  @break
                                  @case("deug")
                                  <div class="col-xs-12 text-xs-center">
                                    <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[2]}}</h6>
                                    <br>
                                    <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[1]}}</h6>
                                </div>
                              <div class="row">
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                  </div>
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                      <input type="hidden" name="type_demande" value="{{$demande[0]}}">
                                  </div>
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                  </div>
                              </div>
                              </div>
                                  @break
                                  @case("attestation_licence")
                                  <div class="col-xs-12 text-xs-center">
                                    <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[2]}}</h6>
                                    <br>
                                    <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[1]}}</h6>
                                </div>
                              <div class="row">
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                  </div>
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                      <input type="hidden" name="type_demande" value="{{$demande[0]}}">
                                  </div>
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                  </div>
                              </div>
                              </div>
                                  @break
                                  @case("attestation_deug")
                                  <div class="col-xs-12 text-xs-center">
                                    <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[2]}}</h6>
                                    <br>
                                    <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[1]}}</h6>
                                </div>
                              <div class="row">
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                  </div>
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                      <input type="hidden" name="type_demande" value="{{$demande[0]}}">
                                  </div>
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                  </div>
                              </div>
                              </div>
                                  @break
                                  @case("attestation_inscription")
                                  <div class="col-xs-12 m-3">
                                    <div class="col-xs-12 text-xs-center">
                                        <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[2]}}</h6>
                                        <br>
                                        <h6 class="text-primary text-uppercase m-b-0 m-t-0">{{$demande[1]}}</h6>
                                    </div>
                                </div>
                              <div class="row">
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                  </div>
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                      <input type="hidden" name="type_demande" value="{{$demande[0]}}">
                                  </div>
                                  <div class="col-xs-4 col-md-4 m-t-3">
                                  </div>
                              </div>
                                  @break
                                    @default
                                @endswitch

                                <br><br>
                                <div class="row">
                                    <div class="col-xs-12 col-md-12">
                                        <a href="{{ route('etudiant.demandes') }}" class="btn btn-primary">رجوع</a>
                                        <input type="submit" class="btn btn-success ml-2" value="تأكيد الطلب">
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
