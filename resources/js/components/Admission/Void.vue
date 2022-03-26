<template>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Viod Test</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                
            <div class="modal-body" style="margin-left: 10px; margin-right:10px;">
                <form @submit.prevent="add">
                <p class="mt-2 mb-4">Are you sure you want to void patient <span class="text-primary font-weight-bold">{{ user.patient.firstname  }} {{ user.patient.lastname  }}</span> from taking <span class="text-danger font-weight-bold">RT-PCR Swab?</span></p>
                
    
               
                <button type="submit" class="btn btn-primary btn-sm btn-block waves-effect waves-light mt-2 mb-1">Proceed</button>
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
                user: {
                    patient: {}
                },
            }
        },

        methods : {
            set(user){
                this.user = user;
            },
            add(){
                axios.post(this.currentUrl + '/request/admission/void', {
                    id: this.user.id
                })
                .then(response => {
                    this.$emit('status', response.data.data);
                    $("#void").modal('hide');
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
