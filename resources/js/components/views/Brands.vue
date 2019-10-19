<template>
  <div class="card" style="margin-right: 10px;">
    <div class="card-content">
      <div class="card-title mb-3">
        <h4 class>Dispositivos y Marcas</h4>
      </div>
      <div class="card-body p-0 row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <span v-if="device_nameSearch">{{filterDevices.length}} Dispositivos</span>
              <span v-else>{{devicesMeta.total}} Dispositivos</span>
              <a id="device-toggle" @click="toggleForm" v-bind:class="{
                  'btn btn-sm text-white float-right':true,
                  'btn-primary': !newDevice,
                  'btn-danger': newDevice
                }">
                <i title="Nuevo" v-if="!newDevice" id="device-toggle" class="fas fa-plus"></i>
                <i title="Cancelar" v-else id="device-toggle" class="fas fa-times"></i>
              </a>
            </div>
            <div class="card-body p-0">
              <transition name="fade" mode="out-in">
                <form v-if="newDevice" class="row" @submit.prevent="deviceSubmit">
                  <div class="input-group col-12">
                    <input type="text" class="form-control rounded-0" placeholder="Nombre del dispositivo" required
                      v-model="device_name">
                    <input type="submit" class="input-group-append btn btn-primary rounded-0" value="Guardar">
                  </div>
                </form>

                <form v-if="!newDevice" class="row">
                  <div class="input-group col-12">
                    <input type="text" class="form-control rounded-0" placeholder="Buscar dispositivo"
                      v-model="device_nameSearch">
                  </div>
                </form>
              </transition>
              <table class="table table-sm table-bordered table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th class="text-center" style="vertical-align: middle">Nombre</th>
                    <th class="text-center"></th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <tr v-for="device in filterDevices" :key="'dev'+device.identificador">
                    <td>{{ device.nombre }}</td>
                    <td>
                      <button @click="editDevice(device.identificador)" class="btn btn-sm text-dark" title="Modificar dispositivo">
                        <i class="fas fa-pen"></i>
                      </button>
                      <button @click="deleteSubDevice" class="btn btn-sm text-danger" title="Eliminar dispositivo">
                        <i :id="'device-'+device.identificador" class="fas fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <nav v-if="!device_nameSearch" aria-label="Page navigation example" class="mx-2">
                <ul class="pagination pagination-sm">
                  <li v-for="page in devicesMeta.total_pages"
                    v-bind:class="{'page-item pt-1':true, 'active':(page === devicesMeta.current_page)}"
                    :key="'dpage-'+page">
                    <a @click.prevent="subDevicePaginate(page)" class="page-link" href="#">{{page}}</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <span v-if="brand_nameSearch">{{filterBrands.length}} Marcas</span>
              <span v-else>{{brandsMeta.total}} Marcas</span>
              <a id="brand-toggle" @click="toggleForm" v-bind:class="{
                  'btn btn-sm text-white float-right':true,
                  'btn-primary': !newBrand,
                  'btn-danger': newBrand
                }">
                <i title="Nuevo" v-if="!newBrand" id="brand-toggle" class="fas fa-plus"></i>
                <i title="Cancelar" v-else id="brand-toggle" class="fas fa-times"></i>
              </a>
            </div>
            <div class="card-body p-0">
              <transition name="fade" mode="out-in">
                <form v-if="newBrand" class="row" @submit.prevent="brandSubmit">
                  <div class="input-group col-12">
                    <input type="text" class="form-control rounded-0" placeholder="Nombre de la Marca" required
                      v-model="brand_name">
                    <input type="submit" class="input-group-append btn btn-primary rounded-0" value="Guardar">
                  </div>
                </form>

                <form v-if="!newBrand" class="row">
                  <div class="input-group col-12">
                    <input type="text" class="form-control rounded-0" placeholder="Buscar marca"
                      v-model="brand_nameSearch">
                  </div>
                </form>
              </transition>
              <table class="table table-sm table-bordered table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th class="text-center" style="vertical-align: middle">Nombre</th>
                    <th class="text-center"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="text-center" v-for="brand in filterBrands" :key="'bra-'+brand.identificador">
                    <td>{{ brand.nombre }}</td>
                    <td>
                      <button @click="editBrand(brand.identificador)" class="btn btn-sm text-dark" title="Modificar marca">
                          <i class="fas fa-pen"></i>
                      </button>
                      <button @click="deleteBrand(brand.identificador)" class="btn btn-sm text-danger" title="Eliminar marca">
                          <i class="fas fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <nav v-if="!brand_nameSearch" aria-label="Page navigation example" class="mx-2">
                <ul class="pagination pagination-sm">
                  <li v-for="page in brandsMeta.total_pages"
                    v-bind:class="{'page-item pt-1':true, 'active':(page === brandsMeta.current_page)}"
                    :key="'bpage-'+page">
                    <a @click.prevent="brandPaginate(page)" class="page-link" href="#">{{page}}</a>
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
  name: "Brands-View",
  data() {
    return {
      sDevice: false,
      sBrand: false,
      newBrand: false,
      newDevice: false,
      brand: "",
      brands: "",
      brandsMeta: "",
      device: "",
      devices: "",
      allDevices: "",
      allBrands: "",
      selectedDevice: null,
      selectedBrand: null,
      devicesMeta: "",

      brandUpdate: false,
      deviceUpdate: false,

      device_name: "",
      device_nameSearch: "",
      brand_name: "",
      brand_nameSearch: ""
    };
  },
  mounted() {
    this.subDevicePaginate();
    this.brandPaginate();
    this.getSubDevice();
    this.getBrands();
  },
  methods: {
    toggleForm(event) {
      let target = event.target.id;
      switch (target) {
        case "device-toggle":
          this.newDevice = !this.newDevice;
          this.deviceUpdate = false;
          this.device_name = "";
          break;
        case "brand-toggle":
          this.newBrand = !this.newBrand;
          this.brandUpdate = false;
          this.brand_name = "";
          break;
      }
    },

    selectDevice(id) {
      this.selectedDevice = id;
      this.device_name = this.devices.filter(
        device => device.identificador == this.selectedDevice
      )[0].nombre;
    },
    selectBrand(id) {
      this.selectedBrand = id;
      this.brand_name = this.brands.filter(
        brand => brand.identificador == this.selectedBrand
      )[0].nombre;
    },

    editBrand(item) {
      this.brandUpdate = true;
      this.newBrand = true;
      this.selectBrand(item);
      console.log('brand')
    },

    editDevice(item) {
      this.deviceUpdate = true;
      this.newDevice = true;
      this.selectDevice(item);
    },

    // METODOS DE MARCAS

    getBrands() {
      this.brandPaginate();
      axios
        .get("/api/brands")
        .then(response => {
          this.allBrands = response.data.data;
        })
        .catch(error => {
          this.$emit("error", error);
        });
    },
    brandPaginate(page) {
      axios
        .get("/api/brands?paginate=true&page=" + page)
        .then(response => {
          this.brands = response.data.data;
          document.querySelectorAll('input[name="brand"]').forEach(r => {
            r.checked = false;
          });
          if (response.data.meta) this.brandsMeta = response.data.meta.pagination;
        })
        .catch(error => {
          console.log(error);
          this.$emit("error", error);
        });
    },
    createBrand() {
      axios
        .post("api/brands", {
          nombre: this.brand_name
        })
        .then(response => {
          this.getBrands();
          Swal({
            type: "success",
            title: "Excelente",
            text: "Datos guardados con exito",
            confirmButtonText: "Continuar"
          });
        })
        .catch(error => {
          this.$emit("error", error);
        });
    },

    updateBrand() {
      axios
        .put("/api/brands/" + this.selectedBrand, {
          nombre: this.brand_name
        })
        .then(response => {
          this.getBrands();
          Swal({
            type: "success",
            title: "Excelente",
            text: "Datos actualizados con exito",
            confirmButtonText: "Continuar"
          });
        })
        .catch(error => {
          this.$emit("error", error);
        });
    },

    deleteBrand(item) {
      this.selectedBrand = item
      this.$emit("prompt", {
        title: "¿Está seguro?",
        message: "El resgistro sera Eliminado!",
        confirmHandler: this.deleteBrandHandler
      });
    },

    deleteBrandHandler() {
      axios
        .delete("api/brands/" + this.selectedBrand)
        .then(response => {
          this.selectedBrand = "";
          this.getBrands();
          Swal({
            type: "success",
            title: "Excelente",
            text: "Datos borrados con exito",
            confirmButtonText: "Continuar"
          });
        })
        .catch(error => {
          this.$emit("error", error);
        });
    },

    brandSubmit() {
      if (this.brand_name == "") return;

      if (this.brandUpdate) {
        this.updateBrand();
      } else {
        this.createBrand();
      }

      this.toggleForm({
        target: {
          id: "brand-toggle"
        }
      });
    },

    // METODOS DE DISPOSITIVOS
    getSubDevice() {
      this.subDevicePaginate();
      axios
        .get("/api/sub-devices")
        .then(response => {
          this.allDevices = response.data.data;
        })
        .catch(error => {
          console.log(error);
          this.$emit("error", error);
        });
    },

    subDevicePaginate(page) {
      axios
        .get("/api/sub-devices?paginate=true&page=" + page)
        .then(response => {
          this.devices = response.data.data;
          document.querySelectorAll('input[name="device"]').forEach(r => {
            r.checked = false;
          });
          if (response.data.meta) this.devicesMeta = response.data.meta.pagination;
        })
        .catch(error => {
          console.log(error);
          this.$emit("error", error);
        });
    },

    createDevice() {
      axios
        .post("api/sub-devices", {
          nombre: this.device_name
        })
        .then(response => {
          this.getSubDevice();
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

    deviceSubmit() {
      if (this.device_name == "") return;

      if (this.deviceUpdate) {
        this.updateDevice();
        this.toggleForm({
          target: {
            id: "device-toggle"
          }
        });
      } else {
        this.createDevice();
        this.device_name = "";
      }
    },

    updateDevice() {
      axios
        .put("/api/sub-devices/" + this.selectedDevice, {
          nombre: this.device_name
        })
        .then(response => {
          this.getSubDevice();
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

    deleteSubDevice(event) {
      this.selectedDevice = event.target.id.replace("device-", "");
      this.$emit("prompt", {
        title: "¿Seguro?",
        message: "¡El registro sera elminado!",
        confirmHandler: this.deleteSubDeviceHandler
      });
    },

    deleteSubDeviceHandler() {
      axios
        .delete("api/sub-devices/" + this.selectedDevice)
        .then(response => {
          this.selectedDevice = "";
          this.getSubDevice();
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
    filterDevices: function () {
      if (this.device_nameSearch != "") {
        return this.allDevices.filter(item =>
          item.nombre
          .toUpperCase()
          .includes(this.device_nameSearch.toUpperCase())
        );
      } else {
        return this.devices;
      }
    },
    filterBrands: function () {
      if (this.brand_nameSearch != "") {
        return this.allBrands.filter(item =>
          item.nombre
          .toUpperCase()
          .includes(this.brand_nameSearch.toUpperCase())
        );
      } else {
        return this.brands;
      }
    }
  }
};
</script>