<template>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Facility Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="create">
                <div class="modal-body">
                    
                    <div class="row customerform" style="margin-right: 10px; margin-left: 10px;">
                        <div class="col-md-12 customerform" style="margin-top: 20px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name: <span v-if="errors.name" class="haveerror">({{ errors.name[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="name" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Address: <span v-if="errors.address" class="haveerror">({{ errors.address[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="address">
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Barangay: <span v-if="errors.barangay" class="haveerror">({{ errors.barangay[0] }})</span></label>
                                          <multiselect 
                                            v-model="barangay" 
                                            :options="barangays"
                                            :allow-empty="false"
                                            :show-labels="false"
                                             label="name" track-by="id" 
                                            placeholder="Select Barangay">
                                        </multiselect>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <i class="mdi mdi-alert-outline mr-2"></i>
                                        <div class="form-group" style="margin-top:-20px; margin-bottom: 2px;">         
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" v-model="main" class="custom-control-input" id="formrow-customCheck">
                                                <label class="custom-control-label font-size-12" for="formrow-customCheck">Is this a <b>Main Isolation Facility?</b>?</label>
                                            </div>
                                        </div>
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
        props : ['type'],
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                name: '',
                address: '',
                barangay: '',
                main: false,
                barangays: [],
                editable: false,
                isLoading: false,
                fullPage: true
            }
        },

        created(){
            this.barangays = window.Barangays;
        },
        
        methods : {
            create(){
                this.isLoading = true;
                axios.post(this.currentUrl + '/request/user/store', {
                    id: this.user.id,
                    name: this.user.name,
                    email: this.user.email,
                    gender: this.user.gender,
                    mobile: this.user.mobile,
                    type: this.user.type,
                    editable: this.editable
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
                    }
                });
            },

            edit(user,editable){
                this.user = user;
                this.editable = editable;
            },

            clear(){
                this.editable = false;
                $("#new").modal("hide");
                this.errors = [];
                this.users = {};
            },

        }, components: { Multiselect, Loading }
    }
</script>