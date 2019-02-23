<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="css/app.css">{{-- SE REQUIERE PARA Q FUNCIONE BOOTSTRAP4 --}}
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Registro de Captación</title>

  <!-- Bootstrap core CSS -->
  <link href="vendar/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="css/fontawesome/css/all.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/scrolling-nav.css" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body id="page-top">
<div id='app'></div>{{-- Se necesita para evitar el error de vue --}}
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="http://150.187.42.6/?page_id=32">Fundacion CIARA</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#services">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="bg-primary text-white">
    <div class="container text-center">
      <h1>Sistema de Registro de Captación</h1>
      <p class="lead">Fundación CIARA</p>
    </div>
  </header>

  <section id="about">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 mx-auto">
        
          @yield('content')
          
        </div>
      </div>
    </div>
  </section>

  
  

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendar/jquery/jquery.min.js"></script>
  <script src="vendar/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendar/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="js/scrolling-nav.js"></script>
  <script src="js/app.js" charset="utf-8"></script>
  <!-- Sweetalert2 -->
  <script src="../node_modules/sweetalert2/dist/sweetalert2.js"></script>
  <!-- vee-validate -->
  <script src="../node_modules/vee-validate/dist/vee-validate.js"></script>
  <script src="../node_modules/vee-validate/dist/locale/es.js"></script>
  <!-- VueSelect2 -->
  <script src="../node_modules/vue-select/dist/vue-select.js"></script>
  <!-- Vue-pagination -->
  <script src="../node_modules/vuejs-uib-pagination/dist/vuejs-uib-pagination.js"></script>
  
</body>
<style>
[v-cloak]{
    display: none;
}
</style>
<script>
Vue.component('v-select', VueSelect.VueSelect);
Vue.use(VeeValidate);
Vue.use("vuejs-uib-pagination")
$(document).ready(function(event){
    var tecla;
    $('.solo-numerosCharlie').keypress(function(event){//Funcion para definir solo numeros en un input. By:Charlie.Aular
        tecla = (document.all) ? event.keyCode : event.which;
        if (tecla == 8 || tecla == 0 ) {
            return true;
        }
        patron =/[0-9]/;
        tecla_final = String.fromCharCode(tecla);
        return patron.test(tecla_final);

    })
  $(".UpperCase").on("keypress", function () {// Funcion para convertir a mayusculas en un input. By:Jesus.Rivera
    $input=$(this);
      setTimeout(function () {
       $input.val($input.val().toUpperCase());
      },50);
 })

})
  window.Laravel = <?php echo json_encode([
      'csrfToken' => csrf_token(),
  ]); ?>
</script>
</html>
