<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>

                <li class="has_sub">
                    <a href="{{route('fonctionnaire.index')}}" class="waves-effect"><i
                        class="zmdi zmdi-view-dashboard"></i><span> En cour </span> </a>
                </li>
                <li class="has_sub">
                    <a href="{{route('fonctionnaire.to_enatente')}}" class="waves-effect"><i
                    class="zmdi zmdi-view-dashboard"></i><span>En attents</span> </a>
                </li>
                <li class="has_sub">
                    <a href="{{route('fonctionnaire.pret')}}" class="waves-effect"><i
                    class="zmdi zmdi-view-dashboard"></i><span>Traité</span> </a>
                </li>
                <li class="has_sub">
                    <a href="{{route('fonctionnaire.refus')}}" class="waves-effect"><i
                    class="zmdi zmdi-view-dashboard"></i><span>Refusé</span> </a>
                </li>
            @if(Auth::guard("fonctionnaire")->user()->tache === "retrait_bac")
            <li class="has_sub">
                <a href="{{route('fonctionnaire.retourbac')}}" class="waves-effect"><i
                class="zmdi zmdi-view-dashboard"></i><span>الشواهد المرجعة</span> </a>
            </li>
            @endif
            @if (Auth::guard("fonctionnaire")->user()->tache === "retrait_bac")
            <li class="has_sub">
                <a href="{{route('fonctionnaire.rp')}}" class="waves-effect"><i
                class="zmdi zmdi-view-dashboard"></i><span>RP</span> </a>
            </li>
            @endif
            @if (Auth::guard("fonctionnaire")->user()->tache === "retrait_bac")
            <li class="has_sub">
                <a href="{{route('fonctionnaire.rdc')}}" class="waves-effect"><i
                class="zmdi zmdi-view-dashboard"></i><span>RDC</span> </a>
            </li>
            @endif
            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>

</div>
<!-- Left Sidebar End -->
