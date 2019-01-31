<template>
  <div class="card" style="margin: 10px;">
    <div class="card-content">
      <div class="card-title mb-3">
        <h4 class>Direcciones y Areasasd</h4>
      </div>
      <div class="card-body p-0 row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <span v-if="address_nameSearch">{{filterAddresses.length}} Direcciones</span>
              <span v-else>{{addressesMeta.total}} Direcciones</span>
              <a
                id="address-toggle"
                @click="toggleForm"
                v-bind:class="{
                  'btn btn-sm text-white float-right':true,
                  'btn-primary': !newAddress,
                  'btn-secondary': newAddress
                }"
              >
                <i v-if="!newAddress" id="address-toggle" class="fas fa-plus"></i>
                <i v-else id="address-toggle" class="fas fa-minus"></i>
              </a>
            </div>
            <div class="card-body p-0">
              <transition name="fade" mode="out-in">
                <form v-if="newAddress" class="row" @submit.prevent="addressSubmit">
                  <div class="input-group col-12">
                    <input
                      type="text"
                      class="form-control rounded-0"
                      placeholder="Nombre de la dirección"
                      required
                      v-model="address_name"
                    >
                    <input
                      type="submit"
                      class="input-group-append btn btn-primary rounded-0"
                      value="Guardar"
                    >
                  </div>
                </form>

                <form v-if="!newAddress" class="row">
                  <div class="input-group col-12">
                    <input
                      type="text"
                      class="form-control rounded-0"
                      placeholder="Buscar dirección.."
                      v-model="address_nameSearch"
                    >
                  </div>
                </form>

                <!--<div class="p-2" v-if="newBrand" >
                  <div class="form-group">
                    <input type="text" v-model="brand" class="form-control">
                  </div>
                  <a @click.prevent="newBrand = false" href="#" class="btn btn-secondary">Cancelar</a>
                  <a @click.prevent="createBrand" href="#" class="btn btn-primary">Guardar</a>
                </div>-->
              </transition>
              <table class="table table-sm table-striped table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th class="text-center" style="vertical-align: middle">Nombre</th>
                    <th class="text-center">Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="text-center"
                    v-for="address in filterAddresses"
                    :key="address.identificador"
                  >
                    <td>{{ address.nombre }}</td>
                    <td>
                      <a @click.prevent="editAddress" href="#" style="color: black;" title="Editar Dirección">
                        <small><i :id="address.identificador" class="fas fa-pen"></i></small>
                      </a>
                      <a
                        @click.prevent="deleteAddress"
                        href="#"
                        class="ml-1 text-danger"
                        title="Eliminar Dirección"
                      >
                        <small><i :id="address.identificador" class="fas fa-trash"></i></small>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
              <nav v-if="!address_nameSearch" aria-label="Page navigation example" class="mx-2">
                <ul class="pagination pagination-sm">
                  <li
                    v-for="page in addressesMeta.total_pages"
                    :key="page"
                    v-bind:class="{'page-item pt-1':true, 'active':(page === addressesMeta.current_page)}"
                  >
                    <a @click.prevent="addressPaginate(page)" class="page-link" href="#">{{page}}</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <span v-if="area_nameSearch">{{filterAreas.length}} Areas</span>
              <span v-else>{{areasMeta.total}} Areas</span>
              <a
                id="area-toggle"
                @click="toggleForm"
                v-bind:class="{
                  'btn btn-sm text-white float-right':true,
                  'btn-primary': !newArea,
                  'btn-secondary': newArea
                }"
              >
                <i v-if="!newArea" id="area-toggle" class="fas fa-plus"></i>
                <i v-else id="area-toggle" class="fas fa-minus"></i>
              </a>
            </div>
            <div class="card-body p-0">
              <transition name="fade" mode="out-in">
                <form v-if="newArea" class="row" @submit.prevent="areaSubmit">
                  <div class="input-group col-12">
                    <input
                      type="text"
                      class="form-control rounded-0"
                      placeholder="Nombre del area"
                      required
                      v-model="area_name"
                    >
                    <input
                      type="submit"
                      class="input-group-append btn btn-primary rounded-0"
                      value="Guardar"
                    >
                  </div>
                </form>

                <form v-if="!newArea" class="row">
                  <div class="input-group col-12">
                    <input
                      type="text"
                      class="form-control rounded-0"
                      placeholder="Buscar area.."
                      v-model="area_nameSearch"
                    >
                  </div>
                </form>
              </transition>
              <table class="table table-sm table-striped table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th class="text-center" style="vertical-align: middle">Nombre</th>
                    <th class="text-center">Acción</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <tr v-for="area in filterAreas" :key="area.identificador">
                    <td>{{ area.nombre }}</td>
                    <td>
                      <a
                        href="#"
                        style="color: black;"
                        title="Editar Area"
                        @click.prevent="editArea"
                      >
                        <small><i :id="area.identificador" class="fas fa-pen"></i></small>
                      </a>
                      <a
                        @click.prevent="deleteArea"
                        href="#"
                        class="ml-1 text-danger"
                        title="Eliminar Area"
                      >
                        <small><i :id="area.identificador" class="fas fa-trash"></i></small>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
              <nav v-if="!area_nameSearch" aria-label="Page navigation example" class="mx-2">
                <ul class="pagination pagination-sm">
                  <li
                    v-for="page in areasMeta.total_pages"
                    :key="page"
                    v-bind:class="{'page-item pt-1':true, 'active':(page === areasMeta.current_page)}"
                  >
                    <a @click.prevent="areaPaginate(page)" class="page-link" href="#">{{page}}</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Addresses-View",
  data() {
    return {
      sArea: false,
      sAddress: false,
      newArea: false,
      newAddress: false,
      address: "",
      addresses: "",
      addressesMeta: "",
      area: "",
      areas: "",
      allAreas: "",
      allAddresses: "",
      selectedArea: null,
      selectedAddress: null,
      areasMeta: "",

      addressUpdate: false,
      areaUpdate: false,

      area_name: "",
      area_nameSearch: "",
      address_name: "",
      address_nameSearch: ""
    };
  },
  mounted() {
    this.initialLoad();
  },
  methods: {
    initialLoad() {
      this.getAddresses(0);
      this.getAreas(1);
    },
    toggleForm(event) {
      let target = event.target.id;
      switch (target) {
        case "area-toggle":
          this.newArea = !this.newArea;
          this.areaUpdate = false;
          this.area_name = "";
          break;
        case "address-toggle":
          this.newAddress = !this.newAddress;
          this.addressUpdate = false;
          this.address_name = "";
          break;
      }
    },

    editAddress(event) {
      let id = event.target.id;
      this.selectedAddress = id;
      this.address_name = this.addresses.filter(address => address.identificador == this.selectedAddress)[0].nombre
      this.addressUpdate = true;
      this.newAddress = true;
    },

    editArea(event) {
      let id = event.target.id;
      this.selectedArea = id;
      this.area_name = this.areas.filter(area => area.identificador == this.selectedArea)[0].nombre
      this.areaUpdate = true;
      this.newArea = true;
    },

    // METODOS DE MARCAS

    getAddresses(emit) {
      this.$emit("loading-data", true);
      this.addressPaginate();
      axios
        .get("/api/addresses")
        .then(response => {
          this.allAddresses = response.data.data;
          if (emit) this.$emit("loading-data", false);
        })
        .catch(error => {
          console.log(error);
          this.$emit("error", error);
          this.$emit("loading-data", false);
        });
    },
    addressPaginate(page) {
      axios
        .get("/api/addresses?paginate=true&page=" + page)
        .then(response => {
          this.addresses = response.data.data;
          document.querySelectorAll('input[name="address"]').forEach(r => {
            r.checked = false;
          });
          this.addressesMeta = response.data.meta.pagination;
          this.$emit("loading-data", false);
        })
        .catch(error => {
          console.log(error);
          this.$emit("error", error);
          this.$emit("loading-data", false);
        });
    },
    createAddress() {
      axios
        .post("api/addresses", { nombre: this.address_name })
        .then(response => {
          this.getAddresses(1);
          Swal({
            type: "success",
            title: "Excelente",
            text: "Datos guardados con exito",
            confirmButtonText: "Continuar"
          });
        })
        .catch(error => {
          console.log(error);
          this.$emit("error", error);
        });
    },

    updateAddress() {
      axios
        .put("/api/addresses/" + this.selectedAddress, {
          nombre: this.address_name
        })
        .then(response => {
          this.getAddresses(1);
          Swal({
            type: "success",
            title: "Excelente",
            text: "Datos actualizados con exito",
            confirmButtonText: "Continuar"
          });
        })
        .catch(error => {
          console.log(error);
          this.$emit("error", error);
        });
    },

    deleteAddress(event) {
      this.selectedAddress = event.target.id;
      console.log("address", this.selectedAddress);
      this.$emit("prompt", {
        title: "¿Está seguro?",
        message: "El resgistro sera Eliminado!",
        confirmHandler: this.deleteAddressHandler
      });
    },

    deleteAddressHandler() {
      axios
        .delete("api/addresses/" + this.selectedAddress)
        .then(response => {
          this.getAddresses(1);
          Swal({
            type: "success",
            title: "Excelente",
            text: "Datos borrados con exito",
            confirmButtonText: "Continuar"
          });
        })
        .catch(error => {
          console.log(error);
          this.$emit("error", error);
        });
    },

    addressSubmit() {
      if (this.address_name == "") return;

      if (this.addressUpdate) {
        this.updateAddress();
      } else {
        this.createAddress();
      }

      this.toggleForm({ target: { id: "address-toggle" } });
    },

    // METODOS DE DISPOSITIVOS
    getAreas(emit) {
      this.$emit("loading-data", true);
      this.areaPaginate();
      axios
        .get("/api/areas")
        .then(response => {
          this.allAreas = response.data.data;
          if (emit) this.$emit("loading-data", false);
        })
        .catch(error => {
          console.log(error);
          this.$emit("loading-data", false);
          this.$emit("error", error);
        });
    },

    areaPaginate(page) {
      axios
        .get("/api/areas?paginate=true&page=" + page)
        .then(response => {
          this.areas = response.data.data;
          document.querySelectorAll('input[name="area"]').forEach(r => {
            r.checked = false;
          });
          this.areasMeta = response.data.meta.pagination;
        })
        .catch(error => {
          console.log(error);
          this.$emit("error", error);
        });
    },

    createArea() {
      axios
        .post("api/areas", { nombre: this.area_name })
        .then(response => {
          this.getAreas(1);
          Swal({
            type: "success",
            title: "Excelente",
            text: "Datos guardados con exito",
            confirmButtonText: "Continuar"
          });
        })
        .catch(error => {
          console.log(error);
          this.$emit("error", error);
        });
    },

    areaSubmit() {
      if (this.area_name == "") return;

      if (this.areaUpdate) {
        this.updateArea();
        this.toggleForm({ target: { id: "area-toggle" } });
      } else {
        this.createArea();
        this.area_name = "";
      }
    },

    updateArea() {
      axios
        .put("/api/areas/" + this.selectedArea, { nombre: this.area_name })
        .then(response => {
          this.getAreas(1);
          Swal({
            type: "success",
            title: "Excelente",
            text: "Datos actualizados con exito",
            confirmButtonText: "Continuar"
          });
        })
        .catch(error => {
          console.log(error);
          this.$emit("error", error);
        });
    },

    deleteArea(event) {
      this.selectedArea = event.target.id
      this.$emit("prompt", {
        title: "¿Seguro?",
        message: "¡El registro sera elminado!",
        confirmHandler: this.deleteAreaHandler
      });
    },

    deleteAreaHandler() {
      console.log(this.selectedArea)
      axios
        .delete("api/areas/" + this.selectedArea)
        .then(response => {
          this.getAreas(1);
          Swal({
            type: "success",
            title: "Excelente",
            text: "Datos borrados con exito",
            confirmButtonText: "Continuar"
          });
        })
        .catch(error => {
          console.log(error);
          this.$emit("error", error);
        });
    }
  },
  computed: {
    filterAreas: function() {
      if (this.area_nameSearch != "") {
        return this.allAreas.filter(item =>
          item.nombre.toUpperCase().includes(this.area_nameSearch.toUpperCase())
        );
      } else {
        return this.areas;
      }
    },
    filterAddresses: function() {
      if (this.address_nameSearch != "") {
        return this.allAddresses.filter(item =>
          item.nombre
            .toUpperCase()
            .includes(this.address_nameSearch.toUpperCase())
        );
      } else {
        return this.addresses;
      }
    }
  }
};
</script>