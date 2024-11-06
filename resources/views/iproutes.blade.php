<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IP Routes</title>
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
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" @click="getInterface" href="#interface">Interface</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  IP
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" @click="getIpAddress" href="#ipaddress">Address</a></li>
                  <li><a class="dropdown-item" @click="getIpDns" href="#ipdns">DNS</a></li>
                  <li><a class="dropdown-item" @click="getIpFirewall" href="#ipfirewall">Firewall</a></li>
                  <li><a class="dropdown-item" @click="getIpHotspot" href="#iphotspot">Hotspot</a></li>
                  <li><a class="dropdown-item" @click="getIpPool" href="#ippool">Pool</a></li>
                  <li><a class="dropdown-item" @click="getIpRoutes" href="#iproutes">Routes</a></li>
                </ul>
              </li>
            </ul>
            <form class="d-flex" role="search">
             
              <button class="btn btn-outline-danger" @click="logout" type="button">Logout</button>
            </form>
          </div>
        </div>
      </nav>
      <br>
      <div class="card">
        <div class="card-body">
            <div id="mikrotik" class="alert alert-primary" role="alert">
                
            </div>
        </div>
      </div>
      <hr>
      <div class="card">
        <div class="alert alert-secondary" role="alert">
            IP Address : {{ $ip }}
        </div>
          
        <div class="card-body">
           <center> <img src="./storage/logo.png" width="300" height="850" class="img-fluid" alt="..."></center>
        </div>
      </div>

      <hr>

      <div class="card">
        <div class="card-body">
            <center v-if="loading">
                <div class="spinner-border text-info" role="status">
                    <span class="visually-hidden"></span>
                  </div>
            </center>
            {{-- content --}}
            <div class="alert alert-success" role="alert">
               @{{ menu }}
            </div>
            <br>
            <ul class="list-group">
                <li v-for="mydata in data" class="list-group-item list-group-item-dark">@{{mydata['dst-address']}} - @{{mydata['gateway-status']}}</li>
            </ul>
        </div>
      </div>

    </div>
      <script>
        const csrf_token = "<?= csrf_token(); ?>";
        const SERVER = 'http://127.0.0.1:8000/';

        const iproutes = SERVER + 'api/get-iproutes';

        const ip = "<?= $ip ?>";

        _setTitle("IP Routes { "+ip+" }");
      
        new Vue({
          el: '#app',
          data: {
             data : null,
             loading : false,
             menu : null
          },
          methods: {
            getIpHotspot: function(){
                _refresh("/iphotspot");
            },
            getIpPool: function(){
                _refresh("/ippool");
            },
            getIpFirewall: function(){
                _refresh("/ipfirewall");
            },
            getIpRoutes: function(){
                _refresh("/iproutes");
            },
            getIpDns: function(){
                _refresh("/ipdns");
            },
            getIpAddress: function(){
                _refresh("/ipaddress");
            },
            getInterface: function(){
                _refresh("/interface");
            },
            logout:function(){
                _refresh("/logout");
            }
          },
          mounted() {
            this.loading = true;
                this.menu  = 'IP Routes'
                __({
                    url : iproutes,
                    method : 'post',
                    data : {
                        ip : _getStorage('ip'),
                        username : _getStorage('username'),
                        password : _getStorage('password'),
                        port : _getStorage('port'),
                        _token : csrf_token
                    }
                 }).request($response=>{
                     this.loading = false
                     var obj  = JSON.parse($response);
                     
                     this.data  = obj;
                 });
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