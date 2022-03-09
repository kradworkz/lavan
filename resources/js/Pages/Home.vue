<template>
    <div>
        <div class="row mb-0">
            <div class="col-12" style="margin-bottom: -10px;">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4><span class="mb-0 font-size-13 font-weight-bold">Dashboard</span></h4>

                    <div class="page-title-right font-size-11">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <home-index v-if="type != 'Super Administrator'"></home-index>
        <home-admin v-else></home-admin>
    </div>
</template>
<script>
export default {
    data(){
        return {
            type: window.User.type
        }
    }
}
</script>
