  <template>
	<div class="card" style="margin: 10px;">
    <div class="card-content">
      
    <div class="card-title">    
      <h4 class>Lista de las direcciones</h4>
    </div>
    <a 
      v-on:click="newAddress = !newAddress"
      v-if="!newAddress"
      class="waves-effect blue waves-light btn-small">
      <i class="fas fa-plus"></i>
    </a>
    <small style="margin-left: 10px;">Se muestra una lista de las direcciones disponibles</small>
    
    <new-address v-if="newAddress" :newAddress="toggleForm"></new-address>
    
    <address-list v-else></address-list>

    </div>
	</div>
</template>

<script>
  import AddressList from '../partials/AddressList'
  import NewAddress from '../partials/NewAddress'
	export default {
		name: 'Address-View',
    data() {
      return {
        addresses: '',
        newAddress: false
      }
    },
    methods: {
      toggleForm() {
        this.newAddress = !this.newAddress
      },
    },
    components: {
      AddressList,
      NewAddress
    }
	}
</script>