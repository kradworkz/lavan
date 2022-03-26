<template>
    <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-bell bx-tada"></i>
            <span v-if="notifications.length > 0" class="badge badge-danger badge-pill">{{ notifications.length }}</span>
        </button>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
            aria-labelledby="page-header-notifications-dropdown">
            <div class="p-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-0" key="t-notifications"> Notifications </h6>
                    </div>
                    <div class="col-auto">
                        <a href="#!" class="small" key="t-view-all"> View All</a>
                    </div>
                </div>
            </div>
            <div data-simplebar style="max-height: 230px;">
                <a href="#" class="text-reset notification-item">
                    <div @click="viewProfile(notification.admission.patient.id,notification.id)" class="media" v-for="notification in notifications" v-bind:key="notification.id">
                        <div class="avatar-xs mr-3">
                            <span class="avatar-title rounded-circle font-size-16">
                                <i v-if="notification.type == 1" class="bx bx-user-circle"></i>
                                <i v-else class="bx bx-notepad"></i>
                            </span>
                        </div>
                        <div class="media-body">
                            <h6 class="mt-0 mb-1 text-success" key="t-your-order" v-if="notification.type == 1">New Patient Admitted</h6>
                            <h6 class="mt-0 mb-1 text-success" key="t-your-order" v-else>New Result</h6>
                            <div class="font-size-12 text-muted">
                                <p v-if="notification.type == 1" class="mb-1" key="t-grammer"><span class="font-weight-bold text-primary">{{notification.admission.patient.firstname}} {{notification.admission.patient.lastname}}</span> was admitted by <span class="font-weight-bold text-dark">{{ notification.user.name }}</span></p>
                                <p v-else class="mb-1" key="t-grammer"><span class="font-weight-bold text-primary">{{notification.admission.patient.firstname}} {{notification.admission.patient.lastname}}</span> <span class="font-weight-bold">{{notification.remarks}}</span> result was <span class="font-weight-bold" :class="[(notification.content == 'Positive') ? 'text-danger' : 'text-success']">{{ notification.content }}</span> added by <span class="font-weight-bold text-dark">{{ notification.user.name }}</span></p>
                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago">{{ notification.created_at}}</span></p>
                            </div>
                        </div>
                    </div>
                </a>
               
            </div>
            <div class="p-2 border-top">
                <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                    <i class="mdi mdi-arrow-right-circle mr-1"></i> <span @click="viewProfile" key="t-view-more">View More..</span> 
                </a>
            </div>
        </div>
    </div>    
</template>

<script>
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
                notifications: [],
            }
        },

        created(){
            this.fetchNotifications();
        },

        methods : {
            fetchNotifications(){
                axios.get(this.currentUrl + '/request/notifications')
                .then(response => {
                    this.notifications = response.data;
                })
                .catch(err => console.log(err));
            },

            viewProfile(id,noti_id){
                this.$parent.viewPatient(id);
                axios.get(this.currentUrl + '/request/seen/'+noti_id)
                .then(response => {
                    this.fetchNotifications();
                })
                .catch(err => console.log(err));
            }
        },
    }
</script>
