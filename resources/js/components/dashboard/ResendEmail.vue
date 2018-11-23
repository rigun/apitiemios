<template>
   <div class="content" id="landingComponent">
       <div class="container" style="margin-top: 130px">
           <div class="columns">
               <div class="column is-half is-offset-one-quarter">
                   <div class="box" >
                           <div class="box-login" style="min-height: 300px">

                            <div class="login-header">
                                <h1>Kirim Ulang Kode Verifikasi</h1>
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
                                    <div class="control">
                                        <button class="button is-success m-t-35 is-fullwidth" :class="{'is-loading' : load}">Kirim</button>
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
    export default {
        data() {
            return {
                email: '',
                load: false
            }
        },
        methods: {
            loadUpdate(){
                this.load = true;
            },
            submitLogin() {
                axios.post('/api/mail/send', {
                    email: this.email,
                }).then(response => {
                    this.$toast.open({
                            duration: 2000,
                            message: 'Email Terkirim',
                            position: 'is-bottom',
                            type: 'is-success',
                            queue: false,
                    })
                }).catch(error => {
                    this.loginError = true
                    this.load = false;
                    this.$toast.open({
                            duration: 500,
                            message: 'Coba Lagi ',
                            position: 'is-bottom',
                            type: 'is-danger',
                            queue: false,
                    })

                });

            }
        }
    }
</script>