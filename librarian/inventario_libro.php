<?php
	require "../db_connect.php";
	require "../message_display.php";
	require "verify_librarian.php";
	require "header_librarian.php";
?>
<html>
	<head>
		<title>Inventario de Libros</title>
		<link rel="stylesheet" type="text/css" href="../css/global_styles.css">
		<link rel="stylesheet" type="text/css" href="css/home_style.css">
		<link rel="stylesheet" type="text/css" href="../css/custom_radio_button_style.css">
	</head>
	<body>
		<?php
			$query = $con->prepare("SELECT * FROM book ORDER BY title");
			$query->execute();
			$result = $query->get_result();
			if(!$result)
				die("ERROR: Couldn't fetch books");
			$rows = mysqli_num_rows($result);
			if($rows == 0)
				echo "<h2 align='center'>No hay libros disponibles</h2>";
			else
			{
				echo "<form class='cd-form' method='POST' action='#'>";
				echo "<h2 legend align='center'>Libros disponibles</legend>";
				echo "<div class='error-message' id='error-message'>
						<p id='error'></p>
					</div>";
				echo "<table width='100%' cellpadding=10 cellspacing=10>";
				echo "<tr>
						<th></th>
						<th>ISBN<hr></th>
						<th>Título<hr></th>
						<th>Autor<hr></th>
						<th>Categoría<hr></th>
						<th>Precio<hr></th>
						<th>Copias Disponibles<hr></th>
					</tr>";
				for($i=0; $i<$rows; $i++)
				{
					$row = mysqli_fetch_array($result);
					echo "<tr align='center'> <td>
					
					
				</td>";
					for($j=0; $j<6; $j++)
						if($j == 4)
							echo "<td>".$row[$j]." Gs.</td>";
						else
							echo "<td>".$row[$j]."</td>";
					echo "</tr>";
				}
				//echo "</table>";
				//echo "<br /><br /><input type='submit' name='m_request' value='Solicitar libro' />";
				//echo "</form>";
			}
		?>