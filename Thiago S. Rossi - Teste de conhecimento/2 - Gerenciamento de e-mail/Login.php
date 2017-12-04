<?php
  include 'Conexao.php';
  /*Verifica se o botão de cadastro foi pressionado*/
  if(isset($_POST['logar'])){
    
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $verifica = "SELECT * FROM administrador WHERE login_adm = '$login' AND senha_adm = '$senha' ";
    $queryVerifica = mysqli_query($mysqli,$verifica);
    /*Verifica se o e-mail já existe no banco*/
    if (mysqli_num_rows($queryVerifica)==1){

      session_start();
      /*Faz o login do administrador e o redireciona para o Cadastro.php*/
      $_SESSION['LOGIN'] = $login;
      $_SESSION['SENHA'] = $senha;
      header("location:Cadastro.php");

    }

  }

?>
<html>
  <head>
    <!-- Importações -->   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <!-- Fim das importações -->
    <link href="Style.css" rel="stylesheet">
    <title>Cadastro</title>
  </head>
  <body>
    <center>
      <!-- Navbar -->
      <nav class="navbar navbar-toggleable-md navbar-light bg-faded" style="background-color: #555555 !important;">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Menu</a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link" href="Login.php">Login</a>
          </div>
        </div>
      </nav>
      <!-- Fim da Navbar -->
      <!-- Div Login -->
      <div id="cadastroEmail">
        <form action="Login.php" method="POST" name="frmLogin">
          <br>
          <label id="titulo">Login Administrador</label>
          <hr>
          <div class="form-group col-md-8">
            <label >Login:</label>
            <input type="text" class="form-control" id="login" name="login" required maxlength="45">
          </div>
          <div class="form-group col-md-8">
            <label >Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" required maxlength="45">
          </div>
          <input type="submit" class="btn btn-secondary" name="logar" id="logar" value="Logar" ><br>
        </form>
      </div>  
      <!-- Fim do Login -->
    </center>	  
  </body>
</html>