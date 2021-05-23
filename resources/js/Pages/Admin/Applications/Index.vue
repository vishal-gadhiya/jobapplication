<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Applications
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="filter-container">
                            <el-input
                                v-model="search"
                                size="mini"
                                placeholder="Search..."/>
                        </div>
                        <el-table
                            :data="tableData.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()) || data.email.toLowerCase().includes(search.toLowerCase()) || data.gender.toLowerCase().includes(search.toLowerCase()) || data.contact.toLowerCase().includes(search.toLowerCase()))"
                            border
                            style="width: 100%">
                            <el-table-column
                                prop="id"
                                sortable
                                label="ID"
                                width="150">
                            </el-table-column>
                            <el-table-column
                                prop="name"
                                sortable
                                label="Name">
                            </el-table-column>
                            <el-table-column
                                prop="email"
                                sortable
                                label="Email"
                                width="300">
                            </el-table-column>
                            <el-table-column
                                prop="gender"
                                sortable
                                label="Gender">
                            </el-table-column>
                            <el-table-column
                                prop="contact"
                                sortable
                                label="Contact No.">
                            </el-table-column>
                            <el-table-column
                                label="Actions">
                                <template #default="scope">
                                    <el-button
                                        type="primary"
                                        size="mini"
                                        @click="handleEdit(scope.row)">Edit
                                    </el-button>
                                    <el-popconfirm
                                        confirmButtonText='OK'
                                        cancelButtonText='No, Thanks'
                                        icon="el-icon-info"
                                        iconColor="red"
                                        title="Are you sure to delete this user?"
                                        @confirm="handleDelete(scope.row)"
                                        >
                                        <template #reference>
                                            <el-button
                                                type="danger"
                                                size="mini">Delete
                                            </el-button>
                                        </template>
                                    </el-popconfirm>
                                    
                                </template>
                            </el-table-column>
                        </el-table>
                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Admin/Authenticated'

    export default {
        props: ['users'],
        components: {
            BreezeAuthenticatedLayout,
        },
        data() {
            return {
                tableData: [],
                search: '',
                items: this.users
            };
        },
        created() {
            this.init();
        },
        watch: {
            users () {
                this.tableData = [];
                this.init();
            }
        },
        methods: {
            init() {
                this.loadData();
            },
            loadData() {
                this.tableData = this.users.map((user) => {
                    return {
                        id: user.id,
                        name: user.name,
                        email: user.email,
                        gender: user.gender=='M' ? 'Male' : 'Female',
                        contact: user.contact_number
                    };
                });
            },
            handleEdit(row) {
                this.$inertia.get(route('admin.applications.edit', row.id))
            },
            handleDelete(row) {
                this.$inertia.delete(route('admin.applications.destroy', row.id))
                .then( () => {
                    if (this.$page.props.flash.success) {
                        this.$notify({
                            title: 'Success',
                            message: this.$page.props.flash.success,
                            type: 'success'
                        });
                    }
                    
                    if (this.$page.props.flash.error) {
                        this.$notify({
                            title: 'Error',
                            message: this.$page.props.flash.error,
                            type: 'error'
                        });
                    }
                });
            }
        }
    }
    
</script>

<style>

.filter-container {
    width: 250px;
    margin-bottom: 10px;
    float: right;
}

.el-input--mini .el-input__inner {
    height: 36px;
    line-height: 36px;
}
</style>
