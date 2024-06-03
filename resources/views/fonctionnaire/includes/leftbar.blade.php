<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>
                @if(Auth::guard("fonctionnaire")->user()->tache === "edition")
                <li class="has_sub">
                    <a href="{{route('fonctionnaire.index')}}" class="waves-effect"><i
                        class="zmdi zmdi-view-dashboard"></i><span> DEUG</span> </a>
                </li>
                <li class="has_sub">
                    <a href="{{route('fonctionnaire.to_enatente')}}" class="waves-effect"><i
                    class="zmdi zmdi-view-dashboard"></i><span>LICENCE</span> </a>
                </li>
                <li class="has_sub">
                    <a href="{{route('fonctionnaire.pret')}}" class="waves-effect"><i
                    class="zmdi zmdi-view-dashboard"></i><span>MASTER</span> </a>
                </li>
                @else
                <li class="has_sub">
                    <a href="{{route('fonctionnaire.index')}}" class="waves-effect"><i
                        class="zmdi zmdi-calendar-note"></i><span>EN COUR</span></a>
                </li>
                <li class="has_sub">
                    <a href="{{route('fonctionnaire.to_enatente')}}" class="waves-effect"><i
                    class="zmdi zmdi-calendar-alt"></i><span>EN ATTENTE</span> </a>
                </li>
                <li class="has_sub">
                    <a href="{{route('fonctionnaire.pret')}}" class="waves-effect"><i
                    class="zmdi zmdi-calendar-check"></i><span>TRAITÉ</span> </a>
                </li>

                <li class="has_sub">
                    <a href="{{route('fonctionnaire.refus')}}" class="waves-effect"><i
                    class="zmdi zmdi-calendar-close"></i><span>REFUSÉ</span> </a>
                </li>
            @if(Auth::guard("fonctionnaire")->user()->tache === "retrait_bac")
            <li class="has_sub">
                <a href="{{route('fonctionnaire.retourbac')}}" class="waves-effect"><i
                class="zmdi zmdi-view-dashboard"></i><span>RETOUR</span> </a>
            </li>
            @endif
            @if (Auth::guard("fonctionnaire")->user()->tache === "retrait_bac")
            <li class="has_sub">
                <a href="{{route('fonctionnaire.rp')}}" class="waves-effect"><i
                class="zmdi zmdi-view-dashboard"></i><span>RETRAIT PROVISOIRE</span> </a>
            </li>
            @endif
            @if (Auth::guard("fonctionnaire")->user()->tache === "retrait_bac")
            <li class="has_sub">
                <a href="{{route('fonctionnaire.rdc')}}" class="waves-effect"><i
                class="zmdi zmdi-view-dashboard"></i><span>RETRAIT DÉFINITIVE</span> </a>
            </li>
            @endif
            </ul>
            @endif
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>

</div>
<!-- Left Sidebar End -->
