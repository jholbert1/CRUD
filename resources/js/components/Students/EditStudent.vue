<template>
  <v-dialog v-model="active" max-width="400" persistent>
    <v-card v-if="value">
      <v-card-title class="headline">Actualizar Datos del Estudiante</v-card-title>

      <v-card-text>
        <v-form>
          <v-text-field :placeholder="value.name" name="name" v-model="name" label="Nombres"></v-text-field>
          <v-text-field
            :placeholder="value.last_name"
            name="apellido"
            v-model="last_name"
            label="Apellidos"
          ></v-text-field>
          <v-select :placeholder="value.gender" :items="gender" v-model="gender_value" label="Sexo"></v-select>
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
              :placeholder="value.birthday"
              slot="activator"
              v-model="date"
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
            :placeholder="value.email"
            name="email"
            v-validate="'email'"
            :error-messages="errors.collect('Email')"
            data-vv-name="Email"
            v-model="email"
            label="Email"
          ></v-text-field>
          <v-select
            :placeholder="value.county"
            name="pais"
            :items="countries"
            item-text="name"
            item-value="name"
            return-object
            label="Pais"
            v-model="country"
          ></v-select>
          <v-select
            :placeholder="value.state"
            name="estado"
            no-data-text="Selecciona Pais"
            :items="states"
            item-text="name"
            item-value="name"
            v-model="state"
            label="Estado"
          ></v-select>
          <v-select
            :placeholder="value.city"
            name="ciudad"
            no-data-text="Selecciona Pais"
            :items="cities"
            item-text="name"
            item-value="name"
            v-model="city"
            label="Ciudad"
          ></v-select>
          <v-text-field :placeholder="value.career"   name="carrera" v-model="career" label="Carrera"></v-text-field>
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

        <v-btn color="green darken-1" flat="flat" @click="updateStudent">Actualizr</v-btn>
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
    close() {
      this.$emit("dialog:change", "cerrar");
    },
    updateStudent() {
      const id = this.value.id;
      const enviar = {
        name: this.name === "" ? this.value.name : this.name,
        last_name:
          this.last_name === "" ? this.value.last_name : this.last_name,
        gender:
          this.gender_value === "" ? this.value.gender : this.gender_value,
        birthday: this.date === "" ? this.value.birthday : this.date,
        email: this.email === "" ? this.value.email : this.email,
        county:
          this.country_value === "" ? this.value.county : this.country_value,
        city: this.city === "" ? this.value.city : this.city,
        state: this.state === "" ? this.value.state : this.state,
        career: this.career === "" ? this.value.career : this.career,
        status: this.status_value === "" ? this.value.status : this.status_value
      };
      console.log(enviar);
      axios.put(`api/student/update/${id}`, enviar).then(response => {
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
        this.$emit("dialog:change", "updated");
        this.$toastr.success("Estudiante Editado Exitosamente", "Editado!");
      });
    }
  }
};
</script>

<style>
</style>