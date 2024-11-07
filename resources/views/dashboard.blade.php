<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.16/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/lamhotsimamora/garuda-javascript@master/src/garuda.js"></script>
</head>
<body >
    <div class="container" id="app">
       @include('@component.navbar')
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

      

    </div>
      <script>
        const csrf_token = "<?= csrf_token(); ?>";
        const SERVER = 'http://127.0.0.1:8000/';

        const interface = SERVER + 'api/get-interface';
        const ipaddress = SERVER + 'api/get-ipaddress';

        const ip = "<?= $ip ?>";

        _setTitle("Dashboard { "+ip+" }");
      
        new Vue({
          el: '#app',
          data: {
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
            getNetwatch: function(){
                _refresh("/netwatch");
            },
            logout:function(){
                _refresh("/logout");
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