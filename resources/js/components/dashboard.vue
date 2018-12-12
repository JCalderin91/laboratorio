<template>
  <div>
    <Navbar/>
    <Sidebar :name="name"/>
    <div style="padding: 10px">
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