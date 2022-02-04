<template>
  <modal ref="modal">
        <template v-slot:header>
            Detail Data Candidate
        </template>

        <template v-slot:content>
                <table class="table table-bordered table-md" v-if="isNotEmpty">
                    <tr>
                        <th>Name</th>
                        <td>{{ model.name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ model.email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ model.phone }}</td>
                    </tr>
                    <tr>
                        <th>Birth Date</th>
                        <td>{{ model.birth_date_format }}</td>
                    </tr>
                    <tr>
                        <th>Education</th>
                        <td>{{ model.education || '-' }}</td>
                    </tr>
                    <tr>
                        <th>Last Position</th>
                        <td>{{ model.last_position || '-' }}</td>
                    </tr>
                    <tr>
                        <th>Applied Position</th>
                        <td>{{ model.applied_position }}</td>
                    </tr>
                    <tr>
                        <th>Skills</th>
                        <td>
                            <div class="badge badge-primary mx-1" v-for="skill in model.skills" :key="skill.id">{{ skill.name }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>File</th>
                        <td><a :href="model.resume.url" target="_blank"> {{ model.resume.filename || '-' }}</a></td>
                    </tr>
                </table>
        </template>
  </modal>
</template>

<script>
import Modal from './Modal.vue';

export default {
    components: { Modal },
    data: () => ({
        model: {}
    }),
    mounted: function() {
        var vm = this;

        vm.$nextTick(() => {
            $('.btn-detail').click(function() {
                let me = $(this),
                    model = me.data('model');

                    vm.model = model;
                    vm.showModal()
            })
        });
    },
    computed: {
        isNotEmpty: function () {
            return !$.isEmptyObject(this.model)
        }
    },
    methods: {
        showModal() {
            let element = this.$refs.modal.$el;

            $(element).appendTo("body").modal('show')
        },
    }
}
</script>

<style>

</style>