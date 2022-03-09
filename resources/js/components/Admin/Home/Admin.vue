<template>
    <div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <p class="text-muted text-truncate mb-2">No. of Municipalities</p>
                        <h5 class="mb-0">{{lists.municipality}}</h5>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <p class="text-muted text-truncate mb-2">No. of Facility</p>
                        <h5 class="mb-0">{{lists.facility}}</h5>
                    </div>
                </div>
            </div>
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
        this.fetchAdmin();
    },

    methods: {
        fetchAdmin(){
            axios.get(this.currentUrl + '/request/dashboard/admin')
            .then(response => {
                this.lists = response.data;
                console.log(this.lists);
            })
            .catch(err => console.log(err));
        },
    }
}
</script>