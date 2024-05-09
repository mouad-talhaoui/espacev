<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>
                <li class="has_sub">
                    <a href="{{ route('apogee.index') }}" class="waves-effect"><i
                            class="zmdi zmdi-view-dashboard"></i><span> Tableau de bord </span> </a>
                </li>

                <li class="has_sub">
                    <a href="{{ route('apogee.confirmation') }}" class="waves-effect"><i class="zmdi zmdi-calendar"></i><span> Paramétres </span> </a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-accounts"></i>
                        <span>Etudiants</span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li class="has_sub">
                            <a href="{{ route('apogee.filieres') }}"><span>Gestion des filières</span> </a>
                        </li>
                        <li class="has_sub">
                            <a href="{{ route('apogee.etudiants') }}"><span>Gestion des étudiants</span> </a>
                        </li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-format-list-bulleted"></i>
                        <span>IP</span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li class="has_sub">
                            <a href="{{ route('apogee.modules') }}"><span>Gestion des modules</span> </a>
                        </li>
                        <li class="has_sub">
                            <a href="{{ route('apogee.sections') }}"><span>Gestion des sections</span> </a>
                        </li>
                        <li class="has_sub">
                            <a href="{{ route('apogee.ips') }}"><span>Gestion des IPs</span> </a>
                        </li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-file-text"></i>
                        <span>Convocation</span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li class="has_sub">
                            <a href="{{ route('apogee.local') }}"><span>Gestion des locaux</span> </a>
                        </li>

                        <li class="has_sub">
                            <a href="{{ route('apogee.numerotation') }}"><span>Gestion des numérotation</span> </a>
                        </li>

                        <li class="has_sub">
                            <a href="{{ route('apogee.profs') }}"><span>Gestion des Profs</span> </a>
                        </li>

                        <li class="has_sub">
                            <a href="{{ route('apogee.seances') }}"><span>Gestion des séances</span> </a>
                        </li>

                        <li class="has_sub">
                            <a href="{{ route('apogee.creneau') }}"><span>Gestion des créneaux</span> </a>
                        </li>

                        <li class="has_sub">
                            <a href="{{ route('apogee.planning') }}"><span>Gestion Planning</span> </a>
                        </li>

                        <li class="has_sub">
                            <a href="{{ route('apogee.convocation') }}"><span>Gestion des convocations</span> </a>
                        </li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="{{ route('apogee.notes') }}" class="waves-effect"><i
                            class="zmdi zmdi-border-color"></i><span>Réclamation des notes</span> </a>
                </li>

                <li class="has_sub">
                    <a href="{{ route('apogee.attes') }}" class="waves-effect"><i
                            class="zmdi zmdi-assignment-o"></i><span>Attestations de réussite</span> </a>
                </li>

                <li class="has_sub">
                    <a href="{{ route('apogee.diplomes') }}" class="waves-effect"><i
                            class="zmdi zmdi-assignment-o"></i><span>Diplômes</span> </a>
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>

</div>
<!-- Left Sidebar End -->
