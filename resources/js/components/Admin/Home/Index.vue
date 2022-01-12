<template>
<div class="row">
    
                
                
    <!-- end col -->

    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="media">
                   
                    <div class="media-body">
                        

                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <p class="text-muted text-truncate mb-2">Total Positive Cases</p>
                                    <h5 class="mb-0">{{ total.active}}</h5>
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <p class="text-muted text-truncate mb-2">Total Isolated Person</p>
                                    <h5 class="mb-0">{{ total.isolated }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </div>
                
            </div>
        </div>


      

        <div class="card">
            <div class="card-body">
                <h6 class="font-size-12 font-weight-bold mb-4 text-muted">UNDER ISOLATION</h6>
                <div class="table-responsive mt-2 mb-4">
                    <table class="table table-centered mb-0">
                        <tbody>
                            <tr v-for="c in category" v-bind:key="c.id">
                                <td>
                                    <h5 :class="'text-'+c.color" class="font-size-14 mb-1">{{c.name.match(/\b(\w)/g).join('') }} 
                                        <span class="text-muted font-size-12">({{c.name}})</span>
                                    </h5>
                                </td>
                                <td class="text-right">
                                    <h5 class="mb-0">{{c.count}}</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   <span class="text-muted font-weight-bold">Total : </span>
                                </td>
                                <td class="text-right">
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        
    </div>
    <!-- end col -->

    <div class="col-xl-8">
        <div class="row">
            <div class="col-lg-4" v-for="c in cases" v-bind:key="c.id">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        
                        <div class="d-flex flex-wrap">
                            <div class="mr-3">
                                <p class="text-muted mb-2">{{c.name}}</p>
                                <h5 class="mb-0">{{c.count}}</h5>
                            </div>

                            <div class="avatar-sm ml-auto">
                                <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                   <i :class="'text-'+c.color+' '+c.icon"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="card">
            <div class="card-body">
                <div class="float-right">
                    <select class="custom-select custom-select-sm ml-2">
                        <option value="1" selected="">March</option>
                        <option value="2">February</option>
                        <option value="3">January</option>
                        <option value="4">December</option>
                    </select>
                </div>
                <h4 class="card-title mb-3 text-primary">
                    Facilities  
                    <span class="font-size-13 text-muted mb-4"> ({{facility.facility.facility}} Facilities)</span>
                </h4>
       
                <div class="row">
                    <div class="col-lg-5">
                        <div class="mt-3">
                            <p class="font-weight-bold mb-0">Bed Occupancy</p>
                            <h4>
                                 {{ parseFloat((facility.facility.occupied/facility.facility.total) * 100).toFixed(2) }}% 
                                <span class="font-size-13 text-muted mb-4"> ({{ facility.facility.total}} total) <i class="mdi mdi-arrow-up ml-1 text-success"></i></span>
                            </h4>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <div>
                                        <p class="mb-1 font-weight-bold text-danger">Occupied</p>
                                        <h5>{{ facility.facility.occupied }}</h5>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div>
                                        <p class="mb-1 font-weight-bold text-info">Vacant</p>
                                        <h5>{{ facility.facility.vacant }}</h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="table-responsive mt-4">
                                        <table class="table table-centered table-nowrap">
                                            <tbody>
                                                <tr v-for="bed in facility.beds" v-bind:key="bed.id">
                                                    <td style="width: 30%">
                                                        <p class="mb-0">{{bed.name}}</p>
                                                    </td>
                                                    <td style="width: 25%">
                                                        <h5 class="mb-0">{{bed.total}} <span class="text-muted font-size-11">({{ bed.type[0].count}} of {{ bed.type[1].count}})</span></h5></td>
                                                    <td>
                                                        <div class="progress" style="height: 10px;">
                                                            <div class="progress-bar" role="progressbar" :style="'width:'+parseFloat((bed.type[0].count/bed.total) * 100).toFixed(2)+'%;'" aria-valuenow="25" aria-valuemin="0" aria-valuemax=""></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                         

                        </div>
                    </div>


                    <div class="col-lg-7 col-sm-6 align-self-center">
                        <div>
                            <p class="mb-2"><i class="mdi mdi-circle align-middle font-size-10 mr-2 text-primary"></i> Ethereum</p>
                            <h5>4.5701 ETH = <span class="text-muted font-size-14">$ 1123.64</span></h5>
                        </div>

                        <div class="mt-4 pt-2">
                            <p class="mb-2"><i class="mdi mdi-circle align-middle font-size-10 mr-2 text-warning"></i> Bitcoin</p>
                            <h5>0.4412 BTC = <span class="text-muted font-size-14">$ 4025.32</span></h5>
                        </div>

                        <div class="mt-4 pt-2">
                            <p class="mb-2"><i class="mdi mdi-circle align-middle font-size-10 mr-2 text-info"></i> Litecoin</p>
                            <h5>35.3811 LTC = <span class="text-muted font-size-14">$ 2263.09</span></h5>
                        </div>
                    </div>
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
            windowHeight: window.innerHeight,
            windowWidth: window.innerWidth,
            errors: [],
            pagination: {},
            keyword: '',
            facility : {
                facility: []
            },
            cases: [],
            category: [],
            total: {}
        }
    },

    computed : {
        height: function() {
            return this.windowHeight - 170;
        },
        width: function() {
            return this.windowWidth;
        },
        counts: function(){
            return Math.floor((this.height - 125) / 54);
        }
    },

    created(){;
        this.fetchFacility();
        this.fetchCases();
        this.fetchCategory();
        this.fetchTotal();
    },

    methods: {
       fetchFacility(){
            axios.get(this.currentUrl + '/statistics/facility')
            .then(response => {
                this.facility = response.data;
            })
            .catch(err => console.log(err));
       },

        fetchCases(){
            axios.get(this.currentUrl + '/statistics/cases')
            .then(response => {
                this.cases = response.data;
            })
            .catch(err => console.log(err));
        },

        fetchCategory(){
            axios.get(this.currentUrl + '/statistics/isolated')
            .then(response => {
                this.category = response.data;
            })
            .catch(err => console.log(err));
        },

        fetchTotal(){
            axios.get(this.currentUrl + '/statistics/total')
            .then(response => {
                this.total = response.data;
            })
            .catch(err => console.log(err));
        },
    }, 
}
</script>