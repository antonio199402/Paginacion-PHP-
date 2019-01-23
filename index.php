<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


<?php


$conexion= new PDO("mysql: host=localhost; dbname=curso_sql", "root", "");

$tamano_pagina=5;
$pagina=1;



if (isset($_GET["pagina"])){

if($_GET["pagina"]==1){


	header("location:index.php");
}else {


$pagina=$_GET["pagina"];

}




}

else{

	$pagina=1;
}

$empezar_desde=($pagina-1)*$tamano_pagina;




$sql_total="SELECT NOMBREARTICULO, SECCION, PRECIO, PAISDEORIGEN FROM PRODUCTOS WHERE SECCION= 'DEPORTES '";

$resultado=$conexion->prepare($sql_total);

$resultado->execute(array());

$num_fila=$resultado->rowCount();

$total_paginas=ceil($num_fila/$tamano_pagina);

echo "Numero de registros de la consulta " . $num_fila . "<br>";

echo "Mostramos" . $tamano_pagina . "registros por pagina <br>";

echo "Mostrando la pagina" . $pagina . "de" . $total_paginas . "<br>"; 




$sql_limite="SELECT NOMBREARTICULO, SECCION, PRECIO, PAISDEORIGEN FROM PRODUCTOS WHERE SECCION= 'DEPORTES ' LIMIT $empezar_desde, $tamano_pagina";

$resultado=$conexion->prepare($sql_limite);

$resultado->execute(array());


while($registro=$resultado->fetch(PDO:: FETCH_ASSOC)){

echo "Nombre Articulo". $registro["NOMBREARTICULO"] . "Seccion" . $registro["SECCION"], "Precio" . $registro["PRECIO"] . "Pais de origen" . $registro["PAISDEORIGEN"] . "<br>";



}



/*-------------------PAGINACION----------------------------*/



for($pagina=1; $pagina<=$total_paginas; $pagina++){

echo  "<a href = '?pagina=$pagina' >$pagina</a> ";


}




?>


</body>
</html>