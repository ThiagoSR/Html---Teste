<?php
  session_start();
  /*Verifica se está logado*/
  if ((!isset($_SESSION['LOGIN']) == true) and (!isset($_SESSION['SENHA']) == true)) {
    unset($_SESSION['LOGIN']);
    unset($_SESSION['SENHA']);
    header('location:Login.php');
  }
?>
<html>
  <head>
    <!-- Importações -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <!-- Fim das importações -->
    <link href="Style.css" rel="stylesheet">
    <title>Cadastro</title>
  </head>
  <body>
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
      <center>
      <div id="gerenciaEmail">
      <br>
      <!-- Pesquisa -->
      <form action="Gerenciamento.php" method="POST">
      <label id="labelFiltro">Filtro:</label>
        <div id="delimita">
          <input type="number"  class="form-control" name="codigoPesquisa" id="codigoPesquisa" maxlength="10" placeholder="Digite aqui o código a ser buscado:">
        </div><br>
        <div id="delimita">
          <input type="text"  class="form-control" name="emailPesquisa" id="emailPesquisa" maxlength="100" placeholder="Digite aqui o email a ser buscado:">
        </div><br>
        <div id="delimita">
          <input type="text"  class="form-control" name="nomePesquisa" id="nomePesquisa" maxlength="50" placeholder="Digite aqui o nome a ser buscado:">
        </div><br>
        <div id="delimita">
          <input type="text"  class="form-control" name="dataHoraPesquisa" id="dataHoraPesquisa" maxlength="19" placeholder="Digite aqui a data a ser buscado:">
        </div>   
        <br>
        <input type="submit"  class="btn btn-secondary" name="pesquisar" id="pesquisar" value="Pesquisar">
      </form>
      <!-- Fim da Pesquisa -->
      <label id="formatoDataHora">O formato da Data/Hora é AAAA-MM-DD HH:MM:SS.</label>
      <?php
        include 'Conexao.php';
        echo "<meta charset='utf-8'>";
        /*Verifica se o botão foi pressionado*/
        if(isset($_POST['pesquisar'])){
          
          $idPesquisa = $_POST['codigoPesquisa'];
          $emailPesquisa = $_POST['emailPesquisa'].'%';
          $nomePesquisa = $_POST['nomePesquisa'].'%';
          $dataHoraPesquisa = $_POST['dataHoraPesquisa'].'%';
          $wherePesquisa = "";
          $selectPesquisa = "SELECT id_email,nome_ema,email_ema,data_hora_ema FROM email WHERE 1=1 ";
          /*Verifica se o campo não está vazio*/
          if (!empty($idPesquisa)) {
            
            $wherePesquisa = $wherePesquisa." AND id_email = '$idPesquisa' ";
          
          } 
          if (!empty($emailPesquisa)) {
            
            $wherePesquisa = $wherePesquisa." AND email_ema like '$emailPesquisa' ";
          
          } 
          if (!empty($nomePesquisa)) {
            
            $wherePesquisa = $wherePesquisa." AND nome_ema like '$nomePesquisa' ";
          
          } 
          if (!empty($dataHoraPesquisa)) {
            
            $wherePesquisa = $wherePesquisa." AND data_hora_ema like '$dataHoraPesquisa' ";
          
          } 
          /*Cria a table*/ 
          echo"<table class='responstable'>";

          echo"<tr class='primeiro'><td class='primeiro'><b>Código</b></td><td class='primeiro'><b>Nome</b></td><td class='primeiro'><b>E-mail</b></td><td class='primeiro'><b>Data/Hora de Cadastro</b></td><td class='primeiro'><b>Gerenciamento</b></td></tr>";
          $verificaPesquisa = mysqli_query($mysqli,$selectPesquisa.$wherePesquisa);
          /*Cria 1 linha na tabela para cada item no banco*/
          while ($row = mysqli_fetch_assoc($verificaPesquisa)) {
      
            echo"<tr><td>".$row["id_email"]."</td><td>".$row["nome_ema"]."</td><td>".$row["email_ema"]."</td><td>".$row["data_hora_ema"]."</td><td><button type='submit' class='btn btn-secondary' onclick='mostraModalAltera(".$row["id_email"].");'>Alterar</button>   <button type='submit' class='btn btn-danger' onclick='mostraModalExclui(".$row["id_email"].");'>Excluir</button></td></tr>";

          }

          echo"</table>";

          }else{

            $selectPesquisa = "SELECT id_email,nome_ema,email_ema,data_hora_ema FROM email"; 
            echo"<table class='responstable'>";

            echo"<tr class='primeiro'><td class='primeiro'><b>Código</b></td><td class='primeiro'><b>Nome</b></td><td class='primeiro'><b>E-mail</b></td><td class='primeiro'><b>Data/Hora de Cadastro</b></td><td class='primeiro'><b>Gerenciamento</b></td></tr>";
            $verificaPesquisa = mysqli_query($mysqli,$selectPesquisa);
            /*Cria 1 linha na tabela para cada item no banco*/
            while ($row = mysqli_fetch_assoc($verificaPesquisa)) {
      
              echo"<tr><td>".$row["id_email"]."</td><td>".$row["nome_ema"]."</td><td>".$row["email_ema"]."</td><td>".$row["data_hora_ema"]."</td><td><button type='submit' class='btn btn-secondary' onclick='mostraModalAltera(".$row["id_email"].");'>Alterar</button>   <button type='submit' class='btn btn-danger' onclick='mostraModalExclui(".$row["id_email"].");'>Excluir</button></td></tr>";

            }
            echo"</table>";
          } 
      ?>
      
      <br>
      </div> 
      
      <script type="text/javascript">
        function mostraModalAltera(id){
          action = 'AjaxNome.php';
          var par = 'id='+id;
          /*Chama o Ajax para atualizar dados do Modal de alteração*/
          $.ajax({
            type : "POST",
            url : action,
            data : par,
            beforeSend: function(){
              document.getElementById('alteraNome').value = 'Aguarde...';
            },
            success: function(txt){
              document.getElementById('alteraNome').value = txt;
            },
            error: function(){
              document.getElementById('alteraNome').value = 'Erro!';
            },
          });
          action2 = 'AjaxEmail.php';
          var par2 = 'id='+id;
          $.ajax({
            type : "POST",
            url : action2,
            data : par2,
            beforeSend: function(){
              document.getElementById('alteraEmail').value = 'Aguarde...';
            },
            success: function(txt){
              document.getElementById('alteraEmail').value = txt;
            },
            error: function(){
              document.getElementById('alteraEmail').value = 'Erro!';
            },
          });
          action3 = 'AjaxData.php';
          var par3 = 'id='+id;
          $.ajax({
            type : "POST",
            url : action3,
            data : par3,
            beforeSend: function(){
              document.getElementById('alteraData').value = 'Aguarde...';
            },
            success: function(txt){
              document.getElementById('alteraData').value = txt;
            },
            error: function(){
              document.getElementById('alteraData').value = 'Erro!';
            },
          });          
          document.getElementById('alteraId').value = id;
          $("#modalAltera").modal('show');
        }
        function mostraModalExclui(id){
          /*Altera os dados do Modal de exclusão*/
          document.getElementById('excluiId').value = id;
          $("#modalExclui").modal('show');
        }
        function validaEmail(field){
          antes = field.value.substring(0, field.value.indexOf("@"));
          depois = field.value.substring(field.value.indexOf("@")+ 1, field.value.length);
          /*Verifica se o e-mail é valido*/
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

          }else{
            document.getElementById("msgEmail").innerHTML ="E-mail inválido";
            document.getElementById("msgEmail").style.border ="1px solid #cc0000";
            document.getElementById("msgEmail").style.borderRadius ="5px";
            /*Previne o Submit*/
            event.preventDefault();
          }
      }
    </script>
      </script>
      <!-- Modais -->
      <div class="modal fade" id="modalAltera" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #555">
              <h5 class="modal-title" id="titulo" style="color: white;">Alteração de E-mail</h5>
            </div>
            <div class="modal-body">
              <form method="POST" action="AlteraEmail.php" name="altera" id="altera">
                Nome:
                <input type="text" name="alteraNome" id="alteraNome" class="form-control"><br>
                E-mail:
                <input type="email" name="alteraEmail" id="alteraEmail" class="form-control" onblur="validaEmail(altera.alteraEmail)"><br>
                Data/Hora de cadastro:
                <input type="text" name="alteraData" id="alteraData" class="form-control" readonly>
                <input type="text" name="alteraId" id="alteraId" class="form-control" style="display: none;">
              
            </div>
            <div class="modal-footer" style="background-color: #555;">
              <label id="msgEmail"></label>
              <button type="button" class="btn btn-secondary" style="color: #555" data-dismiss="modal">Fechar</button>
              <button type="submit" class="btn btn-secondary" id="alterar" name="alterar" style="color: #555">Salvar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
 

      <center><div class="modal fade" id="modalExclui" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <center>
              <h5 class="modal-title" id="exampleModalLongTitle">Deseja realmente excluir o e-mail:</h5>
              <form method="POST" action="excluiEmail.php">
                <input type="text" name="excluiId" id="excluiId" class="form-control" style="display: none;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                <button type="submit" name="excluir" id="excluir" class="btn btn-danger">Sim</button>
              </form>
            </center>
          </div>
        </div>
      </div></center>
     <!-- Fim dos modais-->
    </center>	  
  </body>
</html>