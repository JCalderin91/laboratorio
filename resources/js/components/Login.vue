<template>
	<div class="login-wrapper border border-light center">
    <form class="form-signin" @submit.prevent="login" >
      <h5 class="form-signin-heading">Please sign in</h5>
      <div class="alert alert-danger" v-if="error">
        {{ error }}
      </div>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input v-model="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input v-model="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
    <!-- <pre>{{ $data  }}</pre> -->
  </div>
</template>

<script>
	export default {
		name: 'login',
		data() {
			return {
				error: false,
				email: '',
				password: '',
			};
		},
    methods: {
      login() { 
      	axios.post('/auth', { user: this.email, password: this.password })
  		  .then(response => (
  		    this.loginSuccessful(response)
  		  	)
  		  )
  		  .catch(function (error) {
  		    this.loginFailed()
  		  });
      },
      loginSuccessful(req) {
        if (!req.data.token) {
          this.loginFailed()
          return
        }
        this.error = false
        localStorage.token = req.data.token
        //this.$router.replace(this.$route.query.redirect || '/authors')
      },
      loginFailed() {
        this.error = 'Login failed!'
        delete localStorage.token
      }
    },
	}
</script>

<style lang="css" scoped>
	.login-wrapper {
		background: #cccccc;
		width: 100vw;
		height: 100vh;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
	}

	.form-signin {
		width: 400px;
	  padding: 30px 50px;
	  margin: 0 auto;
	  background-color: white;

	}
	.form-signin .form-signin-heading,
	.form-signin .checkbox {
	  margin-bottom: 10px;
	}
	.form-signin .checkbox {
	  font-weight: normal;
	}
	.form-signin .form-control {
	  position: relative;
	  height: auto;
	  -webkit-box-sizing: border-box;
	          box-sizing: border-box;
	  padding: 10px;
	  font-size: 16px;
	}
	.form-signin .form-control:focus {
	  z-index: 2;
	}
	.form-signin input[type="email"] {
	  margin-bottom: -1px;
	  border-bottom-right-radius: 0;
	  border-bottom-left-radius: 0;
	}
	.form-signin input[type="password"] {
	  margin-bottom: 10px;
	  border-top-left-radius: 0;
	  border-top-right-radius: 0;
	}
</style>