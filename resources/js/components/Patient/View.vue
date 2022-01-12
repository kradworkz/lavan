<template>
<div class="d-xl-flex">                
    <div class="w-100">
        <div class="card">
            <div class="card-body" :style="{ height: height + 'px' }">

                <div class="row">
                    <div class="col-md-12">
                        <blockquote class="p-3 border-light border rounded ">
                            <button style="margin-top: -5px;" type="button" @click="addnew" class="btn btn-info waves-effect waves-light mr-2 float-right"><i class='bx bx-plus'></i></button>
                           
                            <div class="d-flex">
                                <div class="mr-3"><i class="bx bxs-quote-alt-left text-primary font-size-14"></i></div>
                                <div>
                                    <p class="font-size-14 mb-2 text-primary font-weight-bold">{{list.lastname}}, {{list.firstname}} {{list.middlename}}.</p>
                                </div>
                            </div>
                            <hr>
                             <div class="row font-size-12 mt-3">
                                <div class="col-sm-3">
                                    <h6 class="text-muted font-size-11 mb-0"><i class="bx bx-mobile mr-1 text-primary"></i>Mobile no.</h6>
                                    <p class="font-weight-bold text-dark mb-0">{{list.mobile}}</p>
                                </div>
                                <div class="col-sm-3">
                                    <h6 class="text-muted font-size-11 mb-0"><i class="bx bx-map mr-1 text-primary"></i>Address</h6>
                                    <p class="font-weight-bold text-dark mb-0">{{list.address}}, {{list.barangay.name}}</p>
                                </div>
                                <div class="col-sm-3">
                                    <h6 class="text-muted font-size-11 mb-0"><i class="bx bx-cake mr-1 text-primary"></i>Birthday</h6>
                                    <p class="font-weight-bold text-dark mb-0">{{list.birthday}}</p>
                                </div>
                                <div class="col-sm-3">
                                    <h6 class="text-muted font-size-11 mb-0"><i class="bx bxs-virus mr-1 text-primary"></i>Vaccination</h6>
                                    <p class="font-weight-bold text-dark mb-0">{{(list.is_vaccinated == 1) ? 'Vaccinated' : 'Not Vaccinated'}} ({{list.vaccine}})</p>
                                </div>
                            </div>
                        </blockquote>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap">
                        <thead class="thead-light">
                            <tr class="font-size-11">
                                <th>Facility</th>
                                <th class="text-center">Port of Exit</th>
                                <th class="text-center">Date of Arrival</th>
                                <th class="text-center">Date of Completion</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="list in lists" v-bind:key="list.id">
                                <td>
                                    <h5 class="font-size-13 mb-0 text-dark">{{list.name}}</h5>
                                    <p class="font-size-12 text-muted mb-0">{{list.address}}</p>
                                </td>
                                <td class="text-center">{{list.available}} of {{list.beds}}</td>
                                <td class="text-center">{{(list.is_main == 0) ? 'Barangay Isolation' : 'Main Isolation' }}</td>
                                <td class="text-right">
                                    <router-link :to="{ path: '/facility/'+list.id }" class="mr-3">
                                        <i class='bx bx-user-circle'></i>
                                    </router-link>
                                    <a class="mr-3 text-warning" @click="edit(list)"><i class='bx bx-edit-alt' ></i></a>
                                    <a class="text-danger"><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                

            </div>
        </div>
    </div>

    <div class="modal fade exampleModal" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <admission-check @status="message" ref="check"></admission-check>
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
            list: {},
            id : this.$route.params.id
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
        this.profile();
    },

    methods: {
        profile(){
            axios.get(this.currentUrl + '/request/patient/'+this.$route.params.id)
            .then(response => {
                this.list = response.data.data;
            })
            .catch(err => console.log(err));
        },

        fetch() {
            axios.get(this.currentUrl + '/request/beds/'+this.id)
            .then(response => {
                this.lists = response.data;
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
        }
    }, 
}
</script>