<template>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Test</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                
            <div class="modal-body" style="margin-left: 10px; margin-right:10px;">
                <form @submit.prevent="add">
                <p class="mt-2 mb-4">Please choose a type to test patient <span class="text-primary font-weight-bold">{{ user.patient_name }} </span></p>
                
                <!-- <blockquote class="border-light border rounded ">
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
                </blockquote> -->

                <div class="row customerform">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Type of Test: <span v-if="errors.test" class="haveerror">({{ errors.test[0] }})</span></label>
                                <multiselect 
                                :disabled="dis"
                                v-model="test" 
                                :options="tests"
                                :allow-empty="false"
                                :show-labels="false"
                                open-direction="bottom"
                                placeholder="Select Type">
                            </multiselect>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm btn-block waves-effect waves-light mt-2 mb-1">Save</button>
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
                tests: ["RT-PCR","Antigen"],
                test: '', 
                user: '',
                dis:false
            }
        },

        methods : {
            set(user){
                this.user = user;
            },
            set2(user){
                this.user = user;
                this.test = 'RT-PCR';
                this.dis = true;
            },
            add(){
                axios.post(this.currentUrl + '/request/admission/test', {
                    id: this.user.id,
                    test: this.test
                })
                .then(response => {
                    this.$emit('status', response.data.data);
                    $("#result").modal('hide');
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
