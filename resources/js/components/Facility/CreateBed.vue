<template>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Room Management</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="create">
                <div class="modal-body">
                    <div class="row customerform" style="margin-right: 10px; margin-left: 10px;">
                        <div class="col-md-12 customerform" style="margin-top: 20px;">
                            <div class="row mb-2" style="margin-top: -20px;">
                                <div class="col-md-12">
                                <hr>
                                <button @click="add" style="margin-top: -55px;" class="btn btn-sm btn-primary pull-right" type="button">Add Floor</button>
                            </div>
                            </div>
                            <div class="row" v-for="(list, index) in lists" v-bind:key="'a-'+list.id+index" style="margin-top: -15px;">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Floor: <span v-if="errors['lists.'+index+'.floor']" class="haveerror">({{ errors['lists.'+index+'.floor'][0] }})</span></label>
                                        <input type="text" class="form-control" v-model="list.floor" readonly>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <label>Bed Capacity: <span v-if="errors['lists.'+index+'.bed']" class="haveerror">({{ errors['lists.'+index+'.bed'][0] }})</span></label>
                                                <input type="text" class="form-control" v-model="list.bed">
                                            </div>
                                        </div>
                                        <div class="col-md-1" style="margin-top: 10px;">
                                            <a v-if="(index+1) == lists.length"><i @click="del(index)" class='bx bx-trash font-size-22 mt-3 float-left' style="margin-left: -15px;"></i></a>
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
        props : ['id'],
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                lists: [],    
                editable: false,
                isLoading: false,
                fullPage: true,
                count : ''
            }
        },

        methods : {
            set(count){
                this.count = count;
                this.add();
            },

            create(){
                this.isLoading = true;
                axios.post(this.currentUrl + '/request/bed/store', {
                    id: this.id,
                    lists: this.lists
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
                this.id = list.id;
                this.name = list.name;
                this.address = list.address;
                this.barangay_id = list.barangay;
                this.is_main = list.is_main;
                this.editable = editable;
            },

            clear(){
                this.editable = false;
                $("#new").modal("hide");
                this.name = '';
                this.address = '';
                this.is_main = false;
                this.errors = [];
            },

            add() {
                this.count = this.count + 1;
                this.lists.push({floor: this.count})
            },

            del(index) {
                if(this.lists.length > 1){
                    this.lists.splice(index, 1);
                }
            },

        }, components: { Multiselect, Loading }
    }
</script>