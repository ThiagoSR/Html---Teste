<?php
  include 'Conexao.php';
  $id    = $_POST['id'];
  $sql   = "SELECT email_ema FROM email WHERE id_email = '$id' ";
  $query = mysqli_query($mysqli,$sql);
  /*Verifica se retornou 1 resultado*/
  if (mysqli_num_rows($query)==1){
    /*Um loop que manda as informações para a requisição feita pelo ajax*/
    while ($row = mysqli_fetch_assoc($query)) {
      
      echo $row['email_ema'];

    }

  } 
?>