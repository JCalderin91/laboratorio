<template>

  <transition name="fade" mode="out-in">
    <router-view ></router-view>
  </transition>

</template>

<script>
//import Navbar from "./partials/Navbar";

import Dashboard from "./views/Dashboard";
import Login from "./views/Login";

export default {
  name: "app",
  data() {
    return {
      error: false,
      loading: false
    };
  },
  
  beforeCreate: function () {
    if (!this.$session.exists()) {
      this.$router.push({name:'login'})
    }
  },
  

  components: {
    Login,
    Dashboard,
  }
};
</script>
<style lang="scss" >
.fade-enter,
.fade-leave-active {
  transition: opacity 0.1s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
.about {
  position: fixed;
  bottom: 5px;
  right: 5px;
  color: #33333360;
  font-style: italic;
  transition: all 0.3s ease;
  text-shadow: 0px 0px 1px rgba(255,255,255,0.3);
  &:hover {
    color: #333;
    text-shadow: 1px 1px 1px white;
  }
}
</style>

