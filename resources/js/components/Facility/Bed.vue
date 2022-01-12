<template>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ list.name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="create">
                <div class="modal-body"><br> 
                   <div class="table-responsive">
                        <table class="table table-bordered mb-0">

                            <thead>
                                <tr>
                                    <th class="text-center">Floor</th>
                                    <th class="text-center">Rooms</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(floor,index) in floors" v-bind:key="index">
                                    <td class="text-center">{{index+1}}</td>
                                    <td class="text-center">{{floor.total}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
                list: {},
                floors: []
            }
        },

       

        methods : {
            set(list){
                this.list = list;
            },

            fetch(){
                axios.get(this.currentUrl + '/request/rooms')
                .then(response => {
                    this.floors = response.data;
                })
                .catch(err => console.log(err));
            },

            create(){
                axios.post(this.currentUrl + '/request/admin/user/store', {
                    id: this.user.id,
                    is_active: (this.user.is_active == 1) ? 0 : 1,
                    editable: true
                })
                .then(response => {
                    this.$emit('status', response.data.data);
                    $("#updatestatus").modal('hide');
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                });
            },
        }
    }
</script>