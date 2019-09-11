<template>
  <v-container fluid>
    <v-layout row wrap justify-center>
      <v-flex xs12 sm11 md11>
        <v-data-table :headers="headers" :items="data" class="elevation-1">
          <template v-slot:items="props">
            <td>{{ props.item.name }}</td>
            <td class="text-xs-right">{{ props.item.last_name }}</td>
            <td class="text-xs-right">{{ props.item.gender }}</td>
            <td class="text-xs-right">{{ props.item.birthday }}</td>
            <td class="text-xs-right">{{ props.item.email }}</td>
            <td class="text-xs-right">{{ props.item.county }}</td>
            <td class="text-xs-right">{{ props.item.state }}</td>
            <td class="text-xs-right">{{ props.item.city }}</td>
            <td class="text-xs-right">{{ props.item.career }}</td>
            <td class="text-xs-right">{{ props.item.status }}</td>
            <td class="justify-center layout px-0 pt-3">
              <v-icon small class="mr-2" @click="editStudent(props.item)">edit</v-icon>
              <v-icon small @click="deleteStudent(props.item)">delete</v-icon>
            </td>
          </template>
          <template v-slot:no-data>
            <v-alert :value="true" color="error" icon="warning">No hay Informacion para mostrar :(</v-alert>
          </template>
        </v-data-table>
        <EditStudent :active="active" :value="value" @dialog:change="eventUpdate" />
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import axios from "axios";
import EditStudent from "./EditStudent";
export default {
  components: {
    EditStudent
  },
  data() {
    return {
      active: false,
      value: null,
      headers: [
        {
          text: "Nombres",
          align: "left",
          sortable: false,
          value: "name"
        },
        { text: "Apellidos", value: "last_name" },
        { text: "Sexo", value: "gender" },
        { text: "Nacimiento", value: "birthday" },
        { text: "Email", value: "email" },
        { text: "Pais", value: "country" },
        { text: "Estado", value: "state" },
        { text: "City", value: "city" },
        { text: "Carrera", value: "career" },
        { text: "Estatus", value: "state" },
        { text: "Acción", value: "state" }
      ],
      data: []
    };
  },
  created() {
    this.getStudent();
  },
  methods: {
    getStudent() {
      axios.get("api/student/show").then(response => {
        console.log(response);
        this.data = response.data.data;
      });
    },
    deleteStudent(props) {
      const id = props.id;
      axios.delete(`api/student/delete/${id}`).then(response => {
        console.log(response);
        this.$toastr.success("Estudiante Eliminado Exitosamente", "Eliminado!");
        this.getStudent();
      });
    },
    editStudent(props) {
      const id = props.id;
      this.value = props;
      this.active = true;
    },
    eventUpdate(res) {
      this.active = false;
      if (res == "updated") {
        this.getStudent();
      }
    }
  }
};
</script>

<style>
</style>