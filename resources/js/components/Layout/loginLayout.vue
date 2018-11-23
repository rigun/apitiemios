<template>
  <div id="content">
    <nav class="navbar has-shadow is-dark">
        <div class="container">
            <div class="navbar-start">
                        <router-link :to="{name: 'Landing'}"  class="navbar-item" style="text-align: left;display: flex;color: white;">
               
                    <img src="/images/Logo.png" alt="Logo" />
                    <p class="m-l-15">SMP Negeri 4 Depok</p>
                        </router-link>

            </div>
            
        </div>
    </nav>

<div class="container">
    <div class="box-login">

        <div class="alert alert-danger" v-if="loginError">
            <p>Password atau Email anda salah</p>
        </div>

        <div class="login-header">
            <h1>Masuk</h1>
        </div>
        <div class="login-body">
            <form autocomplete="off" v-on:submit.prevent="loadUpdate();submitLogin()"  >
           
            <div class="field">
                    <label class="label">Email</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input " type="email" name="email"  v-model="email" required >
                        <span class="icon is-small is-left">
                        <i class="fa fa-user"></i>
                        </span>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Password</label>
                    <div class="control has-icons-left has-icons-right">
                        <input id="password" type="password" class="form-control input " name="password" v-model="password" required>
                        <span class="icon is-small is-left">
                        <i class="fa fa-lock"></i>
                        </span>
                    </div>

                 
                </div>
              
                
              
                <div class="field is-grouped">
                <div class="control">
                    <button class="button btn-custom m-t-35" :class="{'is-loading' : load}">Masuk</button>
                </div>
               
                </div>
            </form>
                
        </div>
    </div>
</div>

</div>
</template>

<script>
    import store from '../../store'
    export default {
        data() {
            return {
                email: '',
                password: '',
                loginError: false,
                load: false,
            }
        },
        methods: {
            loadUpdate(){
                this.load = true;
            },
            submitLogin() {
                this.loginError = false;
                axios.post('/api/auth/login', {
                    email: this.email,
                    password: this.password
                }).then(response => {
                    // login user, store the token and redirect to dashboard
                    // console.log(response);
                    store.commit('loginUser')
                    localStorage.setItem('token', response.data.access_token)
                    localStorage.setItem('roles', response.data.role)
                    this.$router.push({ name: 'DashboardLayout' })
                    this.load = false;
                }).catch(error => {
                    this.loginError = true
                    this.load = false;
                });

            }
        }
    }
</script>
