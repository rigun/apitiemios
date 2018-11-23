<template>
  <div id="suksesLayout">
    <nav class="navbar has-shadow">
        <div class="container">
            <div class="navbar-start">
                        <router-link :to="{name: 'Landing'}"  class="navbar-item" >
               
                    <img :src="'../../images/logo.png'" alt="Logo" />
                    <p class="m-l-15">Bukren</p>
                        </router-link>

            </div>
            
        </div>
    </nav>

    <div class="container">
        <div class="columns m-t-65">
            <div class="column is-half is-offset-one-quarter">
                <div class="box">
                    <div class="content " style="text-align:center">
                        <img :src="'../../images/logo.png'" alt="" width="140px">
                         <h2>{{msg}}</h2>
                       <p v-if="statusMsg != 0">Terima kasih sudah melakukan verfikasi email, selamat bergabung bersama Bukren</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</template>

<script>
export default {
    data(){
        return{
           msg: 'Mohon tunggu sebentar',
           statusMsg: 0
        }
    },
      created: function() {
        this.sendVerifikasi();
    },
    methods:{
        sendVerifikasi(){
            let url = '/api/user/verfikasi/'+ this.$route.params.token;
               axios.get(url,{
                   headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                }).then((response) => {
                    this.msg = 'Verifikasi Berhasil Dilakukan';
                    this.statusMsg = 1;
                })
                .catch(error =>{
                    console.log(error);
                });
        },
    }
}
</script>
