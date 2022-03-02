<template>
<div class="d-xl-flex">                
    <div class="w-100">
        <div class="card">
            <div class="card-body" :style="{ height: height + 'px' }">
                <div class="row mb-3">
                    <div class="col-xl-6 col-sm-6 form-inline">
                        <button type="button" @click="checkin" class="btn btn-danger waves-effect waves-light mr-2"><i class='bx bx-plus-medical'></i></button>
                        <form class="float-sm-right form-inline">
                            <div class="search-box">
                                <div class="position-relative">
                                    <input type="text" class="form-control bg-light border-light rounded" placeholder="Search..." v-model="keyword" @keyup="fetch()">
                                   <i class='bx bx-search-alt search-icon'></i>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-6 col-sm-6">
                        <ul class="list-inline user-chat-nav text-right mb-0 dropdown">
                           <li class="list-inline-item d-none d-sm-inline-block font-size-12">
                                {{(pagination.current_page == 1) ? '1' : ((pagination.current_page -1) * pagination.per_page) + 1 }}-{{(pagination.last_page == pagination.current_page) ? pagination.total : pagination.current_page * pagination.per_page }} of {{pagination.total}}
                            </li>
                            <li class="list-inline-item d-none d-sm-inline-block">
                                <a class="btn nav-btn" v-bind:class="[{disabled: !pagination.prev_page_url}]" @click="fetch(pagination.prev_page_url)">
                                    <i class='bx bxs-chevron-left font-size-16'></i>
                                </a>
                            </li>
                            <li class="list-inline-item d-none d-sm-inline-block">
                                <a class="btn nav-btn" v-bind:class="[{disabled: !pagination.next_page_url}]" @click="fetch(pagination.next_page_url)">
                                    <i class='bx bxs-chevron-right font-size-16'></i>
                                </a>
                            </li>
                            <li class="list-inline-item d-non d-sm-inline-block">
                                <div class="dropdown">
                                    <button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-light" style="margin-right: -5px;"><span class="d-none d-sm-inline-block"> <i class='bx bx-clipboard'></i></span></button>                                 
                                    <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a @click="filter('-','status')" class="dropdown-item">All</a>
                                        <a @click="filter(status.id,'status')" class="dropdown-item" v-for="status in statuses" v-bind:key="status.id">{{status.name}}</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap">
                        <thead class="thead-light">
                            <tr class="font-size-11">
                                <th style="width: 2%;"></th>
                                <th>Name</th>
                                <th class="text-center">Facility</th>
                                <th class="text-center">Port of Exit</th>
                                <th class="text-center">Date of Completion</th>
                                <th class="text-center">Category</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="list in lists" v-bind:key="list.id" :class="[(list.status.name == 'Active') ? 'bg-soft-warning' : '']">
                                <td>
                                    <div class="avatar-xs">
                                        <span class="avatar-title rounded-circle">{{list.patient_name.charAt(0)}}</span>
                                    </div>
                                </td>
                                <td>
                                    <h5 class="font-size-12 mb-0 text-dark">{{list.patient_name}}</h5>
                                    <p class="font-size-12 text-muted mb-0">{{list.patient_address}}</p>
                                </td>
                                <td class="text-center">
                                    
                                    <h5 v-if="list.is_home == 0" class="font-size-12 mb-0 text-dark">Floor {{list.facility.bed.floor}} - Bed {{list.facility.bed.name}}</h5>
                                    <p v-if="list.is_home == 0" class="font-size-12 text-muted mb-0">{{list.facility.bed.facility.name}}</p>
                                    <span v-else class="text-info font-weight-bold font-size-12">Home Quarantine</span>
                                </td>
                                <td class="text-center">
                                    <h5 class="font-size-12 mb-0 text-dark">{{list.exit_port}}</h5>
                                    <p class="font-size-12 text-muted mb-0">{{list.started_at}}</p>
                                </td>
                                <td class="text-center">{{list.completion_at}}</td>
                                <td class="text-center"><span :class="'badge badge-bg badge-'+list.status.color">{{list.status.name}}</span></td>
                                <td class="text-right">
                                    <button v-if="list.is_positive == null" type="button" @click="result(list)" class="btn btn-light waves-effect waves-light mr-2"><i class='text-danger bx bxs-virus'></i></button>
                                    <button type="button" @click="checkout(list)" class="btn btn-light waves-effect waves-light mr-2"><i class='bx bx-exit'></i></button>
                                   <!-- <button @click="checkout(list)" type="button" class="btn btn-sm btn-primary w-sm waves-effect waves-light">Checkout</button> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade exampleModal" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <admission-check @status="message" :categories="categories" ref="create"></admission-check>
    </div>

    <div class="modal fade exampleModal" id="checkout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <admission-checkout @status="message" ref="checkout"></admission-checkout>
    </div>

    <div class="modal fade exampleModal" id="result" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <admission-result @status="message" ref="result"></admission-result>
    </div>

</div>
</template>

<script>
export default {
    data(){
        return {
            currentUrl: window.location.origin,
            windowHeight: window.innerHeight,
            windowWidth: window.innerWidth,
            errors: [],
            statuses: [],
            pagination: {},
            keyword: '',
            lists : [],
            status: '-',
            categories: []
        }
    },

    computed : {
        height: function() {
            return this.windowHeight -190;
        },
        width: function() {
            return this.windowWidth;
        },
        counts: function(){
            return Math.floor((this.height - 125) / 54);
        }
    },

    created(){
        this.fetch();
        this.fetchStatus();
        this.fetchCategory();
    },

    methods: {
        makePagination(meta, links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev,
                total: meta.total,
                per_page: meta.per_page
            };
            this.pagination = pagination;
        },

        fetch(page_url) {
            let vm = this; let key,c,s;
            (this.keyword != '' && this.keyword != null) ? key = this.keyword : key = '-';
            (this.status != '' && this.status != null) ? s = this.status : s = '-';
            page_url = page_url || this.currentUrl + '/request/admissions/'+key+'/'+s+'/'+this.counts;

            axios.get(page_url)
            .then(response => {
                this.lists = response.data.data;
                vm.makePagination(response.data.meta, response.data.links);
            })
            .catch(err => console.log(err));
        },

        checkin(){
            $("#new").modal('show');
        },

        checkout(id){
            $("#checkout").modal('show');
            this.$refs.checkout.set(id);
            this.editable = 'checkout';
        },

        result(id){
            this.editable = true;
            $("#result").modal('show');
            this.$refs.result.set(id);
        },

        edit(list){
            this.editable = true;
            $("#new").modal('show');
            this.$refs.create.edit(list,true);
        },

        message(list){
            if(list){
                if(this.editable == true){
                    let index = this.lists.findIndex(u => u.id === list.id);
                    this.lists[index] = list;
                    this.$set(this.lists, index, list);
                    Vue.$toast.success('<strong>Successfully Updated</strong>', {
                        position: 'bottom-right'
                    });
                }else if(this.editable == 'checkout'){
                    let i = this.lists.map(item => item.id).indexOf(list); 
                    this.lists.splice(i, 1);
                }else{
                    this.lists.unshift(list);
                    Vue.$toast.success('<strong>Successfully Created</strong>', {
                        position: 'bottom-right'
                    });
                }
                $("#new").modal('hide');
                this.editable = false;
            }
        },

        fetchStatus(){
            axios.get(this.currentUrl + '/request/dropdowns/Status')
            .then(response => {
                this.statuses = response.data.data;
            })
            .catch(err => console.log(err));
        },

        fetchCategory(){
            axios.get(this.currentUrl + '/request/dropdowns/Category')
            .then(response => {
                this.categories  = response.data.data;
            })
            .catch(err => console.log(err));
        },

        filter(data,type){
            switch(type){
                case 'category':
                    this.category = data;
                break;
                case 'status':
                    this.status = data;
                break;
            }

            let vm = this; let key;
            (this.keyword != '' && this.keyword != null) ? key = this.keyword : key = '-';
            this.fetch(this.currentUrl + '/request/admissions/'+key+'/'+this.category+'/'+this.status+'/'+this.counts);
        },

    }, 
}
</script>