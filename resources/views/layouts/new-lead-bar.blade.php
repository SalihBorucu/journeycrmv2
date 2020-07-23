<ul class="nav nav-pills nav-justified" role="tablist">
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link {{ Request::is('lead') ? 'active' : '' }}" href="{{ Request::is('lead') ? 'javascript: void(0)' : '/lead' }}">
            <span class="d-none d-md-block {{ Request::is('lead') ? 'text-white' : 'text-primary' }}">New Lead</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
        </a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link {{ Request::is('lead/incomplete-leads') ? 'active' : '' }}" href="{{ Request::is('lead/incomplete-leads') ? 'javascript: void(0)' : '/lead/incomplete-leads' }}">
            <span class="d-none d-md-block {{ Request::is('lead/incomplete-leads') ? 'text-white' : 'text-primary' }}">Incomplete Leads</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
        </a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link {{ Request::is('lead/unassigned-leads') ? 'active' : '' }}" href="{{ Request::is('lead/unassigned-leads') ? 'javascript: void(0)' : '/lead/unassigned-leads' }}">
            <span class="d-none d-md-block {{ Request::is('lead/unassigned-leads') ? 'text-white' : 'text-primary' }}">Unassigned Leads</span><span class="d-block d-md-none"><i class="mdi mdi-email h5"></i></span>
        </a>
    </li>

</ul>
