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
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Tools
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" @click="getNetwatch" href="#ipaddress">Netwatch</a></li>
            </ul>
          </li>
        </ul>
        
        <form class="d-flex" role="search">
         
          <button class="btn btn-outline-danger" @click="logout" type="button">Logout</button>
        </form>
      </div>
    </div>
  </nav>