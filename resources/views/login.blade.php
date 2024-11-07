<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.16/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/lamhotsimamora/garuda-javascript@master/src/garuda.js"></script>
</head>
<body >
    <div class="container" id="app">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href=".">Router OS</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
          </div>
        </div>
      </nav>
      <br>
      <div class="card">
        <div class="card-body">
            <div id="mikrotik" class="alert alert-primary" role="alert">
                
            </div>
              
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">IP</span>
                <input type="text" class="form-control" ref="ip" placeholder="IP" v-model="ip" aria-label="Username" aria-describedby="basic-addon1">
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Port</span>
                <input type="text" class="form-control" ref="port" placeholder="Port" v-model="port" aria-label="Username" aria-describedby="basic-addon1">
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Username</span>
                <input type="text" class="form-control"  ref="username" placeholder="Username" v-model="username" aria-label="Username" aria-describedby="basic-addon1">
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Password</span>
                <input :type="password_config" class="form-control" ref="password" placeholder="Password" v-model="password" aria-label="Username" aria-describedby="basic-addon1">
              </div>
              <div class="form-check">
                <input class="form-check-input" @change="changePassword" v-model="showPassword" type="checkbox" >
                <label class="form-check-label" for="flexCheckIndeterminate">
                 Show Password
                </label>
              </div>
              <hr>
              <button class="btn btn-primary" @click="login" v-html="showHtmlButtonLogin"></button>
              
        </div>
      </div>
    </div>
      <script>
        const csrf_token = "<?= csrf_token(); ?>";
        const SERVER = 'http://103.126.226.164:1234/';

        const btn_login_loading = '<div class="spinner-border text-danger" role="status"><span class="visually-hidden"></span></div>';

        new Vue({
          el: '#app',
          data: {
             ip : null,
             username : null,
             password : null,
             port: 8728,
             showHtmlButtonLogin: 'Login',
             showPassword: false,
             password_config: "password"
          },
          methods: {
            changePassword: function(){
                if (this.password_config==='password'){
                    this.password_config = 'text';
                }else{
                    this.password_config = 'password'
                }
            },
            login: function(){
                 if (this.ip == null) {
                     this.$refs.ip.focus()
                     return;
                 }
                 if (this.port == null) {
                     this.$refs.port.focus()
                     return;
                 }
                 if (this.username == null) {
                     this.$refs.username.focus()
                     return;
                 }
                 if (this.password == null) {
                     this.$refs.password.focus()
                     return;
                 }
                 this.showHtmlButtonLogin = btn_login_loading;
                
                 __({
                    url : 'api/login-mikrotik',
                    method : 'post',
                    data : {
                        ip : this.ip,
                        username : this.username,
                        password : this.password,
                        port : this.port,
                        _token : csrf_token
                    }
                 }).request($response=>{
                    this.showHtmlButtonLogin = "Login"
                     var obj  = JSON.parse($response);
                     if (obj.result){
                        Swal.fire({
                            title: "Login Success",
                            text: "Login {"+this.ip+"} Success !",
                            icon: "success"
                        });
                        _saveStorage("ip",this.ip);
                        _saveStorage("port",this.port);
                        _saveStorage("username",this.username);
                        _saveStorage("password",this.password);
                        _refresh("/dashboard");
                     }else{
                        Swal.fire({
                            title: "Login Failed",
                            text: "Login {"+this.ip+"} Failed !",
                            icon: "error"
                        });
                     }
                 });
                
            }
          },
          mounted() {
            
          },
        });

        var mikrotik = document.getElementById('mikrotik');

        var typewriter = new Typewriter(mikrotik, {
            loop: true,
            delay: 155,
        });

        typewriter
            .pauseFor(1500)
            .typeString('Mikrotik Router OS')
            .pauseFor(4500)
            .start();
      </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>