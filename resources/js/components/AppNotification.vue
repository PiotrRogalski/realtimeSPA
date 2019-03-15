<template>
  <div class="text-xs-center">
    <v-menu offset-y>
      <v-btn icon slot="activator">
        <v-icon color="red">add_alert</v-icon>{{ unreadedCount }}
      </v-btn>
      <v-list v-if="notificationsCount">

        <p v-if="unreadedCount">Unread:</p>
        <v-list-tile v-for="item in unreaded" :key="item.id">
          <router-link :to="item.questionPath">
            <v-list-tile-title @click="readIt(item)">{{ item.questionTitle }}</v-list-tile-title>
          </router-link>
        </v-list-tile>

        <v-divider v-if="readedCount"></v-divider>

        <p v-if="readedCount">Read:</p>
        <v-list-tile v-for="item in readed" :key="item.id">
          <router-link :to="item.questionPath">
            <v-list-tile-title>{{ item.questionTitle }}</v-list-tile-title>
          </router-link>
        </v-list-tile>

      </v-list>
      <v-list v-else>
        You dont have any notifications.
      </v-list>
    </v-menu>
  </div>
</template>

<script>
    export default {
        data() {
            return {
                readed: [],
                unreaded: [],
                notifications: {},
                unreadedCount: 0,
                notificationsCount: 0,
            }
        },
        created() {
            if (User.isLogged()) {
                this.getNotifications();
            }
            this.readedCount = this.notificationsCount - this.unreadedCount;
        },
        methods: {
            getNotifications() {
                axios.get('/api/notification')
                    .then(res => {
                        this.notifications = res.data.notifications;
                        this.notificationsCount = this.notifications.length;
                        this.showNotifications();
                    }).catch(error => console.log(error.response.data));
            },
            showNotifications() {
                //checking if notification was read or not
                if (this.notificationsCount) {
                    this.notifications.forEach(notification => {
                        //giving him id of notification
                        notification.data.id = notification.id;
                        if (notification.read_at) {
                            this.readed.unshift(notification.data);
                        } else {
                            this.unreaded.unshift(notification.data);
                            ++this.unreadedCount;
                        }
                    });
                }
            },
            readIt(notification) {
                axios.post('/api/notification/readIt', {id: notification.id})
                    .then(res => {
                        console.log(res.data);
                        this.unreaded.splice(notification.id, 1);
                        this.readed.unshift(notification);
                        --this.unreadedCount;
                    })
            }
        },
    }
</script>