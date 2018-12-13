<template>
  <div>
    <Sidebar :name="name"/>
    <div id="main" class="page-content">    
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import Navbar from "./Navbar";
import Sidebar from "./Sidebar";

export default {
  name: "Dashboard",
  data() {
    return {};
  },
  computed: {
    name() {
      return this.$session.get("name");
    },
    email() {
      return this.$session.get("email");
    }
  },
  methods: {},
  components: {
    Navbar,
    Sidebar
  }
};
</script>

<style lang="css">

</style>