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
                            <h4 class="page-title">Mes demandes</h4>

                            <div class="clearfix"></div>

                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xs-12 col-lg-12 col-xl-12">
                        <div class="card-box">
                           <h4 class="header-title m-t-0 m-b-20">Sélectionner le type de demande - اختر نوع الطلب</h4>
                           <div class="row">
                           <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-6">
                            <form action="{{route('etudiant.demander')}}" method="post">
                                @csrf
                                <select class="form-control" name="demander" aria-label=".form-select-lg example">
                                    <option selected disabled>
                                        Sélectionner le type de demande - اختر نوع الطلب
                                    </option>
                                    @if((Auth::guard("etudiant")->user()->stuation_autmn=="Inscrit" || Auth::guard("etudiant")->user()->stuation_print=="Inscrit") && $attestation==null)
                                    @if(!in_array(Auth::guard('etudiant')->user()->id."-attestation_inscription",$codes_demandes))
                                    <option value="attestation_inscription">
                                        Attestation D'inscription - شهادة التسجيل
                                   </option>
                                   @endif
                                   @endif
                                    @if((Auth::guard("etudiant")->user()->stuation_S7=="Inscrit" || Auth::guard("etudiant")->user()->stuation_S8=="Inscrit" ||Auth::guard("etudiant")->user()->stuation_S10=="Inscrit" ||Auth::guard("etudiant")->user()->stuation_S9=="Inscrit" ) && $attestation==null)
                                    @if(!in_array(Auth::guard('etudiant')->user()->id."-attestation_master",$codes_demandes))
                                    <option value="attestation_master">
                                        Attestation D'inscription - Master - شهادة التسجيل للماستر
                                   </option>
                                   @endif
                                   @endif
                                    @if(Auth::guard("etudiant")->user()->stuation_S1=="Valide" && Auth::guard("etudiant")->user()->stuation_S2=="Valide" && $date_delivre=="NULL")
                                    @if(!in_array(Auth::guard('etudiant')->user()->id."-attestation_reussit",$codes_demandes))
                                    <option value="attestation_reussit">
                                        Attestation de reussits S1_S2 - شهادة النجاح الفصل الاول والثاني
                                   </option>
                                   @endif
                                   @endif
                                   @if($date_retrait=="NULL")
                                   @if(!in_array(Auth::guard('etudiant')->user()->id."-bac_rp",$codes_demandes) && !in_array(Auth::guard('etudiant')->user()->id."-bac_rdc",$codes_demandes))
                                     <option value="retrait_bac">
                                        Retrait du Baccaluaréat-سحب شهادة الباكلوريا
                                   </option>
                                   @endif
                                   @endif
                                   @if($releve_note==null)
                                   @if(!in_array(Auth::guard('etudiant')->user()->id."-releve_note",$codes_demandes))
                                   <option value="releve_note">
                                    Relevé de Notes - Licence - بيان النقط للإجازة
                                   </option>
                                  @endif
                                   @endif
                                   @if($releve_note_master==null)
                                   @if(!in_array(Auth::guard('etudiant')->user()->id."-releve_note_master",$codes_demandes))
                                   <option value="releve_note_master">
                                    Relevé de Notes- Master - بيان النقط  للماستر
                                   </option>
                                  @endif
                                   @endif
                                   @if($diplomes != null)
                                   @foreach ($diplomes as $diplome)
                                   @if($diplome->type_deplome=="master")
                                   @if(!in_array(Auth::guard('etudiant')->user()->id."-master",$codes_demandes))
                                   <option value="master">
                                    RETRAIT DU DIPLÔME MASTER - سحب شهادة الماستر
                                   </option>
                                   @endif
                                   @endif
                                   @if($diplome->type_deplome=="master" && $diplome->date_edition=="NON" && $diplome->date_retrait=="NULL" && $diplome->date_deliberation !="NULL")
                                   @if(!in_array(Auth::guard('etudiant')->user()->id."-attestation_master",$codes_demandes))
                                   <option value="attestation_reussit_master">
                                    Attestation de Réussite Master  - شهادة النجاح للماستر
                                   </option>
                                   @endif
                                   @endif
                                   @if($diplome->type_deplome=="licence")
                                   @if(!in_array(Auth::guard('etudiant')->user()->id."-licence",$codes_demandes))
                                   <option value="licence">
                                    RETRAIT DU DIPLÔME DE LA LICENCE - سحب شهادة الإجازة
                                   </option>
                                   @endif
                                   @endif
                                   @if($diplome->type_deplome=="deug")
                                   @if(!in_array(Auth::guard('etudiant')->user()->id."-deug",$codes_demandes))
                                   <option value="deug">
                                    RETRAIT DU DIPLÔME DEUG - سحب دبلوم الدراسات الجامعية العامة
                                   </option>
                                   @endif
                                   @endif
                                   @if($diplome->type_deplome=="licence" && $diplome->date_edition=="NON" && $diplome->date_retrait=="NULL" && $diplome->date_deliberation !="NULL")
                                   @if(!in_array(Auth::guard('etudiant')->user()->id."-attestation_licence",$codes_demandes))
                                   <option value="attestation_licence">
                                    Attestation de Réussite Licence  - شهادة النجاح للاجازة
                                   </option>
                                   @endif
                                   @endif
                                   @if($diplome->type_deplome=="deug" && $diplome->date_edition=="NON" && $diplome->date_retrait=="NULL" && $diplome->date_deliberation !="NULL")
                                   @if(!in_array(Auth::guard('etudiant')->user()->id."-attestation_deug",$codes_demandes))
                                   <option value="attestation_deug">
                                    Attestation de Réussite DEUG   - شهادة النجاح للدراسات الجامعية العامة
                                   </option>
                                   @endif
                                   @endif
                                   @endforeach
                                   @endif
                                  </select>
                                  <br>
                                  <input type="submit"  class="btn btn-primary" value="Suivant">
                                  <br><br>
                            </form>
                           </div>
                           </div>
                            <h4 class="header-title m-t-0 m-b-20">Liste des demandes précédentes</h4>
                            <table id="datatable" class="table table-striped table-bordered" >
                                <thead>
                                <tr>
                                    <th>Type de demande</th>
                                    <th>date de demande</th>
                                    <th>Statut</th>
                                    <th>Classement de demande</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demandes as $demande)
                                      <tr>
                                        <td>
                                         @switch($demande->type_demande)
                                             @case("attestation_reussit")
                                             Attestation de reussits S1_S2 - شهادة النجاح الفصل الاول والثاني
                                             @break
                                             @case("bac_rp")
                                             Retrait Provisoire du Baccaluréat-السحب المؤقت للباكلوريا
                                             @break
                                             @case("bac_rdc")
                                             Retrait Définitif du Baccaluréat - السحب النهائي للباكلوريا
                                             @break
                                             @case("releve_note")
                                             Relevé de Notes - بيان النقط
                                             @break
                                             @case("attestation_deug")
                                             Attestation de Réussite DEUG   - شهادة النجاح للدراسات الجامعية العامة
                                             @break
                                             @case("attestation_licence")
                                             Attestation de Réussite Licence  - شهادة النجاح للاجازة
                                             @break
                                             @case("deug")
                                             RETRAIT DU DIPLÔME DEUG - سحب دبلوم الدراسات الجامعية العامة
                                             @break
                                             @case("licence")
                                             RETRAIT DU DIPLÔME DE LA LICENCE - سحب شهادة الإجازة
                                             @break
                                             @case("master")
                                             RETRAIT DU DIPLÔME MASTER - سحب شهادة الماستر
                                             @break
                                             @case("attestation_master")
                                             Attestation de Réussite Master  - شهادة النجاح للماستر
                                             @break
                                             @case("attestation_inscription")
                                             Attestation D'inscription - شهادة التسجيل
                                             @break
                                             @case("releve_note_master")
                                             Relevé de Notes- Master - بيان النقط - للماستر
                                             @break
                                             @default
                                         @endswitch
                                        </td>
                                        <td>{{$demande->created_at}}</td>
                                        <td>{{$demande->etat_demande}}</td>
                                        <td>
                                        @if($demande->num_archive === 'NULL')

                                        @else
                                        {{$demande->num_archive}} @endif</td>
                                        <td>
                                            @if($demande->etat_demande ==="encour")
                                             <form action="{{route('etudiant.deletedemande',$demande->id)}}" method="post">
                                                @csrf
                                                <input type="submit" value="Delete">
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
@endsection
