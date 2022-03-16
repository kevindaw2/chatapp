<template>
    <div class="grid grid-cols-2">
        <div class="font-bold text-xl">
            {{ selected.name }}
        </div>
        <div>
            <select v-model="selected" @change="$emit('groupchanged', selected)" class="float-right">
                <option v-for="(group, index) in groups" :key="index" :value="group">
                    {{ group.name }}
                </option>
            </select>
        </div>
    </div>
</template>

<script>
export default {
    props: ['groups', 'currentGroup'],
    data: function () {
        return {
            selected: ''
        }
    },

    created() {
        this.selected = this.currentGroup;
    }
}
</script>
