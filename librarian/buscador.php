<?php
	require "../db_connect.php";
	require "verify_librarian.php";
	require "header_librarian.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title >Buscador de Datos</title>
</head>
<body>
    <h1 align='center'>Buscador de Datos</h1>
    <form action="buscador.php" method="GET">
        <input type="text" name="termino_busqueda" placeholder="isbn | titulo | author | categoria">
        <input type="submit" value="Buscar">
    </form>
</body>
</html>

<?php
// Conexión a la base de datos (código de conexión aquí)

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
        echo "<h2 align='center'>Resultados de la búsqueda:</h2>";
        while($row = $result->fetch_assoc()) {
            echo "ISBN: " . $table["isbn"] . ", Titulo: " . $table["title"] . " , Autor " . $table["author"] . " , Categoria: " . $table["category"] . "<br>";
        }
    } else {
        echo "No se encontraron resultados para el término de búsqueda: $termino_busqueda";
    }
}

?>

