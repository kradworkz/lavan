<template>
<div class="d-xl-flex">                
    <div class="w-100">
        <div class="card">
            <div class="card-body" :style="{ height: height + 'px' }">

                <div class="row">
                    <div class="col-md-12">
                        <blockquote class="p-3 border-light border rounded ">
                            <div class="d-flex">
                                <div class="mr-3"><i class="bx bxs-quote-alt-left text-primary font-size-14"></i></div>
                                <div>
                                    <p class="font-size-14 mb-0 text-primary font-weight-bold">{{profile.lastname}}, {{profile.firstname}} {{profile.middlename}}.</p>
                                </div>
                            </div>
                            <hr>
                             <div class="row font-size-12 mt-0">
                                <div class="col-sm-3">
                                    <h6 class="text-muted font-size-11 mb-0"><i class="bx bx-mobile mr-1 text-primary"></i>Mobile no.</h6>
                                    <p class="font-weight-bold text-dark mb-0">{{profile.mobile}}</p>
                                </div>
                                <div class="col-sm-3">
                                    <h6 class="text-muted font-size-11 mb-0"><i class="bx bx-map mr-1 text-primary"></i>Address</h6>
                                    <p class="font-weight-bold text-dark mb-0">{{profile.address}}, {{profile.barangay.name}}</p>
                                </div>
                                <div class="col-sm-3">
                                    <h6 class="text-muted font-size-11 mb-0"><i class="bx bx-cake mr-1 text-primary"></i>Birthday</h6>
                                    <p class="font-weight-bold text-dark mb-0">{{profile.birthday}}</p>
                                </div>
                                <div class="col-sm-3">
                                    <h6 class="text-muted font-size-11 mb-0"><i class="bx bxs-virus mr-1 text-primary"></i>Vaccination</h6>
                                    <p class="font-weight-bold text-dark mb-0">{{(profile.is_vaccinated == 1) ? 'Vaccinated' : 'Not Vaccinated'}} ({{profile.vaccine}})</p>
                                </div>
                            </div>
                        </blockquote>
                    </div>
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
                            <tr v-for="list in lists" v-bind:key="list.id" class="text-center">
                                <td class="text-center">
                                    <div v-if="list.tests.length == 0">
                                        <i class='bx bx-circle h4'></i>
                                    </div>
                                    <div v-else>
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
            windowHeight: window.innerHeight,
            windowWidth: window.innerWidth,
            errors: [],
            profile: { barangay: {}},
            id : this.$route.params.id,
            lists: []
        }
    },

    computed : {
        height: function() {
            return this.windowHeight -190;
        },
        width: function() {
            return this.windowWidth;
        },
        counts: function(){
            return Math.floor((this.height - 125) / 54);
        }
    },

    created(){
        this.profiles();
    },

    methods: {
        profiles(){
            axios.get(this.currentUrl + '/request/patient/'+this.$route.params.id)
            .then(response => {
                this.profile = response.data.data;
                this.lists = this.profile.histories;
            })
            .catch(err => console.log(err));
        },

        addnew(){
            $("#new").modal('show');
            this.$refs.check.clear();
        },

        edit(list){
            this.editable = true;
            $("#new").modal('show');
            this.$refs.create.edit(list,true);
        },

        message(list){
            if(list){
                if(this.editable == true){
                    let index = this.lists.findIndex(u => u.id === list.id);
                    this.$set(this.lists, index, list);
                    Vue.$toast.success('<strong>Successfully Updated</strong>', {
                        position: 'bottom-right'
                    });
                }else{
                    this.lists.unshift(list);
                    Vue.$toast.success('<strong>Successfully Created</strong>', {
                        position: 'bottom-right'
                    });
                }
                $("#new").modal('hide');
                this.editable = false;
            }
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
    }, 
}
</script>