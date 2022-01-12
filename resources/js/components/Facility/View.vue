<template>
<div class="d-xl-flex">                
    <div class="w-100">
        <div class="card">
            <div class="card-body" :style="{ height: height + 'px' }">

                <div class="row">
                    <div class="col-md-12">
                        <blockquote class="p-3 border-light border rounded ">
                            <button style="margin-top: -5px;" type="button" @click="addnew" class="btn btn-danger waves-effect waves-light mr-2 float-right"><i class='bx bx-plus-medical'></i></button>
                            <span class="float-right font-size-15 font-weight-bold text-dark mr-5">{{facility.available}} out of {{facility.beds}} </span>
                            <div class="d-flex">
                                <div class="mr-3"><i class="bx bxs-quote-alt-left text-primary font-size-14"></i></div>
                                <div>
                                    <p class="font-size-14 mb-2 text-primary font-weight-bold">{{ facility.name }} - <span class="text-muted">{{ facility.address }}, {{ facility.barangay.name }}</span></p>
                                </div>
                            </div>
                        </blockquote>
                    </div>
                </div>

                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" style="width: 160px;" v-for="(list,index) in lists" v-bind:key="index">
                        <a class="nav-link" :class="[(index == 0 ? 'active' : '')]" data-toggle="tab" v-bind:href="'#info'+index" role="tab" aria-selected="true">
                            <span class="d-none d-sm-block">
                                Floor no: {{ list.floor }} 
                            </span>    
                        </a>
                    </li>
                </ul>
                
                <div class="tab-content mt-3 text-muted">
                    <div v-for="(list,index) in lists" v-bind:key="index" class="tab-pane" :class="[(index == 0 ? 'active' : '')]" :id="'info'+index" role="tabpanel">
                        <div class="table-responsive mt-4">
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <tr v-for="(bed,a) in list.beds" v-bind:key="a">
                                        <td class="text-center" v-for="(r,index) in bed" v-bind:key="index">
                                            <span class="font-size-11">Bed {{ r.name }}</span> <br>
                                            <i class='bx bxs-check-circle text-success font-size-14' v-if="r.is_available == 1"></i>
                                            <i class='bx bxs-x-circle text-danger font-size-14' v-else></i>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade exampleModal" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <facility-create-beds :id="id" @status="message" ref="create"></facility-create-beds>
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
            lists : [],
            facility: {
                barangay: {}
            },
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
        this.fetch();
    },

    methods: {
        profile(){
            axios.get(this.currentUrl + '/request/facility/'+this.$route.params.id)
            .then(response => {
                this.facility = response.data.data;
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
            this.$refs.create.clear();
            this.$refs.create.set(this.lists.length);
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