<template>
  <div>
    <Sidebar :name="name"/>
    <div class="main">    
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
  .main{
    padding: 10px 10px 10px 270px;
  }
</style>