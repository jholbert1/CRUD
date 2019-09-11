<template>
  <v-container>
    <v-layout row wrap justify-center>
      <v-flex xs12 sm12 md10>
        <v-card>
          <v-card-title primary-title>
            <div>
              <h3 class="headline mb-0">Registrar Carrera</h3>
            </div>
          </v-card-title>
          <v-card-text>
            <v-form>
              <v-text-field
                name="name"
                label="Nombre"
                v-validate="'required'"
                :error-messages="errors.collect('nombre')"
                data-vv-name="nombre"
                id="id"
                v-model="name"
              ></v-text-field>
              <v-textarea
                name="descripcion"
                v-validate="'required'"
                :error-messages="errors.collect('descripcion')"
                data-vv-name="descripcion"
                label="Descripcion"
                id="id"
                v-model="description"
              ></v-textarea>
              <v-select
                name="status"
                :items="status"
                item-text="text"
                item-value="value"
                v-validate="'required'"
                :error-messages="errors.collect('Estatus')"
                data-vv-name="Estatus"
                v-model="status_value"
                label="Estatus"
              ></v-select>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn flat color="primary" @click="registerCareer">Registrar</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import axios from "axios";
export default {
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
    registerCareer() {
      this.$validator.validateAll().then(result => {
        if (result) {
          const enviar = {
            name: this.name,
            description: this.description,
            status: this.status_value
          };
          console.log(enviar);
          axios.post(`api/career/register`, enviar).then(response => {
            console.log(response);
            this.name = "";
            this.description = "";
            this.status_value = "";
            this.$validator.reset();
            this.$toastr.success('Carrera Registrado Exitosamente', 'Registro');
          });
        }
      });
    }
  }
};
</script>

<style>
</style>