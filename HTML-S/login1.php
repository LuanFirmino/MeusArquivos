<?php
session_start();
if(@$_SESSION['logM']){
    header("Location: ./VIEWs/homeMedico.php");
} else if(@$_SESSION['logP']) {
    header("Location: ./VIEWs/homePaciente.php");
} else {
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="PT-BR">
  <head>
      <meta charset="utf-8">
      <title>Pagina de Login</title>
      <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
      <link rel="stylesheet" href="./CODs/Log/bootstrap.min.css">
      <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
      <script src="./CODs/Log/jquery.min.js"></script>
      <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
      <script src="./CODs/Log/bootstrap.min.js"></script>
      <style type="text/css">
        body{
          background-image: url(IMG/medicina.jpg);
        }
    </style>
  </head>
  <body>
    <div class="container" style="margin-top: 5%;">
      <div class="row">
        <div class="col-sm-4"></div>
          <div class="col-md-4" style="background-color: #606060; border-radius: 8px;">
    <!-- Titulo da Pagina -->
          <h1 class="" style="color: #fff; padding-left: 12%; text-decoration: none;">Pagina de Login</h1><br/>
          <div class="col-sm-12">
            <ul class="nav nav-pills" >
              <li class="" style="width:50%"><a class="btn btn-lg btn-default" data-toggle="tab" href="#home">Doutor</a></li>
              <li class="" style="width:48%"><a class=" btn btn-lg btn-default" data-toggle="tab" href="#menu1">Paciente</a></li>
            </ul><br/>
            <div class="tab-content">
              <div id="home" class="tab-pane fade in active">
  <!-- ponto de referencia FORM -->
                <form action="./DAOs/medico.php" method="post" onsubmit="return">
                  <div class="form-group">
                    <label for="login" style="color: #fff;">Login:</label>
                    <input id="login" type="email" name="login" placeholder="Email" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="senha" style="color: #fff;">Password:</label>
                    <input id="senha" type="password" name="senha" placeholder="Senha" class="form-control" required>
                  </div>
                  <input type="hidden" name="rota" value="2">
                  <button type="submit" class="btn btn-default btn-lg">Entrar</button>
                  <button type="button" class="pull-right btn-link"><a href="#">Esqueci a Senha</a></button>
                </form><br/>
                <a href="./VIEWs/cadMedico.php" class="pull-right btn btn-block btn-danger">Cadastrar-se</a><br/>.
              </div>
              <div id="menu1" class="tab-pane fade">
  <!-- Ponto de Referencia FORM-->
                <form action="./DAOs/paciente.php" method="post" onsubmit="return">
                  <div class="form-group">
                    <label for="email" style="color: #fff;">Login:</label>
                    <input id="email" type="email" name="login" placeholder="Email" class="form-control" >
                  </div>
                  <div class="form-group">
                    <label for="pwd" style="color: #fff;">Password:</label>
                    <input id="pwd" type="password" name="senha" placeholder="Senha" class="form-control" >
                  </div>
                  <input type="hidden" name="rota" value="2">
                  <button type="submit" class="btn btn-default btn-lg">Entrar</button>
                  <button type="submit" class="pull-right btn-link"><a href="#">Esqueci a Senha</a></button><br/>.
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>