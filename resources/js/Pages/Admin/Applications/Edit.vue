<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Application
            </h2>
            <div class="float-right">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item>
                        <inertia-link class="text-decoration-none" :href="route('admin.dashboard')">Home</inertia-link>
                    </el-breadcrumb-item>
                    <el-breadcrumb-item>
                        <inertia-link class="text-decoration-none" :href="route('admin.applications.index')">Applications</inertia-link>
                    </el-breadcrumb-item>
                    <el-breadcrumb-item>Edit</el-breadcrumb-item>
                </el-breadcrumb>
            </div>
        </template>

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <div>
                            <el-form :model="form" :rules="rules" ref="form" label-width="auto" class="demo-form">

                                <h1>Personal Details</h1>

                                <div class="row">
                                    <el-form-item label="Name" prop="personal_details.name" class="col-md-6">
                                        <el-input v-model="form.personal_details.name" placeholder="Enter Name"></el-input>
                                    </el-form-item>

                                    <el-form-item label="Email" prop="personal_details.email" class="col-md-6">
                                        <el-input v-model="form.personal_details.email" placeholder="Enter Email"></el-input>
                                    </el-form-item>
                                </div>

                                <div class="row">
                                    <el-form-item label="Address" prop="personal_details.address" class="col-md-6">
                                        <el-input type="textarea" v-model="form.personal_details.address" placeholder="Enter Address"></el-input>
                                    </el-form-item>

                                    <el-form-item label="Gender" prop="personal_details.gender" class="col-md-6">
                                        <el-radio-group v-model="form.personal_details.gender">
                                            <el-radio label="M">Male</el-radio>
                                            <el-radio label="F">Female</el-radio>
                                        </el-radio-group>
                                    </el-form-item>
                                </div>

                                <div class="row">
                                    <el-form-item label="Contact No." prop="personal_details.contact" class="col-md-6">
                                        <el-input type="number" v-model="form.personal_details.contact" placeholder="Enter Contact No."></el-input>
                                    </el-form-item>
                                </div>
                                <el-divider></el-divider>

                                <h1>Education Details</h1>

                                <div class="row">
                                    <el-form-item label="Qualification" prop="education_details.qualification" class="col-md-6">
                                        <el-select v-model="form.education_details.qualification" placeholder="Select Qualification">
                                            <el-option :label="education.name" :value="education.id" v-for="education in educations"></el-option>
                                        </el-select>
                                    </el-form-item>

                                    <el-form-item label="Board/University" prop="education_details.board_university" class="col-md-6">
                                        <el-input v-model="form.education_details.board_university" placeholder="Enter Board/University"></el-input>
                                    </el-form-item>
                                </div>

                                <div class="row">
                                    <el-form-item label="Year" prop="education_details.year" class="col-md-6">
                                        <el-date-picker
                                            v-model="form.education_details.year"
                                            type="year"
                                            placeholder="Select year">
                                        </el-date-picker>
                                    </el-form-item>

                                    <el-form-item label="Percentage" prop="education_details.percentage" class="col-md-6">
                                        <el-input type="number" step="0.01" v-model="form.education_details.percentage" placeholder="Enter Percentage.">
                                            <template #append><el-button>%</el-button></template>
                                        </el-input>
                                    </el-form-item>
                                </div>
                                <el-divider></el-divider>

                                <h1>Work Experience</h1>

                                <div class="border pt-3" v-for="(experience, index) in form.work_experience">
                                    <!-- <div class="col-12 p-1 pb-5">
                                        <el-button @click="deleteItem(index)" class="float-right" type="danger" icon="el-icon-delete" circle></el-button>
                                    </div> -->
                                    <div class="row">
                                        <el-form-item label="Company" class="col-md-6"
                                            :prop="'work_experience.' + index + '.company'"
                                            :rules="{required: true, message: 'Please enter company', trigger: 'blur'}">
                                            <el-input v-model="experience.company" placeholder="Enter Company"></el-input>
                                        </el-form-item>
                                        <el-form-item label="Designation" class="col-md-6"
                                            :prop="'work_experience.' + index + '.designation'"
                                            :rules="{required: true, message: 'Please enter designation', trigger: 'blur'}">
                                            <el-input v-model="experience.designation" placeholder="Enter Designation"></el-input>
                                        </el-form-item>
                                    </div>
                                    <div class="row">
                                        <el-form-item label="From Date" class="col-md-6"
                                            :prop="'work_experience.' + index + '.fromDate'"
                                            :rules="{required: true, message: 'Please select date', trigger: 'change'}">
                                            <el-date-picker
                                                v-model="experience.fromDate"
                                                type="date"
                                                placeholder="Select Date"
                                                @change="fromDateChangedHandler(experience)">
                                            </el-date-picker>
                                        </el-form-item>
                                        <el-form-item label="To Date" class="col-md-6"
                                            :prop="'work_experience.' + index + '.toDate'"
                                            :rules="{required: true, message: 'Please select date', trigger: 'change'}">
                                            <el-date-picker
                                                v-model="experience.toDate"
                                                type="date"
                                                placeholder="Select Date"
                                                @change="toDateChangedHandler(experience)">
                                            </el-date-picker>
                                        </el-form-item>
                                    </div>
                                </div>
                                <!-- <div class="row pt-3">
                                    <el-form-item class="col-md-3">
                                        <el-button type="success" @click="addItem">{{ form.work_experience.length > 0 ? 'Add More' : 'Add Experience' }}</el-button>
                                    </el-form-item>
                                </div> -->
                                <el-divider></el-divider>

                                <h1>Known Languages</h1>

                                <el-form-item>
                                    <div v-for="language in form.languages">
                                        <el-checkbox v-model="language.is_checked" :label="language.name" class="col-md-1 fw-bold" @change="languageChangeHandler(language)"></el-checkbox>
                                        <el-checkbox v-model="language.read" label="Read" :disabled="language.is_disabled"></el-checkbox>
                                        <el-checkbox v-model="language.write" label="Write" :disabled="language.is_disabled"></el-checkbox>
                                        <el-checkbox v-model="language.speak" label="Speak" :disabled="language.is_disabled"></el-checkbox>
                                    </div>

                                </el-form-item>
                                <el-divider></el-divider>

                                <h1>Technical Experience</h1>
                                <el-form-item>
                                    <div v-for="skill in form.skills">
                                        <el-checkbox v-model="skill.is_checked" :label="skill.name" class="col-md-1 fw-bold" @change="skillChangeHandler(skill)"></el-checkbox>
                                        <el-radio v-model="skill.type" :label="beginner" :disabled="skill.is_disabled">Beginner</el-radio>
                                        <el-radio v-model="skill.type" :label="mediator" :disabled="skill.is_disabled">Mediator</el-radio>
                                        <el-radio v-model="skill.type" :label="expert" :disabled="skill.is_disabled">Expert</el-radio>
                                    </div>
                                </el-form-item>
                                <el-divider></el-divider>

                                <h1>Preference</h1>

                                <div class="row">
                                    <el-form-item label="Preferred Location" prop="preference.location" class="col-md-6 preference-location">
                                        <el-select v-model="form.preference.location" placeholder="Select Location">
                                            <el-option :label="location.name" :value="location.id" v-for="location in locations"></el-option>
                                        </el-select>
                                    </el-form-item>

                                    <el-form-item label="Expected CTC" prop="preference.expected_ctc" class="col-md-6">
                                        <el-input type="number" v-model="form.preference.expected_ctc" placeholder="Enter Expected CTC"><template #append><el-button>₹</el-button></template></el-input>

                                    </el-form-item>
                                </div>

                                <div class="row">
                                    <el-form-item label="Current CTC" prop="preference.current_ctc" class="col-md-6">
                                        <el-input type="number" v-model="form.preference.current_ctc" placeholder="Enter Current CTC"><template #append><el-button>₹</el-button></template></el-input>
                                    </el-form-item>

                                    <el-form-item label="Notice Period" prop="preference.notice_period" class="col-md-6">
                                        <el-input v-model="form.preference.notice_period" placeholder="Enter Notice Period"></el-input>
                                    </el-form-item>
                                </div>
                                <el-divider></el-divider>

                                <el-form-item>
                                    <el-button type="primary" @click="submitForm('form')">Save</el-button>
                                    <inertia-link class="el-button text-decoration-none" :href="route('admin.applications.index')">Cancel</inertia-link>
                                </el-form-item>
                            </el-form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>

import BreezeAuthenticatedLayout from '@/Layouts/Admin/Authenticated'

const beginner = 1;
const mediator = 2;
const expert   = 3;

const is_checked = 1;
const read = 1;
const write = 2;
const speak = 3;

export default {
    props: ['user', 'educations', 'locations'],
    components: {
        BreezeAuthenticatedLayout,
    },

    data() {
        return {
            form: {
                personal_details: {
                    id: this.user.id,
                    name: this.user.name,
                    email: this.user.email,
                    address: this.user.address,
                    gender: this.user.gender,
                    contact: this.user.contact_number,
                },

                education_details: {
                    id: this.user.education.id,
                    qualification: this.user.education.education_id,
                    board_university: this.user.education.name,
                    year: dayjs().year(this.user.education.year),
                    percentage: this.user.education.percentage,
                },

                work_experience: [],
                
                languages: [],

                skills: [],

                preference: {
                    'id': this.user.preference.id,
                    'location': this.user.preference.city_id,
                    'expected_ctc': this.user.preference.expected_ctc,
                    'current_ctc': this.user.preference.current_ctc,
                    'notice_period': this.user.preference.notice_period,
                }

            },
            rules: {
                personal_details: {
                    name: [
                        { required: true, message: 'Please enter name', trigger: 'blur' }
                    ],
                    email: [
                        { required: true, message: 'Please enter email address', trigger: 'blur' },
                        { type: 'email', message: 'Please enter valid email address', trigger: ['blur', 'change'] }
                    ],
                    address: [
                        { required: true, message: 'Please enter address', trigger: 'blur' }
                    ],
                    gender: [
                        { required: true, message: 'Please select gender', trigger: 'change' }
                    ],
                    contact: [
                        { required: true, message: 'Please enter contact no.', trigger: 'blur' },
                        { min: 10, max: 10, message: 'Please enter valid contact no.', trigger: 'blur' }
                    ],
                },
                education_details: {
                    qualification: [
                        { required: true, message: 'Please select qualification', trigger: 'change' }
                    ],
                    board_university: [
                        { required: true, message: 'Please enter board/university', trigger: 'blur' }
                    ],
                    year: [
                        { required: true, message: 'Please select year', trigger: 'change' }
                    ],
                    percentage: [
                        { required: true, message: 'Please enter percentage', trigger: 'blur' }
                    ],
                },

                preference: {
                    location: [
                        { required: true, message: 'Please select location', trigger: 'change' }
                    ],
                    expected_ctc: [
                        { required: true, message: 'Please enter expected ctc', trigger: 'blur' }
                    ],
                    current_ctc: [
                        { required: true, message: 'Please enter current ctc', trigger: 'blur' }
                    ],
                    notice_period: [
                        { required: true, message: 'Please enter notice period', trigger: 'blur' }
                    ],
                }
            },
            beginner: beginner,
            mediator: mediator,
            expert: expert,
        };
    },
    created() {

        this.init();
    },
    methods: {
        init() {
            this.loadData();
        },
        skillType(skill) {
            if (skill.is_beginer === 1) { return beginner; }

            if (skill.is_mediator === 1) { return mediator; }

            if (skill.is_expert === 1) { return expert; }

            return null;

        },
        loadData() {
            this.user.experiences.map((experience) => { 
                this.form.work_experience.push({
                    id: experience.id,
                    company: experience.company_name,
                    designation: experience.designation,
                    fromDate: dayjs(experience.from).format('YYYY-MM-DD'),
                    toDate: dayjs(experience.to).format('YYYY-MM-DD'),
                });
            });
            
            this.user.skills.map((skill) => { 
                this.form.skills.push({
                    'id': skill.id,
                    'name': skill.skill.name,
                    'is_checked': skill.is_checked === is_checked,
                    'type': this.skillType(skill),
                    'is_disabled': skill.is_checked !== is_checked
                });
            });

            this.user.languages.map((language) => { 
                this.form.languages.push({
                    'id': language.id,
                    'name': language.language.name,
                    'is_checked': language.is_checked === is_checked,
                    'read': language.is_read === read,
                    'write': language.is_write === write,
                    'speak': language.is_speak === speak,
                    'is_disabled': language.is_checked !== is_checked
                });
            });
        },
        submitForm(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.form.education_details.year = dayjs(this.form.education_details.year).format('YYYY');
                    this.$inertia.post(this.route('admin.applications.store'), this.form)
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
                } else {
                    return false;
                }
            });
        },
        resetForm(formName) {
            this.$refs[formName].resetFields();
        },
        /*addItem () {
            this.form.work_experience.push({
                company: '',
                designation: '',
                fromDate: '',
                toDate: '',
            })
        },
        deleteItem (index) {
            this.form.work_experience.splice(index, 1)
        },*/
        languageChangeHandler (language) {
            language.read = false;
            language.write = false;
            language.speak = false;
            if (language.is_checked) {
                language.is_disabled = false;
            } else {
                language.is_disabled = true;
            }
        },
        skillChangeHandler (skill) {
            skill.type = '';
            if (skill.is_checked) {
                skill.is_disabled = false;
            } else {
                skill.is_disabled = true;
            }
        },
        fromDateChangedHandler (experience) {
            experience.fromDate = dayjs(experience.fromDate).format('YYYY-MM-DD');
        },
        toDateChangedHandler (experience) {
            experience.toDate = dayjs(experience.toDate).format('YYYY-MM-DD');
        }
    }
}

</script>

<style scoped>

h1 {
    text-align: center;
    font-size: 22px;
    padding: 15px 0;
    text-decoration: underline;
}
h2 {
    font-size: 27px;
}
.preference-location label.el-form-item__label {
    width: auto !important;
}
</style>
