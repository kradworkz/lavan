<template>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Patient Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                
            <div class="modal-body" style="margin-left: 10px; margin-right:10px;">
                <div class="row">
                    <div class="col-md-12">
                        <blockquote class="p-3 border-light border rounded ">
                             <div class="float-right">
                                    <p class="text-muted mb-0">Address: <span class="font-weight-bold text-success">{{profile.address}}, {{profile.barangay.name}}</span></p>
                                </div>
                            <div class="d-flex">
                                <div class="mr-3"><i class="bx bxs-quote-alt-left text-primary font-size-14"></i></div>
                                <div>
                                    <p class="font-size-14 mb-0 text-primary font-weight-bold">{{profile.lastname}}, {{profile.firstname}} {{profile.middlename}}.</p>
                                </div>
                            </div>
                            <hr>
                             <div class="row font-size-12 mt-0 justify-content-center">
                                <div class="col-sm-4 text-center">
                                    <h6 class="text-muted font-size-11 mb-0"><i class="bx bx-mobile mr-1 text-primary"></i>Mobile no.</h6>
                                    <p class="font-weight-bold text-dark mb-0">{{profile.mobile}}</p>
                                </div>
                                <div class="col-sm-4 text-center">
                                    <h6 class="text-muted font-size-11 mb-0"><i class="bx bx-cake mr-1 text-primary"></i>Birthday</h6>
                                    <p class="font-weight-bold text-dark mb-0">{{profile.birthday}}</p>
                                </div>
                                <div class="col-sm-4 text-center">
                                    <h6 class="text-muted font-size-11 mb-0"><i class="bx bxs-virus mr-1 text-primary"></i>Vaccination</h6>
                                    <p class="font-weight-bold text-dark mb-0">{{(profile.is_vaccinated == 1) ? 'Vaccinated' : 'Not Vaccinated'}} ({{profile.vaccine}})</p>
                                </div>
                            </div>
                        </blockquote>
                    </div>
                     <div class="table-responsive">
                    <table class="table table-centered table-nowrap">
                        <thead class="thead-light">
                            <tr class="font-size-11 text-center" >
                                <th class="text-center" style="font-size: 7px; width: 1%;">ANTIGEN</th>
                                <th class="text-center" style="font-size: 7px; width: 1%;">RTCPR</th>
                                <th>Facility</th>
                                <th>Port of Exit</th>
                                <th>Date of Started</th>
                                <th>Date of Completion</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(list,index) in lists" v-bind:key="list.id" class="text-center" v-if="index == 0">
                                <td class="text-center">
                                    <div>
                                        <i v-if="check(list.tests,0) == 'pending'" class='bx bx-loader-circle h4 text-warning'></i>
                                        <i v-else-if="check(list.tests,0) == 'negative'" class='bx bxs-minus-circle h4 text-info'></i>
                                        <i v-else-if="check(list.tests,0) == 'positive'" class='bx bxs-plus-circle h4 text-danger'></i>
                                        <i v-else class='bx bx-circle h4'></i>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div v-if="list.tests.length == 0">
                                        <i class='bx bx-circle h4'></i>
                                    </div>
                                    <div v-else>
                                        <i v-if="check(list.tests,1) == 'pending'" class='bx bx-loader-circle h4 text-warning'></i>
                                        <i v-else-if="check(list.tests,1) == 'negative'" class='bx bxs-minus-circle h4 text-info'></i>
                                        <i v-else-if="check(list.tests,1) == 'positive'" class='bx bxs-plus-circle h4 text-danger'></i>
                                        <i v-else class='bx bx-circle h4'></i>
                                    </div>
                                </td>
                                <td>
                                    <h5 v-if="list.is_home == 0" class="font-size-12 mb-0 text-dark">Floor {{list.facility.bed.floor}} - Bed {{list.facility.bed.name}}</h5>
                                    <p v-if="list.is_home == 0" class="font-size-12 text-muted mb-0">{{list.facility.bed.facility.name}}</p>
                                    <span v-else class="text-info font-weight-bold font-size-12">Home Quarantine</span>
                                </td>
                                <td>
                                    <h5 class="font-size-12 mb-0 text-dark">{{list.exit_port}}</h5>
                                </td>
                                <td>{{list.started_at}}</td>
                                <td>{{list.completion_at}}</td>
                                <td><span :class="'badge badge-bg badge-'+list.status.color">{{list.status.name}}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
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
                profile: { barangay: {}},
                lists: []
            }
        },

        methods : {
            profiles(id){
                axios.get(this.currentUrl + '/request/patient/'+id)
                .then(response => {
                    this.profile = response.data.data;
                    this.lists = this.profile.histories;
                    
                })
                .catch(err => console.log(err));
            },

            check(tests,type){
                let test = tests.filter(x => x.is_rtpcr === type);
                if(test.length != 0){
                    if(test[0].is_positive == 1){
                        return 'positive';
                    }else if(test[0].is_positive == 0){
                        return 'negative';
                    }else{
                        return 'pending'
                    }
                }else{
                    return ''
                }
            },
        }
    }
</script>
