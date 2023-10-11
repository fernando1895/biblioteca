<?php
	require "../db_connect.php";
	require "../message_display.php";
	require "verify_librarian.php";
	require "header_librarian.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Buscador de Libros</title>
</head>
<body>
    <h1>Buscador de Datos</h1>
    <form action="buscador.php" method="GET">
        <input type="text" name="Busqueda_autor" placeholder="Ingresa autor">
        <input type="submit" value="Buscar">
    </form>
</body>
</html>

<?php
//if ($_SERVER["REQUEST_METHOD"] == "GET") {
//    $termino_busqueda = $_GET['termino_busqueda'];
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Sanitizar y validar las entradas del usuario
        $nombre = isset($_GET['nombre']) ? mysqli_real_escape_string($conn, $_GET['nombre']) : '';
        $descripcion = isset($_GET['descripcion']) ? mysqli_real_escape_string($conn, $_GET['descripcion']) : '';
    // Preparar la consulta
    //$sql = "SELECT * FROM book WHERE title LIKE '%$Busqueda_autor%'";
    $sql = "SELECT * FROM book WHERE 1";
    if (!empty($nombre)) {
        $sql .= " AND title LIKE '%$nombre%'";
    }

    if (!empty($descripcion)) {
        $sql .= " AND isbn LIKE '%$descripcion%'";
    }
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Resultados de la búsqueda:</h2>";
        while($row = $result->fetch_assoc()) {
            echo "Nombre: " . htmlspecialchars($row["title"]) . ", Descripción: " . htmlspecialchars($row["isbn"]) . "<br>";
        }
    } else {
        echo "No se encontraron resultados para los términos de búsqueda proporcionados.";
    }
}
