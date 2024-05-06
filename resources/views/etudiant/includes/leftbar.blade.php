<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>
                <li class="has_sub">
                    <a href="{{ route('etudiant.index') }}" class="waves-effect"><i
                            class="zmdi zmdi-view-dashboard"></i><span> ACCUEIL </span> </a>
                </li>
                @if ($param_confirm == 1)
                <li class="has_sub">
                    <a href="{{ route('etudiant.confirmation') }}" class="waves-effect"><i class="zmdi zmdi-calendar"></i><span> Confirmation de présence </span> </a>
                </li>
                @endif
                <li class="has_sub">
                    <a href="{{ route('etudiant.ip') }}" class="waves-effect"><i
                    class="zmdi zmdi-view-dashboard"></i><span> Inscription pedagogique </span> </a>
                </li>
               @if($param_convocation==1)
                <li class="has_sub">
                    <a href="{{ route('etudiant.convocation') }}" class="waves-effect"><i
                            class="zmdi zmdi-view-dashboard"></i><span> Convocation </span> </a>
                </li>
                @endif
                @if($param_reclamation_note==1)
                <li class="has_sub">
                    <a href="{{ route('etudiant.reclamationNote') }}" class="waves-effect"><i
                            class="zmdi zmdi-view-dashboard"></i><span> Reclamation des Notes </span> </a>
                </li>
                @endif
                <li class="has_sub">
                    <a href="{{ route('etudiant.demandes') }}" class="waves-effect"><i
                            class="zmdi zmdi-view-dashboard"></i><span>Mes Demandes </span></a>
                </li>

        </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>

</div>
<!-- Left Sidebar End -->
