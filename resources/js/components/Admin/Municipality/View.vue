<template>
<div class="d-xl-flex">                
    <div class="w-100">
        <div class="card">
            <div class="card-body" :style="{ height: height + 'px' }">

                <div class="row">
                    <div class="col-md-12">
                        <blockquote class="p-3 border-light border rounded ">
                            <button type="button" @click="addnew" class="btn btn-danger waves-effect waves-light float-right" style="margin-top: -7px;"><i class='bx bx-plus-medical'></i></button>
                            <div class="d-flex">
                                <div class="mr-3"><i class="bx bxs-quote-alt-left text-primary font-size-14"></i></div>
                                <div>
                                    <p class="font-size-14 mb-0 text-primary font-weight-bold">{{profile.name}}.</p>
                                </div>
                            </div>
                            
                        </blockquote>
                    </div>
                </div>

                <div class="table-responsive" :style="{ height: (height-120) + 'px' }">
                    <table class="table table-centered table-nowrap">
                        <thead class="thead-light">
                            <tr class="font-size-11" >
                                <th>Name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="list in lists" v-bind:key="list.id">
                                <td>
                                    <h5 class="font-size-12 mb-0 text-dark">{{list.name}}</h5>
                                </td>
                                <td class="text-right">
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
        <muni-create-b @status="message" ref="create"></muni-create-b>
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
            return Math.floor((this.height - 10) / 54);
        }
    },

    created(){
        this.profiles();
    },

    methods: {
        profiles(){
            axios.get(this.currentUrl + '/request/municipality/'+this.$route.params.id)
            .then(response => {
                this.profile = response.data.data;
                this.lists = this.profile.barangays;
            })
            .catch(err => console.log(err));
        },

        addnew(){
            $("#new").modal('show');
            this.$refs.create.set(this.profile.id);
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
    }, 
}
</script>