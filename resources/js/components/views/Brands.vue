<template>
	<div class="card" style="margin: 10px;">
    <div class="card-content">      
		  <div class="card-title mb-3">    
		    <h4 class>Lista de los dispositivos y las marcas</h4>
		  </div>
      <div class="card-body p-0 row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">{{devicesMeta.total}} Dispositivos registrados</div>
            <div class="card-body p-0">
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th>Nombre</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="device in devices">
                    <td>{{ device.nombre }}</td>
                    <td>-</td>
                  </tr>
                </tbody>
              </table> 
              <nav aria-label="Page navigation example" class="mx-2">
                <ul class="pagination pagination-sm">
                  <li 
                    v-for="page in devicesMeta.total_pages"
                    v-bind:class="{'page-item pt-1':true, 'active':(page === devicesMeta.current_page)}">
                    <a @click.prevent="subDevicePaginate(page)" class="page-link" href="#">
                      {{page}}
                    </a>
                  </li>
                </ul>
              </nav> 
            </div>
          </div>
        </div> 
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">{{brandsMeta.total}} Marcas registradas</div>
            <div class="card-body p-0">
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th>Nombre</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="brand in brands">
                    <td>{{ brand.nombre }}</td>
                    <td>-</td>
                  </tr>
                </tbody>
              </table>  
              <nav aria-label="Page navigation example" class="mx-2">
                <ul class="pagination pagination-sm">
                  <!-- <li 
                    v-if="brandsMeta.links.previous" 
                    @click.prevent="brandPaginate(brandsMeta.links.previous)"
                    class="page-item">
                    <a class="page-link" href="#">Anterior</a>
                  </li> -->
                  <!-- <li class="page-item">
                    <a @click.prevent="" class="page-link" href="#">
                      {{brandsMeta.current_page}}
                    </a>
                  </li> -->
                  <!-- <li 
                    v-if="brandsMeta.links.next" 
                    @click.prevent="brandPaginate(brandsMeta.links.next)"
                    class="page-item">
                    <a class="page-link" href="#">Siguiente</a>
                  </li> -->

                  <li 
                    v-for="page in brandsMeta.total_pages"
                    v-bind:class="{'page-item pt-1':true, 'active':(page === brandsMeta.current_page)}">
                    <a @click.prevent="brandPaginate(page)" class="page-link" href="#">
                      {{page}}
                    </a>
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
		name: 'Brands-View',
    data() {
      return {
        brands: '',
        brandsMeta: '',
        devices: '',
        devicesMeta: '',
      }
    },
    mounted() {
      this.getBrands()
      this.getSubDevice()
    },
    methods: {
      getBrands(){
        axios
          .get("/api/brands?paginate=true")
          .then(response => {
            this.brands = response.data.data
            this.brandsMeta = response.data.meta.pagination
          })
          .catch(error => {console.log(error)})
      },
      brandPaginate(page){
        axios
          .get("/api/brands?paginate=true&page="+page)
          .then(response => {
            this.brands = response.data.data
            this.brandsMeta = response.data.meta.pagination
          })
          .catch(error => {console.log(error)})
      },
      getSubDevice(){
        axios
          .get("/api/sub-devices?paginate=true")
          .then(response => {
            this.devices = response.data.data
            this.devicesMeta = response.data.meta.pagination
          })
          .catch(error => {console.log(error)})
      },
      subDevicePaginate(page){
        axios
          .get("/api/sub-devices?paginate=true&page="+page)
          .then(response => {
            this.devices = response.data.data
            this.devicesMeta = response.data.meta.pagination
          })
          .catch(error => {console.log(error)})
      },
    }
	}
</script>