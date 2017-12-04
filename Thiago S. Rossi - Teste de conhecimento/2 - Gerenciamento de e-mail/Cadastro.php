<?php
  include 'Conexao.php';
  session_start();
  /*Verifica se está logado*/
  if ((!isset($_SESSION['LOGIN']) == true) and (!isset($_SESSION['SENHA']) == true)) {
    unset($_SESSION['LOGIN']);
    unset($_SESSION['SENHA']);
    header('location:Login.php');
  }
  if(isset($_POST['cadastrar'])){
    
    $nome  = $_POST['nome'];
    $email = $_POST['email'];
    $verifica = "SELECT email_ema FROM email WHERE email_ema = '$email' ";
    $queryVerifica = mysqli_query($mysqli,$verifica);
    /*Verifica se o e-mail já existe no banco*/
    if (mysqli_num_rows($queryVerifica)==1){

      echo"<script language='javascript' type='text/javascript'>alert('E-mail já cadastrado!!');</script>";

    }else{

      $cadastro = "INSERT INTO email (nome_ema, email_ema) VALUES ('$nome', '$email')";
      $queryCadastro = mysqli_query($mysqli,$cadastro);
      /*Verifica se a inserção foi feita com sucesso*/
      if($queryCadastro){
       
        echo"<script language='javascript' type='text/javascript'>alert('E-mail cadastrado com sucesso!!');</script>";

      }else{

        echo"<script language='javascript' type='text/javascript'>alert('Erro ao cadastrar!!');</script>";

      }

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
  <body onload="atualizaData();">
    <script type="text/javascript">
      function atualizaData(){
        /*Pega a data/hora atual*/
        var data    = new Date();
        var dia     = data.getDate();       
        var mes     = data.getMonth();          
        var ano     = data.getFullYear();       
        var hora    = data.getHours();          
        var min     = data.getMinutes();        
        var seg     = data.getSeconds();
        /*Coloca a data/hora atual no padrão do banco de dados*/       
        var data_atual = ano + '-' + (mes+1) + '-' + dia;
        var hora_atual = hora + ':' + min + ':' + seg;
        /*Bota o 0 na frente de dias que só possuem 1 digito*/
        if(data_atual.length==9 ){
          data_atual = ano + '-' + (mes+1) + '-0' +dia;
        }
        /*Coloca a data no campo*/
        document.getElementById("dataHora").value = data_atual +" "+ hora_atual;
      }
      /*Determina o tempo que a função será reativada*/
      setInterval(atualizaData, 1000);

      function validaEmail(field){
        antes = field.value.substring(0, field.value.indexOf("@"));
        depois = field.value.substring(field.value.indexOf("@")+ 1, field.value.length);
        /*Verifica se o email é valido*/
        if ((antes.length >=1) &&
            (depois.length >=3) && 
            (depois.search("@")==-1) && 
            (depois.search("@")==-1) &&
            (depois.search(" ")==-1) && 
            (depois.search(" ")==-1) &&
            (depois.search(".")!=-1) &&      
            (depois.indexOf(".") >=1)&& 
        (depois.lastIndexOf(".") < depois.length - 1)) {
          document.getElementById("msgEmail").innerHTML="";
          document.getElementById("msgEmail").style.border ="1px solid #555555";

        }
        else{
          document.getElementById("msgEmail").innerHTML ="E-mail inválido";
          document.getElementById("msgEmail").style.border ="1px solid #cc0000";
          document.getElementById("msgEmail").style.borderRadius ="5px";
          /*Previne Submit*/
          event.preventDefault();
        }
      }
    </script>
    <center>
      <!-- Navbar -->
      <nav class="navbar navbar-toggleable-md navbar-light bg-faded" style="background-color: #555555 !important;">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Menu</a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link" href="Cadastro.php">Cadastro</a>
            <a class="nav-item nav-link" href="Gerenciamento.php">Gerenciamento </a>
            <a class="nav-item nav-link" href="Sair.php">Sair </a>
          </div>
        </div>
      </nav>
      <!-- Fim da Navbar -->
      <!-- Div Cadastro-->
      <div id="cadastroEmail">
        <form action="Cadastro.php" method="POST" onsubmit="validaEmail(frmCadastro.email);" name="frmCadastro">
          <br>
          <label id="titulo">Cadastro de E-mail</label>
          <hr>
          <div class="form-group col-md-8">
            <label >Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" required maxlength="50">
          </div>
          <div class="form-group col-md-8">
            <label >E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" required maxlength="100" onblur="validaEmail(frmCadastro.email);">
          </div>
          <div class="form-group col-md-8">
          <label >Data/Hora de Cadastro:</label>
          <input type="text" class="form-control" id="dataHora" name="dataHora" required readonly>
          </div>
          <label id="msgEmail"></label><br>
          <input type="submit" class="btn btn-secondary" name="cadastrar" id="cadastrar" value="Cadastrar" onclick=""><br>
        </form>
      </div>  
      <!-- Fim do Cadastro -->
    </center>	  
  </body>
</html>