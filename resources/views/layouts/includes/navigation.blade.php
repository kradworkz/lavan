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
                @if(Auth::user()->type == "Administrator")
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
                <li>
                    <router-link :to="{ name: 'facilities' }" class="waves-effect">
                        <i class="bx bx-buildings"></i>
                        <span key="t-dashboards">Facilities</span>
                    </router-link>
                </li>
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
                    <router-link :to="{ name: 'logs' }" class="waves-effect">
                        <i class="bx bx-message-square-dots"></i>
                        <span key="t-dashboards">Logs</span>
                    </router-link>
                </li>
                @elseif(Auth::user()->type == "Scholarship Coordinator")
                <li>
                    <a class="waves-effect">
                    <i class='bx bx-id-card'></i>
                        <span key="t-q">Qualifiers</span>
                    </a>
                    <ul class="sub-menu " aria-expanded="false">
                        <li>
                            <router-link :to="{ name: 'qualifier/lists' }" class="waves-effect">
                                <i class="bx bx-message-square-dots"></i>
                                <span key="t-ql">List</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'qualifier/import' }" class="waves-effect">
                                <i class="bx bx-message-square-dots"></i>
                                <span key="t-qi">Import</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="waves-effect">
                    <i class='bx bx-group'></i>
                        <span key="t-chat">Scholars</span>
                    </a>
                    <ul class="sub-menu " aria-expanded="false">
                        <li>
                            <router-link :to="{ name: 'scholar/lists' }" class="waves-effect">
                                <i class="bx bx-message-square-dots"></i>
                                <span key="t-dashboards">List</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'scholar/import' }" class="waves-effect">
                                <i class="bx bx-message-square-dots"></i>
                                <span key="t-dashboards">Import</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a class="waves-effect">
                    <i class='bx bx-money'></i>
                        <span key="t-chat">Accounting</span>
                    </a>
                    <ul class="sub-menu " aria-expanded="false">
                        <li>
                            <router-link :to="{name: 'financial-benefit'}" class="waves-effect">
                                <i class="bx bx-credit-card"></i>
                                <span key="t-dashboards">Financial Benefits</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{name: 'allotments'}" class="waves-effect">
                                <i class="bx bx-wallet"></i>
                                <span key="t-dashboards">Allotment</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{name: 'disbursements'}" class="waves-effect">
                                <i class="bx bx-wallet-alt"></i>
                                <span key="t-dashboards">Disbursement</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <!-- <li>
                    <a class="waves-effect">
                    <i class='bx bx-group'></i>
                        <span key="t-chat">Qualifiers</span>
                    </a>
                    <ul class="sub-menu " aria-expanded="false">
                        <li><a href="/qualifiers" key="t1" class="font-size-11"><i class='bx bxs-file' ></i>Lists</a></li>
                        <li><a href="/qualifier/import" key="t1" class="font-size-11"><i class='bx bx-file' ></i>Import</a></li>
                    </ul>
                </li> -->
                @elseif(Auth::user()->role == "Researcher")
                <li>
                    <a href="/researches" class="waves-effect">
                    <i class='bx bxs-book'></i>
                        <span key="t-chat">Researches</span>
                    </a>
                </li>
                @elseif(Auth::user()->role == "Laboratory Coordinator")
                <li>
                    <a href="/laboratory/basic" class="waves-effect">
                    <i class='bx bxs-box'></i>
                        <span key="t-chat">Basic Laboratories</span>
                    </a>
                </li>
                <li>
                    <a href="/laboratory/specialized" class="waves-effect">
                    <i class='bx bxs-cabinet'></i>
                        <span key="t-chat">Specialized Laboratories</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>