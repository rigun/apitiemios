<template id="admin-list">
<div class="contentlist">
<div class="flex-container">
      <div class="columns m-t-10">
        <div class="column">
          <h1 class="title">Manage Pengguna</h1>
        </div>
        <div class="column" style="height: 60px;">
          <!-- <button class="button is-success is-pulled-right" v-on:click="modalCreate"><i class="fa fa-user-plus m-r-10"></i> Buat Admin Baru</button> -->
        </div>
      </div>
      <div class="columns m-t-10">
        <div class="column">
            <div class="field has-addons">
                <p class="control">
                    <input class="input" type="text" v-model="search" placeholder="Cari. . " >
                </p>
                <p class="control">
                    <a class="button is-static">
                    <i class="fa fa-search"></i>
                    </a>
                </p>
            </div>
        
        </div>
        
      </div>

      <div class="card p-b-20">
        <div class="card-content">
          <table class="table is-hoverable is-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Tanggal Pembuatan</th>
                <th>Pengaturan</th>
              </tr>
            </thead>

            <tbody>
                  
                <tr v-for="(admin, index) in filterAdmin " :key="admin.id">
                  <th>{{ index + 1 + start}}</th>
                  <td>{{ admin.name }}</td>
                  <td>{{ admin.email }}</td>
                  <td>{{ admin.created_at }}</td>
                  <td><a class="button is-danger" href="#" v-on:click.prevent="modalDelete();setIdDelete(admin)">Hapus</a></td>
                </tr>
            
            </tbody>
          </table>
          <div class="footer-table-pagination">
            <!-- <vue-ads-pagination v-if="countAdmin!=0"
                :page="0"
                :itemsPerPage="100"
                :total-items="countAdmin"
                :max-visible-pages="3"
                @page-change="pageChange"
            /> -->
        </div>  
        </div>
       
      </div> <!-- end of .card -->
         
    </div>

    <div  class="modal" v-bind:class="{ 'is-active' : active }">
      <div class="modal-background" v-on:click="modalCreate" ></div>
        <div class="modal-card">
          <header class="modal-card-head">
            <p class="modal-card-title">Tambahkan Admin</p>
            <button class="delete" aria-label="close" v-on:click="modalCreate"></button>
          </header>
            <form v-on:submit.prevent ="createAdmin()">

            <section class="modal-card-body">
            
            <div class="columns">
              <div class="column">
                <div class="field">
                  <label for="name" class="label">Nama</label>
                  <p class="control">
                    <input type="text" class="input" v-model="dataAdmin.name" name="name" id="name" required>
                  </p>
                </div>
                <div class="field">
                  <label for="name" class="label">Username</label>
                  <p class="control">
                    <input type="text" class="input" v-model="dataAdmin.username" name="username" id="username" required>
                  </p>
                </div>

                <div class="field">
                  <label for="password" class="label">Password</label>
                  <p class="control">
                    <input type="password" class="input" name="password" v-model="dataAdmin.password" id="password" required >
                  </p>
                </div>

              </div> <!-- end of .column -->
            </div> <!-- end of .columns for forms -->       
          </section>
          <footer class="modal-card-foot">
            <button class="button is-success" :class="{'is-loading' : load}" @click="updateLoad()">Buat Admin</button>

            <a class="button is-danger" v-on:click="modalCreate" >Cancel</a>
          </footer>
          </form>

      </div>
    </div>
    <div  class="modal" v-bind:class="{ 'is-active' : activeUpdate }">
      <div class="modal-background" v-on:click="modalUpdate()" ></div>
      
        <div class="modal-card">
          <header class="modal-card-head">
            <p class="modal-card-title">Perbaharui Admin</p>
            <button class="delete" aria-label="close" v-on:click="modalUpdate()"></button>
          </header>
            <form v-on:submit.prevent ="updateAdmin()">

            <section class="modal-card-body">
            <div class="columns">
              <div class="column">
                <div class="field">
                  <label for="name" class="label">Nama</label>
                  <p class="control">
                    <input type="text" class="input" v-model="dataAdmin.name" name="name" id="name" required>
                  </p>
                </div>
                <div class="field">
                  <label for="name" class="label">Username</label>
                  <p class="control">
                    <input type="text" class="input" v-model="dataAdmin.username" name="username" id="username" required>
                  </p>
                </div>

                <div class="field">
                  <label for="password" class="label">Password</label>
                  <p class="control">
                    <input type="password" class="input" name="password" v-model="dataAdmin.password" id="password" >
                  </p>
                </div>
                <div class="field">
                  <p class="control">
                    <b-checkbox v-model="dataAdmin.password_options" >reset</b-checkbox>
                  </p>
                </div>

              </div> <!-- end of .column -->
            </div> <!-- end of .columns for forms -->       
          </section>
          <footer class="modal-card-foot">
            <button class="button is-success"  :class="{'is-loading' : load}" @click="updateLoad()">Ubah Data</button>

            <a class="button is-danger" v-on:click="modalUpdate()" >Cancel</a>
          </footer>
          </form>

      </div>
    </div>
    <div  class="modal" v-bind:class="{ 'is-active' : activeDelete }">
      <div class="modal-background" v-on:click="modalDelete()" ></div>
      
        <div class="modal-card">
          <header class="modal-card-head">
            <p class="modal-card-title">Hapus Admin</p>
            <button class="delete" aria-label="close" v-on:click="modalDelete()"></button>
          </header>
            <form v-on:submit.prevent ="deleteAdmin()">

            <section class="modal-card-body">
                <p>Admin yang dihapus tidak dapat dikembalikan lagi, apakah anda yakin ingin menghapusnya ? </p>
          </section>
          <footer class="modal-card-foot">
            <button class="button is-warning"  :class="{'is-loading' : load}" @click="updateLoad()">Hapus Data</button>

            <a class="button is-danger" v-on:click="modalDelete()" >Cancel</a>
          </footer>
          </form>

      </div>
    </div>
</div>
</template>

<script>
// import VueAdsPagination from 'vue-ads-pagination';
    export default {
       components: {
        //   VueAdsPagination,
      },
        data(){
            return{
                search: '',
                active: false,
                activeUpdate: false,
                activeDelete:false,
                id:'',
               dataAdmin: [],
                admins:[],
                page: 0,
                start: 0,
                end: 0,
                countAdmin: 0,
                load: false,
            }
        },
        created: function() {
          if(localStorage.getItem('roles') == 'user'){
                  this.$router.push({ name: 'Landing' });
          }else{
            this.getAdmin();
          }
            
        },
         methods: {
         
          updateLoad(){
            this.load = true;
          },
            getAdmin(){
              this.load = false;
                  let uri = '/api/user';
                  axios.get(uri,{
                  headers: {
                      Authorization: 'Bearer ' + localStorage.getItem('token')
                  }
              }).then((response) => {
                      this.admins = response.data;
                      this.countAdmin = this.admins.length;
                  }).catch(error => {
                      // console.log(error.response)
                  });
            },
            modalCreate: function(event){
              if(this.active == true){
                this.active = false;
              }else if(this.active == false){
                this.active = true;
              }else{
                this.$toast.open({
                    duration: 2000,
                    message: 'error',
                    position: 'is-bottom',
                    type: 'is-danger',
                    queue: false,
                });
              }
            },
            modalUpdate(){
              if(this.activeUpdate == true){
                this.activeUpdate = false;
              }else if(this.activeUpdate == false){
                this.activeUpdate = true;
              }else{
                this.$toast.open({
                    duration: 2000,
                    message: 'error',
                    position: 'is-bottom',
                    type: 'is-danger',
                    queue: false,
                });
              }
            },
            modalDelete(){
              if(this.activeDelete == true){
                this.activeDelete = false;
              }else if(this.activeDelete == false){
                this.activeDelete = true;
              }else{
                this.$toast.open({
                    duration: 2000,
                    message: 'error',
                    position: 'is-bottom',
                    type: 'is-danger',
                    queue: false,
                });
              }
            },
            setIdDelete(data){
              this.id = data.id;
            },
            setDataUpdate(data){
              this.dataAdmin = data;
            },
            createAdmin: function() {
             
              let uri = '/api/user/register';
              axios.post(uri, this.dataAdmin,{
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token')
                }
            }).then((response) => {
                this.active = false;
                this.dataAdmin = this.dataAdminNull;
                   this.getAdmin();
                this.$toast.open({
                    duration: 2000,
                    message: 'Admin berhasil di tambahkan',
                    position: 'is-bottom',
                    type: 'is-success',
                    queue: false,
                });
              }).catch(error => {
                
                this.active = false;
                this.dataAdmin = this.dataAdminNull;
                this.getAdmin();
                this.$toast.open({
                  duration: 2000,
                  message: 'Terjadi Kesalahan, Silahkan coba lagi',
                  position: 'is-bottom',
                  type: 'is-danger',
                  queue: false,
              })
                });
            },
            updateAdmin(){
              
              let uri = '/api/user/'+this.dataAdmin.id;
              axios.patch(uri, this.dataAdmin,{
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token')
                }
            }).then((response) => {
               
                this.activeUpdate = false;
                this.dataAdmin = this.dataAdminNull;
                this.getAdmin();

                 this.$toast.open({
                  duration: 2000,
                  message: response.data.msg,
                  position: 'is-bottom',
                  type: 'is-success',
                  queue: false,
              })
              }).catch(error => {
              
                this.activeUpdate = false;
                this.dataAdmin = this.dataAdminNull;
                this.getAdmin();

                  this.$toast.open({
                  duration: 2000,
                  message: 'Coba lagi dengan username yang berbeda',
                  position: 'is-bottom',
                  type: 'is-danger',
                  queue: false,
              })
                });
            },
            deleteAdmin(){
              let uri = '/api/user/'+this.id;
              axios.delete(uri,{
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token')
                }
            }).then((response) => {
                this.activeDelete = false;
                this.id = '';
                this.getAdmin();
                
                  this.$toast.open({
                  duration: 2000,
                  message: 'Berhasil di hapus',
                  position: 'is-bottom',
                  type: 'is-success',
                  queue: false,
              })
              }).catch(error => {
                this.activeDelete = false;
                this.id = '';
                this.getAdmin();
                
                  this.$toast.open({
                  duration: 2000,
                  message: 'Coba lagi',
                  position: 'is-bottom',
                  type: 'is-danger',
                  queue: false,
              })
                });
            }
         },
        computed: {
            // filterAdmin: function(){
            //     if(this.admins.length) {
            //         return this.admins.filter((row, index) => {
            //                 if(this.search != '') return row.name.toLowerCase().includes(this.search.toLowerCase());
            //                 if(index >= this.start && index < this.end) return true;
            //               });
            //     }
            // },
            filterAdmin: function(){
                if(this.admins.length) {
                    return this.admins.filter((row, index) => {
                            if(this.search != '') return row.name.toLowerCase().includes(this.search.toLowerCase())
                            else return true;
                          });
                }
            },
            
        },
        
}
</script>
