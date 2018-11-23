<template>
   <div class="content" id="landingComponent">
       <div class="container" style="margin-top: 130px">
           <div class="columns">
               <div class="column is-half is-offset-one-quarter">
                   <div class="box" >
                           <div class="box-login" style="min-height: 300px">

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
                                    <div class="control">
                                        <button class="button is-success m-t-35 is-fullwidth" :class="{'is-loading' : load}">Masuk</button>
                                    </div>
                                    <div style="text-align: center;">
                                        <span style="color: red">Halaman login ini khusus untuk admin</span>
                                    </div>
                                </form>
                                    
                            </div>
                        </div>

                   </div>
                </div>      
           </div>
       </div>
   </div>
</template>
<style>

</style>

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
                axios.post('/api/user/login', {
                    email: this.email,
                    password: this.password
                }).then(response => {
                    if(response.data.role == 'administrator'){
                        store.commit('loginUser')
                        localStorage.setItem('token', response.data.access_token)
                        localStorage.setItem('roles', response.data.role)
                        this.$router.push({ name: 'DashboardContent' })
                        this.load = false;
                    }else{
                        this.load = false;
                         this.$toast.open({
                            duration: 500,
                            message: 'Mohon maaf halaman ini khusus untuk admin',
                            position: 'is-bottom',
                            type: 'is-danger',
                            queue: false,
                        })
                    }
                }).catch(error => {
                    this.loginError = true
                    this.load = false;
                    this.$toast.open({
                            duration: 500,
                            message: 'Email atau Password salah',
                            position: 'is-bottom',
                            type: 'is-danger',
                            queue: false,
                    })

                });

            }
        }
    }
</script>