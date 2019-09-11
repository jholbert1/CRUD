<template>
  <v-container fluid>
    <v-layout row wrap justify-center>
      <v-flex xs12 sm11 md11>
        <v-data-table :headers="headers" :items="data" class="elevation-1">
          <template v-slot:items="props">
            <td>{{ props.item.name }}</td>
            <td class="text-xs-center">{{ props.item.description }}</td>
            <td class="text-xs-center">{{ props.item.status }}</td>
            <td class="justify-center layout px-0 pt-3">
              <v-icon small class="mr-2" @click="editCourse(props.item)">edit</v-icon>
              <v-icon small @click="deleteCourse(props.item)">delete</v-icon>
            </td>
          </template>
          <template v-slot:no-data>
            <v-alert :value="true" color="error" icon="warning">No hay Informacion para mostrar :(</v-alert>
          </template>
        </v-data-table>
        <EditCourse :active="active" :value="value" @dialog:change="eventUpdate" />
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import axios from "axios";
import EditCourse from "./EditCourse";
export default {
  components: {
    EditCourse
  },
  data() {
    return {
      active: false,
      value: null,
      headers: [
        {
          text: "Nombre",
          align: "left",
          sortable: false,
          value: "name"
        },
        { text: "Descripcion", value: "description", align: "center" },
        { text: "Estatus", value: "status", align: "center" },
        { text: "Accion", value: "status", align: "center" }
      ],
      data: []
    };
  },
  created() {
    this.getCourse();
  },
  methods: {
    getCourse() {
      axios.get("api/career/show").then(response => {
        console.log(response);
        this.data = response.data.data;
      });
    },
    deleteCourse(props) {
      const id = props.id;
      axios.delete(`api/career/delete/${id}`).then(response => {
        console.log(response);
        this.getCourse();
        this.$toastr.success("Carrera Eliminada Exitosamente", "Eliminado!");
      });
    },
    editCourse(props) {
      const id = props.id;
      this.value = props;
      this.active = true;
    },
    eventUpdate(res) {
      this.active = false;
      if(res == 'updated') {
        this.getCourse();
      }
    }
  }
};
</script>

<style>
</style>