<template>
    <div>
        <router-link :to="{ name: 'laptop/create' }"> create here </router-link> \
        <br>
        <br>
        <hr>
        list of laptops
        <br>
       <table class="table table-bordered">
            <thead>
                <tr>
                <th>id</th>
                <th>name</th>
                <th>created at</th>
                <th>updated at</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="list in lists" v-bind:key="list.id" >
                    <td>{{ list.id }}</td>
                    <td>{{ list.name }}</td>
                    <td>{{ list.created }}</td>
                    <td>{{ list.updated }}</td>
                    <td><button type="button" @click="edit(list)">edit</button></td>
                </tr>
            </tbody>
       </table>

        <div class="modal fade exampleModal" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <laptop-create  @status="message" ref="create"></laptop-create>
        </div>

    </div>
</template>
<script>
export default {
    data(){
        return {
            currentUrl: window.location.origin,
            lists: []
        }
    },

    created(){
        this.getLists();
    },

    methods : {
        getLists() {
            axios.get(this.currentUrl + '/laptops')
            .then(response => {
                this.lists = response.data.data;
            })
            .catch(err => console.log(err));
        },

        edit(list){
            $("#create").modal('show');
            this.$refs.create.update(list);
        },

        message(list){
            let index = this.lists.findIndex(u => u.id === list.id);
            this.$set(this.lists, index, list);
        }

        
    }
}
</script>
