<template>
  <v-toolbar>
    <!--<v-toolbar-side-icon></v-toolbar-side-icon>-->
    <v-toolbar-title>Bitfumes</v-toolbar-title>
    <v-spacer></v-spacer>
    <app-notification v-if="isLogged"></app-notification>
    <div class="hidden-sm-and-down">

      <router-link v-for="button in navbarButtons"
                   :key="button.text"
                   :to="button.to"
                   v-if="button.show">
        <v-btn flat>{{ button.text }}</v-btn>
      </router-link>

    </div>
  </v-toolbar>
</template>

<script>
  import AppNotification from './AppNotification'
    export default {
        components: {AppNotification},
        data() {
            return {
                navbarButtons: [
                    {text: 'Forum', to: '/forum', show: true},
                    {text: 'Ask Question', to: '/ask', show: User.isLogged()},
                    {text: 'Category', to: '/category', show: User.admin()},
                    {text: 'Logout', to: '/logout', show: User.isLogged()},
                    {text: 'Login', to: '/login', show: !User.isLogged()},
                ],
                isLogged: User.isLogged(),
            }
        },
        created() {
            EventBus.$on('logout', () => {
                User.logout();
            })
        },
    }
</script>
