<template>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Medical Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="create">
                <div class="modal-body">
                    <div class="row customerform" style="margin-right: 10px; margin-left: 10px;">
                        <div class="col-md-12 customerform" style="margin-top: 20px;">
                            <div class="row">
                                <div class="col-md-6" style="margin-top: -10px;">
                                    <div class="form-group">
                                        <label>Category: <span v-if="errors.category_id" class="haveerror">({{ errors.category_id[0] }})</span></label>
                                          <multiselect 
                                            v-model="category_id" 
                                            :options="categories"
                                            :allow-empty="false"
                                            :show-labels="false"
                                             label="name" track-by="id" 
                                            placeholder="Select Category">
                                        </multiselect>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top: -10px;">
                                    <div class="form-group">
                                        <label>Exit Port: <span v-if="errors.exit_port" class="haveerror">({{ errors.exit_port[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="exit_port">
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top: -10px;">
                                    <div class="form-group">
                                        <label>Arrived At: <span v-if="errors.arrived_at" class="haveerror">({{ errors.arrived_at[0] }})</span></label>
                                        <input type="date" class="form-control" v-model="arrived_at">
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top: -10px;">
                                    <div class="form-group">
                                        <label>Completion At: <span v-if="errors.completion_at" class="haveerror">({{ errors.completion_at[0] }})</span></label>
                                        <input type="date" class="form-control" v-model="completion_at">
                                    </div>
                                </div>
                                
                                <div class="col-md-12" style="margin-top: -10px;">
                                    <div class="form-group">
                                        <label>Facility: <span v-if="errors.facility_id" class="haveerror">({{ errors.facility_id[0] }})</span></label>
                                          <multiselect 
                                            v-model="facility_id" 
                                            :options="facilities"
                                            :allow-empty="false"
                                            :show-labels="false"
                                             label="name" track-by="id" 
                                            placeholder="Select Facility">
                                        </multiselect>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><span v-if="editable == true">Update</span><span v-else>Create</span></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
            <loading :active.sync="isLoading" :can-cancel="false" loader="dots" background-color="black" :is-full-page="fullPage"></loading>

        </div>
    </div>
</template>

<script>
    import Loading from 'vue-loading-overlay';
    import Multiselect from 'vue-multiselect';
    export default {
        props : ['id'],
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                categories: [],
                beds: [],
                facilities: [],
                completion_at: '', 
                arrived_at: '', 
                bed: '',
                exit_port: '',
                category_id: '',
                facility_id: '',
                editable: false,
                isLoading: false,
                fullPage: true,
                count : ''
            }
        },

        created(){
            this.fetchCategory();
            this.fetchA
        },

        methods : {
            set(count){
                this.count = count;
                this.add();
            },

            create(){
                this.isLoading = true;
                axios.post(this.currentUrl + '/request/bed/store', {
                    id: this.id,
                    lists: this.lists
                })
                .then(response => {
                    this.$emit('status', response.data.data);
                    this.clear();
                    this.isLoading = false;
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                        this.isLoading = false;
                    }else{
                        this.isLoading = false;
                        Vue.$toast.error('<strong>Please contact Administrator</strong>', {
                            position: 'bottom-right'
                        });
                    }
                });
            },

            edit(list,editable){
                this.id = list.id;
                this.name = list.name;
                this.address = list.address;
                this.barangay_id = list.barangay;
                this.is_main = list.is_main;
                this.editable = editable;
            },

            clear(){
                this.editable = false;
                $("#new").modal("hide");
                this.name = '';
                this.address = '';
                this.is_main = false;
                this.errors = [];
            },

            add() {
                this.count = this.count + 1;
                this.lists.push({floor: this.count})
            },

            del(index) {
                if(this.lists.length > 1){
                    this.lists.splice(index, 1);
                }
            },

        }, components: { Multiselect, Loading }
    }
</script>