<template>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Admission Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                
            <div class="modal-body">
                
                <div class="row justify-content-center mt-4 mb-4" v-if="disable == 1">
                    <div class="col-xl-12 mb-3">
                        <p class="text-muted text-center">Are you a new Patient?</p>
                    </div>
                    <div class="col-xl-5">
                        <label class="card-radio-label mb-3">
                            <input type="radio" v-model="is_new" value="1" class="card-radio-input" v-on:change="radio">
                            <div class="card-radio">
                                <i class="bx bxs-user-detail font-size-24 text-primary align-middle mr-2"></i>
                                <span>New Patient</span>
                            </div>
                        </label>
                    </div>
                    <div class="col-xl-5">
                        <label class="card-radio-label mb-3">
                            <input type="radio" v-model="is_new" value="0" class="card-radio-input" v-on:change="radio">
                            <div class="card-radio">
                                <i class="bx bx-user-circle font-size-24 text-primary align-middle mr-2"></i>
                                <span>Old Patient</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="row justify-content-center mt-2" v-else-if="disable == 3">
                    <form @submit.prevent="create">
                        <div class="row customerform" style="margin-right: 10px; margin-left: 10px;">
                            <div class="col-md-12 customerform">
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

                                    <div class="col-md-4" style="margin-top: -13px;">
                                        <div class="form-group">
                                            <label>Mobile: <span v-if="errors.mobile" class="haveerror">({{ errors.mobile[0] }})</span></label>
                                            <input type="text" class="form-control" v-model="user.mobile">
                                        </div>
                                    </div>

                                    <div class="col-md-4" style="margin-top: -13px;">
                                        <div class="form-group">
                                            <label>Birthday: <span v-if="errors.birthday" class="haveerror">({{ errors.birthday[0] }})</span></label>
                                            <input type="date" class="form-control" v-model="user.birthday">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="row" style="margin-top: 20px; margin-bottom: -13px;">
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

                                    <div class="col-md-4" style="margin-top: -13px;">
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

                                    <div class="col-md-8" style="margin-top: -13px;">
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

                                    <div class="col-md-8" v-if="user.is_vaccinated == true">
                                        <div class="form-group" style="margin-top: -13px;">         
                                            <div class="custom-form">
                                                <label>Vaccine: <span v-if="errors.vaccine" class="haveerror">({{ errors.vaccine[0] }})</span></label>
                                            <input type="text" class="form-control" v-model="user.vaccine" style="text-transform: capitalize;">
                                            </div>
                                        </div>
                                    </div>
                                                                                                
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 mt-2 mb-4">
                            <div class="text-center mt-2">
                                <button @click="disable = 1" type="button" class="btn btn-light btn-sm w-md">Back</button>
                                <button type="submit" class="btn btn-success btn-sm w-md">Proceed</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row justify-content-center mt-2" v-else>
                    <form @submit.prevent="save">
                        <div class="col-md-12">
                            <div class="form-group">
                                <multiselect 
                                    v-model="admit.patient_id" 
                                    :options="patients"
                                    :show-labels="false"
                                    open-direction="bottom"
                                    label="name" track-by="id" 
                                    :allow-empty="false"
                                    placeholder="Search Patient"
                                    :custom-label="customLabel"
                                    @search-change="asyncPatient">
                                </multiselect>
                            </div>
                        </div>

                        <div class="col-md-12 customerform" style="margin-top: 20px;">
                            <div class="row">
                                <div class="col-md-6" style="margin-top: -10px;">
                                    <div class="form-group">
                                        <label>Category: <span v-if="errors.category_id" class="haveerror">({{ errors.category_id[0] }})</span></label>
                                            <multiselect 
                                            v-model="admit.category_id" 
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
                                        <input type="text" class="form-control" v-model="admit.exit_port" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top: -13px;">
                                    <div class="form-group">
                                        <label>Arrived At: <span v-if="errors.arrived_at" class="haveerror">({{ errors.arrived_at[0] }})</span></label>
                                        <input type="date" class="form-control" v-model="admit.arrived_at">
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top: -13px;">
                                    <div class="form-group">
                                        <label>Completion At: <span v-if="errors.completion_at" class="haveerror">({{ errors.completion_at[0] }})</span></label>
                                        <input type="date" class="form-control" v-model="admit.completion_at">
                                    </div>
                                </div>
                                
                                <div class="col-md-6" style="margin-top: -13px;">
                                    <div class="form-group">
                                        <label>Facility: <span v-if="errors.facility_id" class="haveerror">({{ errors.facility_id[0] }})</span></label>
                                            <multiselect 
                                            v-model="admit.facility_id" 
                                            :options="facilities"
                                            :allow-empty="false"
                                            :show-labels="false"
                                            label="name" track-by="id" 
                                            open-direction="bottom"
                                            @input="onChange(admit.facility_id)"
                                            @search-change="asyncFacility"
                                            placeholder="Select Facility">
                                        </multiselect>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top: -13px;">
                                    <div class="form-group">
                                        <label>Bed: <span v-if="errors.bed_id" class="haveerror">({{ errors.bed_id[0] }})</span></label>
                                            <multiselect 
                                            v-model="admit.bed_id" 
                                            :options="beds"
                                            :allow-empty="false"
                                            :show-labels="false"
                                            label="name" track-by="id" 
                                            open-direction="bottom"
                                            :custom-label="customLabel1"
                                            placeholder="Select Bed">
                                        </multiselect>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-xl-12 mt-2 mb-4">
                            <div class="text-center mt-2">
                                <button @click="disable = 1" type="button" class="btn btn-light btn-sm w-md">Back</button>
                                <button type="submit" class="btn btn-success btn-sm w-md">Proceed</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    export default {
        props: ['categories'],
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
                is_new: '',
                disable : 1,
                patients : [],
                barangays: [],
                facilities: [],
                beds: [],
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
                admit: {
                    completion_at: '', 
                    arrived_at: '', 
                    bed: '',
                    exit_port: '',
                    category_id: '',
                    facility_id: '',
                    bed_id: '',
                    patient_id: '',
                }
            }
        },

        created(){
            this.barangays = window.Barangays;
        },

        methods : {
            
            radio(event){
                var optionText = event.target.value;
                if(optionText == 0){ 
                    this.disable = 2;
                }else{
                    this.disable = 3;
                }
            },

            asyncPatient(value) {
                if(value.length > 3){
                    axios.post(this.currentUrl + '/request/patient/search', {
                        word: value,
                    })
                    .then(response => {
                        this.patients = response.data.data;
                    })
                    .catch(err => console.log(err));
                }
            },

            customLabel ({ lastname, middlename, firstname }) {
                return `${firstname} ${middlename} ${lastname}`
            },

            asyncFacility(value) {
                if(value.length > 3){
                    axios.post(this.currentUrl + '/request/facility/search', {
                        word: value,
                    })
                    .then(response => {
                        this.facilities = response.data.data;
                    })
                    .catch(err => console.log(err));
                }
            },

            customLabel1 ({ name, floor}) {
                return `Floor ${floor} - Room ${name}`
            },

            onChange(list) {
                this.beds = list.beds;
            },

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
                    this.admit.patient_id = response.data.data;
                    this.disable = 2;
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

            save(){
                this.isLoading = true;
                axios.post(this.currentUrl + '/request/admission/store', {
                    id: this.id,
                    status_id: this.admit.category_id.id,
                    exit_port: this.admit.exit_port,
                    arrived_at: this.admit.arrived_at,
                    completion_at: this.admit.completion_at,
                    bed_id: this.admit.bed_id.id,
                    patient_id: this.admit.patient_id.id,
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

            clear(){
                this.admit = {};
                this.user = {};
            }
        }, components : { Multiselect }
    }
</script>
