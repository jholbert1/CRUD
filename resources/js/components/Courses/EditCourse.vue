<template>
  <v-dialog v-model="active" max-width="400" persistent>
    <v-card v-if="value">
      <v-card-title class="headline">Actualizar Datos de la carrera</v-card-title>

      <v-card-text>
        <v-form>
          <v-text-field name="name" :placeholder="value.name" label="Nombre" id="id" v-model="name"></v-text-field>
          <v-textarea
            name="descripcion"
            :placeholder="value.description"
            label="Descripcion"
            id="id"
            v-model="description"
          ></v-textarea>
          <v-select
            :placeholder="(value.status === 1) ? 'Activo' : 'Inactivo'"
            name="status"
            :items="status"
            item-text="text"
            item-value="value"
            v-model="status_value"
            label="Estatus"
          ></v-select>
        </v-form>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>

        <v-btn color="yellow darken-1" flat="flat" @click="close">Cancelar</v-btn>

        <v-btn color="green darken-1" flat="flat" @click="updateCourse">Actualizr</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: {
    active: {
      required: true,
      type: Boolean,
      default: false
    },
    value: {
      required: false,
      type: Object,
      default: {}
    }
  },
  data() {
    return {
      name: "",
      description: "",
      status: [
        { text: "Activo", value: true },
        { text: "Inactivo", value: false }
      ],
      status_value: ""
    };
  },
  methods: {
    close() {
      this.$emit("dialog:change", "cerrar");
    },
    updateCourse() {
      const id = this.value.id;
      const enviar = {
        name: this.name === "" ? this.value.name : this.name,
        description:
          this.description === "" ? this.value.description : this.description,
        status: this.status_value === "" ? this.value.status : this.status_value
      };
      console.log(enviar);
      axios.put(`api/career/update/${id}`, enviar).then(response => {
        console.log(response);
        this.$emit("dialog:change", "updated");
        this.$toastr.success("Carrera Editada Exitosamente", "Editado");
      });
    }
  }
};
</script>

<style>
</style>