<template>
  <div class="card col-11" style="margin: 10px;">
    <div class="card-content row">
      <div class="card-title col-12 p-0">
        <h4>
          Lista de las ordenes registradas
          <a
            v-if="editOrder"
            @click.prevent="editOrder = !editOrder"
            href="#"
            class="btn btn-info float-right"
          >Finalizar edición</a>
        </h4>
      </div>

      <edit-order v-if="editOrder" :id="idOrder"></edit-order>

      <div v-if="!editOrder" class="col-12 row">
        <div class="form-group col-6">
          <input type="text" class="form-control" v-model="searchOrder" placeholder="Buscar orden">
        </div>

        <div class="col-6 text-right">
          <span v-if="searchOrder">{{filterOrders.length}} Ordenes</span>
          <span v-else>{{allOrders.length}} Ordenes</span>
        </div>

        <div class="table-responsive">
          <table class="table text-center table-striped table-hover table-sm">
            <thead class="bg-dark text-white">
              <tr>
                <th>Código</th>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Equipo</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-if="!filterOrders">
                <td colspan="7">No hay elementos en la lista</td>
              </tr>
              <tr v-for="order in filterOrders" :key="'ord-'+order.identificador">
                <td>LAB-{{order.codigo}}</td>
                <td>{{order.cliente.data.cedula}}</td>
                <td>{{order.cliente.data.nombres}} {{order.cliente.data.apellidos}}</td>
                <td>{{order.equipo.data.nombre}}</td>
                <td>{{order.fechaCreacion.split(' ')[0]}}</td>
                <td>
                  <span v-if="order.estado === 'pendiente'" class="badge badge-danger">Pendiente</span>
                  <span v-else-if="order.estado === 'revisado'" class="badge badge-primary">Revisado</span>
                  <span v-else class="badge badge-success">Entregado</span>
                </td>
                <td>
                  <a
                    @click.prevent="getOrder(order.identificador)"
                    href="#"
                    title="Editar"
                    class="text-dark"
                  >
                    <small>
                      <i class="fas fa-pen" style="cursor: pointer;"></i>
                    </small>
                  </a>
                  
                  <a @click.prevent="deleteOrder" title="Eliminar" class="text-danger">
                    <small>
                      <i :id="order.identificador" class="fas fa-trash" style="cursor: pointer;"></i>
                    </small>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div> 

        <nav v-if="!searchOrder" aria-label="Page navigation example" class="mx-2">
          <ul class="pagination pagination-sm">
            <li
              v-for="page in ordersMeta.total_pages"
              :key="page"
              v-bind:class="{'page-item pt-1':true, 'active':(page === ordersMeta.current_page)}"
            >
              <a @click.prevent="ordersPaginate(page)" class="page-link" href="#">{{page}}</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</template>

<script>
import EditOrder from "../partials/EditOrder.1";
export default {
  name: "orders",
  data() {
    return {
      editOrder: false,
      searchOrder: "",
      orders: "",
      idOrder: "",
      allOrders: "",
      ordersMeta: "",
      device: {
        ci: "",
        first_name: "",
        last_name: "",
        phone: "",
        area: "",
        address: ""
      }
    };
  },
  created() {
    eventBus.$on("editingOrder", value => {
      this.editOrder = value;
    });
  },
  mounted() {
    this.getAllOrders();
    this.getOrders();
  },
  methods: {
    getAllOrders() {
      this.$emit("loading-data", true);
      axios
        .get("api/orders-all")
        .then(response => {
          this.allOrders = response.data.data || [];
        })
        .catch(error => {
          console.log(error);
        })
        .then(() => {
          this.$emit("loading-data", false);
        });
    },
    deleteOrder(event) {
      this.selectedOrder = event.target.id;
      this.$emit("prompt", {
        title: "¿Está seguro?",
        message: "El resgistro sera Eliminado!",
        confirmHandler: this.deleteOrderHandler
      });
    },

    deleteOrderHandler() {
      axios
        .delete("api/orders/" + this.selectedOrder)
        .then(response => {
          this.getOrders();
          this.getAllOrders();
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
    getOrders() {
      eventBus.$emit("loading", true);
      axios
        .get("api/orders-all?paginate=true")
        .then(response => {
					this.allOrders = response.data.data;
          if (response.data.meta) this.ordersMeta = response.data.meta.pagination;
        })
        .catch(error => {
          console.log(error);
        })
        .then(() => {
          eventBus.$emit("loading", false);
        });
    },
    ordersPaginate(page) {
      axios
        .get("/api/orders-all?paginate=true&page=" + page)
        .then(response => {
          this.allOrders = response.data.data;
          if (response.data.meta) this.ordersMeta = response.data.meta.pagination;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getOrder(id) {
      this.idOrder = id;
      this.editOrder = true;
    }
  },
  computed: {
    filterOrders: function() {
      if (this.searchOrder != "") {
        return this.allOrders.filter(
          item =>
            item.cliente.data.cedula.includes(this.searchOrder) ||
            item.cliente.data.nombres
              .toUpperCase()
              .includes(this.searchOrder.toUpperCase()) ||
            item.cliente.data.apellidos
              .toUpperCase()
              .includes(this.searchOrder.toUpperCase()) ||
            item.equipo.data.nombre
              .toUpperCase()
              .includes(this.searchOrder.toUpperCase()) ||
            item.codigo
              .toUpperCase()
              .includes(this.searchOrder.toUpperCase()) ||
            item.estado
              .toUpperCase()
              .includes(this.searchOrder.toUpperCase()) ||
            item.fechaCreacion.includes(this.searchOrder)
        );
      } else {
        return this.allOrders;
      }
    }
  },
  components: {
    EditOrder
  }
};
</script>

<style></style>