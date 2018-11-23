<template>
   <div class="content" id="homeLayout">
     <nav class="navbar" role="navigation" aria-label="main navigation">
         <div class="container">
<div class="navbar-brand">
                <router-link :to="{name: 'Landing'}" class="navbar-item" style="color: white">
                <img src="/images/logo.png" height="40" style="margin-right: 20px;">
                Selamat Datang di website TiemSchedule IOS
                </router-link>

                <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                </a>
            </div>

            <div id="navbarBasicExample" class="navbar-menu">

            </div>
         </div>
            
    </nav>
            <div class="m-t-65"></div>
     <div id="appPage">
            <main class="pageContent">
            <transition name="fade">
            <router-view></router-view>
            </transition>
            </main>
        </div>
            <div class="m-b-30"></div>
        <div class="footer" style="position: absolute; bottom: 0px; left: 0px; right: 0px;">
            <p style="text-align: center">Copyright © {{year}} TiemSchedule</p>
        </div>
   </div>
</template>
<style>

</style>


<script>
    export default {
        data() {
            return {
             year:'',
         }
     },
     created(){
        this.getThisYear();
     },
     methods:{
         getUser(){
            },
         getThisYear(){
                this.year = new Date().getFullYear();
            },
     },
    }
</script>