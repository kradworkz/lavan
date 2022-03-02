<template>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dropdown Information</h5>
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
                                <div class="col-md-12" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Color: <span v-if="errors.color" class="haveerror">({{ errors.color[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="color" style="text-transform: lowercase;">
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Type: <span v-if="errors.type" class="haveerror">({{ errors.type[0] }})</span></label>
                                          <multiselect 
                                            v-model="type" 
                                            :options="roles"
                                            :allow-empty="false"
                                            :show-labels="false"
                                            placeholder="Select Type">
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
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                id: '',
                name: '',
                color: '',
                type: '',
                roles: ['Status','Category'],
                editable: false,
                isLoading: false,
                fullPage: true
            }
        },
        
        methods : {
            create(){
                this.isLoading = true;
                axios.post(this.currentUrl + '/request/dropdown/store', {
                    id: this.id,
                    name: this.name,
                    color: this.color,
                    type: this.type,
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

            edit(list,editable){
                this.name = list.name;
                this.color = list.color;
                this.type = list.type;
                this.editable = editable;
            },

            clear(){
                this.editable = false;
                $("#new").modal("hide");
                this.errors = [];
                this.name = '';
                this.color = '';
                this.type = '';
            },

        }, components: { Multiselect, Loading }
    }
</script>