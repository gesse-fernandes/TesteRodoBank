<template>
  <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <ul class="nav navbar-nav navbar-right">
            <router-link class="nav-link" to="/login" >Login</router-link>
        </ul>

      
      </div>
    </nav>

      <hr>
        <router-view></router-view>
      <hr>

<!-- Footer -->
<footer class="page-footer font-small blue">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2021 Todos os direitos reservados:
    <a target="_blank" href="https://github.com/gesse-fernandes"> Gessé Fernandes Martins</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
  </div>
</template>
