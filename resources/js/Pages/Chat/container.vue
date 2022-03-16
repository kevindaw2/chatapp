<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <chat-group-select v-if="currentGroup.id" :groups="chatGroups" :currentGroup="currentGroup"
                                   v-on:groupchanged="setGroup( $event)"/>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <message-container :messages="messages" />
                    <input-message :group="currentGroup" v-on:messagesent="getMessages()"/>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import MessageContainer from "@/Pages/Chat/messageContainer";
import InputMessage from "@/Pages/Chat/inputMessage";
import ChatGroupSelect from "@/Pages/Chat/chatGroupSelect";

export default defineComponent({
    components: {
        ChatGroupSelect,
        AppLayout,
        InputMessage,
        MessageContainer
    },
    data: function () {
        return {
            chatGroups: [],
            currentGroup: [],
            messages: []
        }
    },
    watch: {
        currentGroup(value, oldValue) {
            if (oldValue.id ){
                this.disconnect(oldValue);
            }
            this.connect();
        }
    },
    methods: {
        connect() {
            if (this.currentGroup.id ) {
                let vm = this;
                this.getMessages();
                window.Echo.private("chat."+this.currentGroup.id).listen('.message.new', e=> {
                    vm.getMessages();
                });
            }
        },
        disconnect(group) {
            window.Echo.leave('chat.'+group.id);
        },
        getGroups() {
            axios.get('/chat/groups').then( response => {
                this.chatGroups = response.data;
                this.setGroup( response.data[0]);
            }).catch( error => {
                console.log(error);
            })
        },
        setGroup( group ) {
            this.currentGroup = group;
        },
        getMessages() {
            axios.get('/chat/group/' + this.currentGroup.id + '/messages').then(response => {
                this.messages = response.data;
            }).catch(error => {
                console.log(error);
            })
        }
    },
    created() {
        this.getGroups();
    }
})
</script>
