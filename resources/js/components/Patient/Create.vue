<template>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Patient Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="create">
                <div class="modal-body">
                    
                    <div class="row customerform" style="margin-right: 10px; margin-left: 10px;">
                        <div class="col-md-12 customerform" style="margin-top: 10px;">
                            <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Lastname: <span v-if="errors.lastname" class="haveerror">({{ errors.lastname[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="user.lastname" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Firstname: <span v-if="errors.firstname" class="haveerror">({{ errors.firstname[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="user.firstname" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Middlename: <span v-if="errors.middlename" class="haveerror">({{ errors.middlename[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="user.middlename" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Ext: <span v-if="errors.suffix" class="haveerror">({{ errors.suffix[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="user.suffix" style="text-transform: capitalize;">
                                    </div>
                                </div>

                                <div class="col-md-4" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Mobile: <span v-if="errors.mobile" class="haveerror">({{ errors.mobile[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="user.mobile">
                                    </div>
                                </div>

                                <div class="col-md-4" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Birthday: <span v-if="errors.birthday" class="haveerror">({{ errors.birthday[0] }})</span></label>
                                        <input type="date" class="form-control" v-model="user.birthday">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="row" style="margin-top: 20px; margin-bottom: -10px;">
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


                                <div class="col-md-4" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Barangay: <span v-if="errors.barangay_id" class="haveerror">({{ errors.barangay_id[0] }})</span></label>
                                          <multiselect 
                                            v-model="user.barangay_id" 
                                            :options="barangays"
                                            :allow-empty="false"
                                            :show-labels="false"
                                             label="name" track-by="id" 
                                            placeholder="Select Barangay">
                                        </multiselect>
                                    </div>
                                </div>

                                <div class="col-md-8" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Address: <span v-if="errors.address" class="haveerror">({{ errors.address[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="user.address" style="text-transform: capitalize;">
                                    </div>
                                </div>

                                
                                <div class="col-md-4">
                                    <div class="form-group" style="margin-top: 10px;">         
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" v-model="user.is_vaccinated" class="custom-control-input" id="formrow-customCheck">
                                            <label class="custom-control-label font-size-12" for="formrow-customCheck">Is <b>Vaccinated</b>?</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4" v-if="user.is_vaccinated == true">
                                    <div class="form-group" style="margin-top: -10px;">         
                                        <div class="custom-form">
                                            <label>Vaccine: <span v-if="errors.vaccine" class="haveerror">({{ errors.vaccine[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="user.vaccine" style="text-transform: capitalize;">
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
                    firstname: '',
                    lastname: '',
                    middlename: '',
                    suffix: '',
                    gender: '', 
                    birthday: '',
                    address: '',
                    is_vaccinated : false,
                    vaccine: '',
                    mobile: '',
                    barangay_id: '',
                },
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
                axios.post(this.currentUrl + '/request/patient/store', {
                    id: this.id,
                    firstname: this.user.firstname,
                    middlename: this.user.middlename,
                    lastname: this.user.lastname,
                    suffix: this.user.suffix,
                    gender: this.user.gender,
                    mobile: this.user.mobile,
                    birthday: this.user.birthday,
                    address: this.user.address,
                    barangay_id: (this.user.barangay_id == '') ? '' : this.user.barangay_id.id ,
                    is_vaccinated: this.user.is_vaccinated,
                    vaccine: this.user.vaccine,
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
                    }else{
                        this.isLoading = false;
                        Vue.$toast.error('<strong>Please contact Administrator</strong>', {
                            position: 'bottom-right'
                        });
                    }
                });
            },

            edit(list,editable){
                this.user = list;
                this.user.barangay_id = list.barangay;
            },

            clear(){
                this.editable = false;
                $("#new").modal("hide");
                this.name = '';
                this.address = '';
                this.is_main = false;
                this.errors = [];
            },

            add(){

            }

        }, components: { Multiselect, Loading }
    }
</script>