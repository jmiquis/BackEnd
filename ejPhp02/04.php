<!-- Realizar un programa en php que genere 50 números aleatorios en 1 y 100 y que muestre en una tabla  html el valor máximo, el mínimo y la media con el siguiente formato:
  Nota definir los valores 50 y 100 como constantes en PHP (define) -->

  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <?php require_once('funcionesvar.php');?>
      <style>
          table,td,tr{
              border: 1px solid black;
              border-collapse: collapse;
          }
          th{
              background-color: black;
              color: white;
          }
      </style>
  </head>
  <body>
        <table>
            <th colspan="2">generacion 50 valores aleatorios</th>

                <?php for ($i=0; $i <count($arrayNombres) ; $i++):?>
                    <tr>
                        <td><?= $arrayNombres[$i]?></td>
                        <td><?= $arrayNumeros[$i]?></td>
                    </tr>
                <?php endfor ?>
        </table>
  </body>
  </html>