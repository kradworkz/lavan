<template>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Staff Information</h5>
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
                                        <input type="text" class="form-control" v-model="user.name" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Email: <span v-if="errors.email" class="haveerror">({{ errors.email[0] }})</span></label>
                                        <input type="email" class="form-control" v-model="user.email" style="text-transform: lowercase;">
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Mobile No.: <span v-if="errors.mobile" class="haveerror">({{ errors.mobile[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="user.mobile">
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Type: <span v-if="errors.type" class="haveerror">({{ errors.type[0] }})</span></label>
                                          <multiselect 
                                            v-model="user.type" 
                                            :options="roles"
                                            :allow-empty="false"
                                            :show-labels="false"
                                            placeholder="Select Role">
                                        </multiselect>
                                    </div>
                                </div>

                                <div class="col-md-6" style="margin-top: -10px;">
                                    <div class="row" style="margin-top: 20px;">
                                        <div class="col-md-4">
                                            <div class="custom-control custom-radio mb-3">
                                                <input type="radio" id="customRadio1" class="custom-control-input" checked="checked" value="Male" v-model="user.gender">
                                                <label class="custom-control-label" for="customRadio1">Male</label>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="custom-control custom-radio mb-3">
                                                <input type="radio" id="customRadio2" class="custom-control-input" checked="checked" value="Female" v-model="user.gender">
                                                <label class="custom-control-label" for="customRadio2">Female</label>
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
                user: {
                    id: '',
                    email: '',
                    name: '',
                    type: '',
                    gender: '', 
                    mobile: '',
                },
                roles: ['Administrator','Contact Tracer','Isolation Manager'],
                editable: false,
                isLoading: false,
                fullPage: true
            }
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