<template>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Laptop Information</h5>
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
                                                                                            
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <span v-if="editable == true">Update</span>
                        <span v-else>Create</span></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            currentUrl: window.location.origin,
            errors: [],
            id: '',
            name: '',
            editable: false,
        }
    },

    methods : {
        create(){
            axios.post(this.currentUrl + '/laptop/store', { //http://covid-lavan.local/laptop/store
                id: this.id,
                name: this.name,
                editable: this.editable
            })
            .then(response => {
                this.id = '';
                this.name = '';
                this.editable = false;
                $("#create").modal("hide");
                this.$emit('status', response.data);
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

        update(list){
            this.id = list.id;
            this.name = list.name;
            this.editable = true;
        }
    }
}
</script>