<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <breeze-responsive-nav-link :href="route('user.application.index')" :active="route().current('user.application.index')">
                            Dashboard
                        </breeze-responsive-nav-link>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <div>
                <el-alert
                    v-if="$page.props.flash.success"
                    title="Success"
                    type="success"
                    :description="$page.props.flash.success"
                    center
                    show-icon>
                </el-alert>

                <el-alert
                    v-if="$page.props.flash.error"
                    title="Error"
                    type="error"
                    :description="$page.props.flash.error"
                    center
                    show-icon>
                </el-alert>
            </div>

            <!-- Page Content -->
            <main>

                <slot />
            </main>
        </div>
    </div>
</template>

<script>
    import BreezeApplicationLogo from '@/Components/ApplicationLogo'
    import BreezeDropdown from '@/Components/Dropdown'
    import BreezeDropdownLink from '@/Components/DropdownLink'
    import BreezeNavLink from '@/Components/NavLink'
    import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink'

    export default {
        components: {
            BreezeApplicationLogo,
            BreezeDropdown,
            BreezeDropdownLink,
            BreezeNavLink,
            BreezeResponsiveNavLink,
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },
    }
</script>

<style>

.el-alert__title {
    font-size: 22px !important;
}

.el-alert__description {
    font-size: 18px !important;
}
</style>
