<template>
	<div class="card" style="margin: 10px;">
    <div class="card-content">      
		  <div class="card-title mb-3">    
		    <h4 class>Lista de los dispositivos y las marcas</h4>
		  </div>
      <div class="card-body p-0 row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">Dispositivos</div>
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
            </div>
          </div>
        </div> 
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">Marcas</div>
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
              <nav aria-label="Page navigation example" class="float-right">
                <ul class="pagination">
                  <li 
                    v-if="brandsMeta.pagination.links.previous" 
                    @click.prevent="brandPaginate(brandsMeta.pagination.links.previous)"
                    class="page-item">
                    <a class="page-link" href="#">Anterior</a>
                  </li>
                  <li class="page-item">
                    <a @click.prevent="" class="page-link" href="#">
                      {{brandsMeta.pagination.current_page}}
                    </a>
                  </li>
                  <li 
                    v-if="brandsMeta.pagination.links.next" 
                    @click.prevent="brandPaginate(brandsMeta.pagination.links.next)"
                    class="page-item">
                    <a class="page-link" href="#">Siguiente</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>       
      </div>
    </div>
    <pre>{{ $data }}</pre>
	</div>
</template>

<script>
	export default {
		name: 'Brands-View',
    data() {
      return {
        brands: '',
        brandsMeta: '',
        devices: ''
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
            this.brandsMeta = response.data.meta
          })
          .catch(error => {console.log(error)})
      },
      brandPaginate(page){
        axios
          .get("/api/brands?paginate=true&page="+page)
          .then(response => {
            this.brands = response.data.data
            this.brandsMeta = response.data.meta
          })
          .catch(error => {console.log(error)})
      },
      getSubDevice(){
        axios
          .get("/api/sub-devices")
          .then(response => {this.devices = response.data.data})
          .catch(error => {console.log(error)})
      },
    }
	}
</script>