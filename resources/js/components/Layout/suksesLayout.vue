<template>
  <div id="suksesLayout">
    <nav class="navbar has-shadow">
        <div class="container">
            <div class="navbar-start">
                        <router-link :to="{name: 'Landing'}"  class="navbar-item" >
               
                    <img :src="'../images/Llgo.png'" alt="Logo" />
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
                        <img :src="'../images/logo.png'" alt="" width="140px">
                         <h2>Pendaftaran Berhasil</h2>
                       <p>Silahkan Lakukan verifikasi email terlebih dahulu dengan cara mengakses link yang telah kami kirim ke email anda</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</template>

<script>
  
</script>
