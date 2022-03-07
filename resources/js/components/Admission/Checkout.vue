<template>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Checkout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                
            <div class="modal-body">
                
                <p class="text-center">Are you sure you want to checkout <span class="text-primary font-weight-bold">{{ user.patient_name }} </span></p>
                
                <p class="text-center text-muted">Please type "confirm"</p>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="form-group" style="margin-top: 10px;">         
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" v-model="died" class="custom-control-input" id="formrow-customCheck">
                                <label class="custom-control-label font-size-12" for="formrow-customCheck">Patient <b>Died</b>?</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="confirm">
                        </div>
                        <div class="text-center mt-2" v-if="confirm == 'confirm'">
                            <button type="button" @click="checkout" class="btn btn-success btn-sm w-lg">Checkout</button>
                        </div>
                    </div>
                </div>
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
                user: '',
                confirm: '',
                died: false
            }
        },

        methods : {
            set(user){
                this.user = user;
            },

            checkout(){
                axios.post(this.currentUrl + '/request/admission/checkout', {
                    id: this.user.id,
                    died: this.died,
                })
                .then(response => {
                    this.$emit('status', response.data);
                    $("#checkout").modal('hide');
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
