<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>
                <li>
                    <router-link :to="{ name: 'home' }" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </router-link>
                </li>
                @if(Auth::user()->type == "Super Administrator")
                <li>
                    <router-link :to="{ name: 'user' }" class="waves-effect">
                        <i class="bx bxs-user-circle"></i>
                        <span key="t-dashboards">User</span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'dropdowns' }" class="waves-effect">
                        <i class="bx bx-category"></i>
                        <span key="t-dashboards">Dropdowns</span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'municipalities' }" class="waves-effect">
                        <i class="bx bx-map"></i>
                        <span key="t-dashboards">Municipalities</span>
                    </router-link>
                </li>
                @elseif(Auth::user()->type == "Administrator")
                <li>
                    <router-link :to="{ name: 'user' }" class="waves-effect">
                        <i class="bx bxs-user-circle"></i>
                        <span key="t-dashboards">User</span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'facilities' }" class="waves-effect">
                        <i class="bx bx-buildings"></i>
                        <span key="t-dashboards">Facilities</span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'logs' }" class="waves-effect">
                        <i class="bx bx-message-square-dots"></i>
                        <span key="t-dashboards">Logs</span>
                    </router-link>
                </li>
                @elseif(Auth::user()->type == "Isolation Manager" || Auth::user()->type == "Contact Tracer")
                <li>
                    <router-link :to="{ name: 'admission' }" class="waves-effect">
                        <i class="bx bxs-capsule"></i>
                        <span key="t-dashboards">Admission</span>
                    </router-link>
                </li>
                <!-- <li>
                    <router-link :to="{ name: 'tests' }" class="waves-effect">
                        <i class='bx bxs-vial' ></i>
                        <span key="t-dashboards">Tests</span>
                    </router-link>
                </li> -->
                <li>
                    <router-link :to="{ name: 'patients' }" class="waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span key="t-dashboards">Patients</span>
                    </router-link>
                </li>
                @endif
                @if(Auth::user()->type == "Isolation Manager")
                <li>
                    <router-link :to="{ name: 'facilities' }" class="waves-effect">
                        <i class="bx bx-buildings"></i>
                        <span key="t-dashboards">Facilities</span>
                    </router-link>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>