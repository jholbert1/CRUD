<template>
  <v-toolbar color="primary">
    <v-toolbar-title class="hidden-sm-and-down">CRUD</v-toolbar-title>
    <v-toolbar-items class="show-sm-and-down hidden-md-and-up">
      <v-menu offset-y>
        <template v-slot:activator="{ on }">
          <v-btn flat dark v-on="on">
            <v-icon>group</v-icon>Estudiantes
          </v-btn>
        </template>
        <v-list>
          <v-list-tile v-for="(item,index) in students" :key="index" @click="goTO(item.href)">
            <v-list-tile-title v-text="item.text"></v-list-tile-title>
            <v-list-tile-avatar>
              <v-icon>{{item.icon}}</v-icon>
            </v-list-tile-avatar>
          </v-list-tile>
        </v-list>
      </v-menu>
      <v-menu offset-y>
        <template v-slot:activator="{ on }">
          <v-btn flat dark v-on="on">
            <v-icon>school</v-icon>Carreras
          </v-btn>
        </template>
        <v-list>
          <v-list-tile v-for="(item,index) in career" :key="index" @click="goTO(item.href)">
            <v-list-tile-title v-text="item.text"></v-list-tile-title>
            <v-list-tile-avatar>
              <v-icon>{{item.icon}}</v-icon>
            </v-list-tile-avatar>
          </v-list-tile>
        </v-list>
      </v-menu>
    </v-toolbar-items>
    <v-spacer></v-spacer>
    <v-toolbar-items class="hidden-sm-and-down">
      <v-menu offset-y>
        <template v-slot:activator="{ on }">
          <v-btn flat dark v-on="on">
            <v-icon>group</v-icon>Estudiantes
          </v-btn>
        </template>
        <v-list>
          <v-list-tile v-for="(item,index) in students" :key="index" @click="goTO(item.href)">
            <v-list-tile-title v-text="item.text"></v-list-tile-title>
            <v-list-tile-avatar>
              <v-icon>{{item.icon}}</v-icon>
            </v-list-tile-avatar>
          </v-list-tile>
        </v-list>
      </v-menu>
      <v-menu offset-y>
        <template v-slot:activator="{ on }">
          <v-btn flat dark v-on="on">
            <v-icon>school</v-icon>Carreras
          </v-btn>
        </template>
        <v-list>
          <v-list-tile v-for="(item,index) in career" :key="index" @click="goTO(item.href)">
            <v-list-tile-title v-text="item.text"></v-list-tile-title>
            <v-list-tile-avatar>
              <v-icon>{{item.icon}}</v-icon>
            </v-list-tile-avatar>
          </v-list-tile>
        </v-list>
      </v-menu>
    </v-toolbar-items>
  </v-toolbar>
</template>

<script>
export default {
  data() {
    return {
      students: [
        { text: "Registrar", icon: "person", href: "registerStudent" },
        { text: "Mostrar", icon: "event_note", href: "showStudent" }
      ],
      career: [
        { text: "Registrar", icon: "person", href: "registerCourse" },
        { text: "Mostrar", icon: "event_note", href: "showCourse" }
      ]
    };
  },
  methods: {
    goTO(index) {
      this.$router.push({ name: index }).catch(err => {});
    }
  }
};
</script>

<style>
</style>