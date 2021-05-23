<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div>
                            Welcome to Dashboard! 
                            <el-link type="primary">
                                <inertia-link :href="route('admin.applications.index')">
                                    Click here to view the applications.
                                </inertia-link>
                            </el-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Admin/Authenticated'

    export default {
        components: {
            BreezeAuthenticatedLayout,
        },

        props: {
            auth: Object,
            errors: Object,
        },
    }
</script>

<style scoped>

    .el-link--inner a {
        font-size: 18px !important;
    }

</style>
