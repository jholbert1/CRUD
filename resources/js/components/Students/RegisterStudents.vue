<template>
  <v-container grid-list-xs>
    <v-layout row wrap justify-center mt-4>
      <v-flex xs12 sm6 md10>
        <v-card>
          <v-card-title primary-title>
            <div>
              <h3 class="headline mb-0">Complete el Formulario para continuar el Registro</h3>
              <div>Estudiantes</div>
            </div>
          </v-card-title>
          <v-card-text>
            <v-form>
              <v-text-field
                name="name"
                v-validate="'required'"
                :error-messages="errors.collect('nombre')"
                data-vv-name="nombre"
                v-model="name"
                label="Nombres"
              ></v-text-field>
              <v-text-field
                name="apellido"
                v-validate="'required'"
                :error-messages="errors.collect('apellido')"
                data-vv-name="apellido"
                v-model="last_name"
                label="Apellidos"
              ></v-text-field>
              <v-select
                :items="gender"
                v-validate="'required'"
                :error-messages="errors.collect('genero')"
                data-vv-name="genero"
                v-model="gender_value"
                label="Sexo"
              ></v-select>
              <v-menu
                ref="menu"
                :close-on-content-click="false"
                v-model="menu"
                :nudge-right="40"
                :return-value.sync="date"
                transition="scale-transition"
                offset-y
                full-width
                max-width="290px"
                persistent
                min-width="290px"
              >
                <v-text-field
                  slot="activator"
                  v-model="date"
                  v-validate="'required'"
                  :error-messages="errors.collect('fecha')"
                  data-vv-name="fecha"
                  label="Fecha Nacimiento"
                  prepend-inner-icon="event"
                  readonly
                ></v-text-field>
                <v-date-picker v-model="date" locale="es" persistent no-title scrollable>
                  <v-spacer></v-spacer>
                  <v-btn flat color="primary" @click="menu = false">Cancel</v-btn>
                  <v-btn flat color="primary" @click="$refs.menu.save(date)">OK</v-btn>
                </v-date-picker>
              </v-menu>
              <v-text-field
                name="email"
                v-validate="'required|email'"
                :error-messages="errors.collect('Email')"
                data-vv-name="Email"
                v-model="email"
                label="Email"
              ></v-text-field>
              <v-select
                name="pais"
                :items="countries"
                item-text="name"
                item-value="name"
                v-validate="'required'"
                :error-messages="errors.collect('Pais')"
                data-vv-name="Pais"
                return-object
                label="Pais"
                v-model="country"
              ></v-select>
              <v-select
                name="estado"
                :items="states"
                no-data-text="Selecciona Pais"
                item-text="name"
                item-value="name"
                v-validate="'required'"
                :error-messages="errors.collect('Estado')"
                data-vv-name="Estado"
                v-model="state"
                label="Estado"
              ></v-select>
              <v-select
                no-data-text="Selecciona Pais"
                name="ciudad"
                :items="cities"
                item-text="name"
                item-value="name"
                v-validate="'required'"
                :error-messages="errors.collect('Ciudad')"
                data-vv-name="Ciudad"
                v-model="city"
                label="Ciudad"
              ></v-select>
              <v-select
                name="carrera"
                v-validate="'required'"
                :error-messages="errors.collect('Carrera')"
                data-vv-name="Carrera"
                :items="careers"
                item-text="name"
                item-value="name"
                no-data-text="Carga Una Carrera"
                v-model="career"
                label="Carrera"
              ></v-select>
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
            <v-btn flat color="primary" @click="registerStudent">
              <v-icon small>send</v-icon>Registrar
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import axios from "axios";
export default {
  name: "RegisterStudnets",
  data() {
    return {
      gender: ["Masculino", "Femenino"],
      gender_value: "",
      countries: [],
      country: "",
      country_value: "",
      states: [],
      state: "",
      cities: [],
      city: "",
      name: "",
      last_name: "",
      birthday: "",
      email: "",
      careers: [],
      career: "",
      status: [
        { text: "Activo", value: true },
        { text: "Inactivo", value: false }
      ],
      status_value: "",
      date: "",
      menu: ""
    };
  },
  created() {
    this.getCountries();
    this.getCareers();
  },
  watch: {
    country() {
      console.log(this.country);
      axios.get(`api/career/show/${this.country.id}`).then(response => {
        console.log(response.data.country.name);
        const states = [];
        for (let value of response.data.country) {
          this.country_value = value.name;
          console.log(value);
          for (let state of value.state) {
            console.log(state.city);
            this.states = [state];
            for (let cities of state.city) {
              this.cities = [cities];
            }
          }
        }
      });
    }
  },
  methods: {
    getCountries() {
      axios.get("api/career/index").then(response => {
        console.log(response.data.country);
        this.countries = response.data.country;
      });
    },
    getCareers() {
      axios.get("api/career/show").then(response => {
        console.log(response.data.data);
        this.careers = response.data.data;
      });
    },
    registerStudent() {
      this.$validator.validateAll().then(result => {
        if (result) {
          const enviar = {
            name: this.name,
            last_name: this.last_name,
            gender: this.gender_value,
            birthday: this.date,
            email: this.email,
            county: this.country_value,
            city: this.city,
            state: this.state,
            career: this.career,
            status: this.status_value
          };
          console.log(enviar);
          axios.post("api/student/register", enviar).then(response => {
            console.log(response);
            this.name = "";
            this.last_name = "";
            this.gender_value = "";
            this.date = "";
            this.email = "";
            this.country_value = "";
            this.city = "";
            this.state = "";
            this.career = "";
            this.status_valu = "";
            this.$validator.reset();
            this.$toastr.success('Estudiante Registrado Exitosamente', 'Registro');
          });
          return;
        }
      });
    }
  }
};
</script>

<style>
</style>