<template>
    <div>
        <div class="row mb-0">
            <div class="col-12" style="margin-bottom: -10px;">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4><span class="mb-0 font-size-13 font-weight-bold">Patient Profile</span></h4>

                    <div class="page-title-right font-size-11">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">profile</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="d-xl-flex">                
            <div class="w-100">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Settings</h4>
                        <p class="text-muted mb-4">Dont' use easy-to-guess passwords, instead of trying to remember a different complex strong password.</p>
                        <form @submit.prevent="onSubmit" class="customerform">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Current Password: <span v-if="errors.current_password"
                                                class="haveerror">({{ errors.current_password[0] }})</span></label>
                                        <input type="password" class="form-control"
                                            :class="[(errors.current_password) ? 'is-invalid' : '']"
                                            v-model="current_password">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>New Password: <span v-if="errors.password"
                                                class="haveerror">({{ errors.password[0] }})</span></label>
                                        <input type="password" class="form-control"
                                            :class="[(errors.password) ? 'is-invalid' : '']" v-model="password">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Confirm Password: <span v-if="errors.password_confirmation"
                                                class="haveerror">({{ errors.password_confirmation[0] }})</span></label>
                                        <input type="password" class="form-control"
                                            :class="[(errors.password_confirmation) ? 'is-invalid' : '']"
                                            v-model="password_confirmation">
                                    </div>
                                </div>
                                <div class="col-md-12 d-inline-block mt-2">
                                    <button type="submit"
                                        class="btn btn-info w-lg float-end waves-effect waves-light mt-2">Update
                                        Password</button>
                                </div>
                            </div>
                        </form>
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
            errors: [],
            current_password: '',
            password: '',
            password_confirmation: '',
        }
    },

    methods: {
        onSubmit(evt) {
            evt.preventDefault();
            axios.post(this.currentUrl + '/request/user/password', {
                current_password: this.current_password,
                password: this.password,
                password_confirmation: this.password_confirmation,
            })
            .then(response => {
                if (response.data.success == "First Attempt") {
                    alert('wew');
                } else {
                    this.current_password = '';
                    this.password = '';
                    this.password_confirmation = '';
                    this.errors = [];
                    this.test = '';
                    Vue.$toast.success('<strong>Password Changed</strong>', {
                        position: 'bottom-right'
                    });
                }
            })
            .catch(error => {
                if (error.response.status == 422) {
                    this.errors = error.response.data.errors;
                }
                if (error.response.status == 401) {
                    this.errors = error.response.data.error;
                     Vue.$toast.error('<strong>Password didn`t matched</strong>', {
                        position: 'bottom-right'
                    });
                }
            });
        },
    }
}
</script>