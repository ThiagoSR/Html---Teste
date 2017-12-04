<html>
  <head>
    <link href="Style.css" rel="stylesheet">
    <title>1 ao 100</title>
  </head>
  <body>
    <center>
      Contagem 1 - 100:<br><br>
      <table>
  	    <?php
          for ($i=1;$i<101;$i++){
          	if(($i%3==0) and ($i%5==0)){
          	  echo "<td class='trescinco'><center>Três Cinco</center></td></tr>";
          	}elseif($i%3==0){
              echo "<td class='tres'><center>Três</center></td>";
          	}elseif($i%5==0){
              echo "<td class='cinco'><center>Cinco</center></td></tr>";
          	}else{
          	  echo "<td><center>".$i."</center></td>"; 	
          	}
          }
  	    ?>
  	  </table>
    </center>	  
  </body>
</html>