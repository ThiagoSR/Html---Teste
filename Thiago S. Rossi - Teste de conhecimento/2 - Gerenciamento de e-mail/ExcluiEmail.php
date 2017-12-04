<?php
  include 'Conexao.php';
  $id       = $_POST['excluiId'];
  $sql      = "DELETE FROM `email` WHERE `id_email` = '$id'";
  $query    = mysqli_query($mysqli,$sql);
  /*Verifica se a atualização foi feita com sucesso*/
  if ($query) {
  	echo"<script language='javascript' type='text/javascript'>alert('Excluido com sucesso!!'); window.location='Gerenciamento.php';</script>";
  }

?>