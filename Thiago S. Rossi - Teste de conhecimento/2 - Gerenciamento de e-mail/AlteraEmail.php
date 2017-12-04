<?php
  include 'Conexao.php';
  $id       = $_POST['alteraId'];
  $email    = $_POST['alteraEmail'];
  $nome     = $_POST['alteraNome'];
  $data     = $_POST['alteraData'];
  $sql      = "UPDATE `email` SET `nome_ema`='$nome', `email_ema`='$email', `data_hora_ema` = '$data' WHERE `id_email`='$id' ";
  $query    = mysqli_query($mysqli,$sql);
  /*Verifica se a atualização foi feita com sucesso*/
  if ($query) {
  	echo"<script language='javascript' type='text/javascript'>alert('Alterado com sucesso!!'); window.location='Gerenciamento.php';</script>";
  }

?>