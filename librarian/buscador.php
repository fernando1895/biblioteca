<?php
	require "../db_connect.php";
	require "../message_display.php";
	require "verify_librarian.php";
	require "header_librarian.php";
    ?>

<!DOCTYPE html>
<html>
<head>
    <title >Buscador de Datos</title>
    <link rel="stylesheet" type="text/css" href="../css/global_styles.css">
    <link rel="stylesheet" type="text/css" href="css/pending_book_requests_style.css">
</head>
<body>
    <h2>Buscador de Libros</h2>
    <form action="buscador.php" method="GET">
        <input type="text" name="termino_busqueda" placeholder="isbn | titulo | author | categoria">
        <input type="submit" value="Buscar">
    </form>
</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $termino_busqueda = $_GET['termino_busqueda'];

    // Preparar la consulta
    $sql = "SELECT * FROM book WHERE 
            isbn LIKE '%$termino_busqueda%' OR 
            title LIKE '%$termino_busqueda%' OR 
            author LIKE '%$termino_busqueda%' OR
            category LIKE '%$termino_busqueda%'";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // Conexión a la base de datos (código de conexión aquí)
echo "<h1 align='center'>Resultado de la búsqueda</h1>";
echo "<table width='100%' cellpadding=10 cellspacing=10>
						<tr>
							
							<th>ISBN<hr></th>
                            <th>Titulo<hr></th>
							<th>Autor<hr></th>
                            <th>Categoria<hr></th>
                            
						</tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td align='center'>". $row["isbn"] . "</td>";
            echo "<td align='center'>". $row["title"] . "</td>";
            echo "<td align='center'>". $row["author"] . "</td>";
            echo "<td align='center'>". $row["category"] . "</td>";
            
        
        }
    } else {
        echo "No se encontraron resultados para el término de búsqueda: $termino_busqueda";
    }
}

?>

