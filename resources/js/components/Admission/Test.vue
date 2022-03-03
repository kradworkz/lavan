<template>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{(user.is_rtpcr == 1) ? 'RT-PCR' : 'Antigen'}} Result</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                
            <div class="modal-body" style="margin-left: 10px; margin-right:10px;">
                <form @submit.prevent="add">
                <p class="text-center"> <span class="text-primary font-weight-bold">{{ user.admission.patient.firstname }} {{ user.admission.patient.lastname }}</span> result is</p>
                
                <blockquote class="border-light border rounded ">
                <div class="col-md-12 text-center">
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-6">
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" id="customRadio1" class="custom-control-input" checked="checked" value="1" v-model="result">
                                <label class="custom-control-label" for="customRadio1">Positive</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" id="customRadio2" class="custom-control-input" checked="checked" value="0" v-model="result">
                                <label class="custom-control-label" for="customRadio2">Negative</label>
                            </div>
                        </div>
                    </div>
                </div>
                </blockquote>

                <div class="row customerform" v-if="result == 1">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Facility: <span v-if="errors.facility_id" class="haveerror">({{ errors.facility_id[0] }})</span></label>
                                <multiselect 
                                v-model="facility_id" 
                                :options="facilities"
                                :allow-empty="false"
                                :show-labels="false"
                                label="name" track-by="id" 
                                open-direction="bottom"
                                @input="onChange(facility_id)"
                                placeholder="Select Facility">
                            </multiselect>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: -13px;">
                        <div class="form-group">
                            <label>Bed: <span v-if="errors.bed_id" class="haveerror">({{ errors.bed_id[0] }})</span></label>
                                <multiselect 
                                v-model="bed_id" 
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
                <button v-if="result != ''" type="submit" class="btn btn-primary btn-sm btn-block waves-effect waves-light mt-2 mb-1">CONFIRM RESULT</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
                facilities: [],
                beds: [],
                facility_id: '',
                bed_id: '',
                user: {
                    admission: {
                        patient: {}
                    }
                },
                result: '',
            }
        },

        created(){
            this.fetchFacility();
        },

        methods : {
            set(user){
                this.user = user;
            },

            fetchFacility() {
                axios.get(this.currentUrl + '/request/facilities/1')
                .then(response => {
                    this.facilities = response.data.data;
                })
                .catch(err => console.log(err));
            },

            customLabel1 ({ name, floor}) {
                return `Floor ${floor} - Room ${name}`
            },

            onChange(list) {
                this.beds = list.beds;
            },

            add(){
                axios.post(this.currentUrl + '/request/admission/test', {
                    id: this.user.id,
                    admission_id: this.user.admission_id,
                    bed_id: this.bed_id.id,
                    is_positive: this.result,
                    status_id: (this.result == 1) ? 1 : '',
                    editable: true
                })
                .then(response => {
                    this.$emit('status', response.data.data);
                    $("#result1").modal('hide');
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
            }
        }, components : { Multiselect }
    }
</script>
