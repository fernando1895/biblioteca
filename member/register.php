<?php
	require "../db_connect.php";
	require "../message_display.php";
	require "../header.php";
?>

<html>
	<head>
		<title>Registro</title>
		<link rel="stylesheet" type="text/css" href="../css/global_styles.css">
		<link rel="stylesheet" type="text/css" href="../css/form_styles.css">
		<link rel="stylesheet" href="css/register_style.css">
	</head>
	<body>
		<form class="cd-form" method="POST" action="#">
			<legend>Ingresa tu información</legend>
			
				<div class="error-message" id="error-message">
					<p id="error"></p>
				</div>
				
				<div class="icon">
					<input class="m-user" type="text" name="m_user" id="m_user" placeholder="Usuario" required />
				</div>
				<div class="icon">
					<input class="m-pass" type="password" name="m_pass" placeholder="Contraseña" required />
				</div>
				<div class="icon">
					<input class="m-name" type="text" name="m_name" placeholder="Nombre Completo" required />
				</div>
				<div class="icon">
					<input class="m-documento" type="number" name="m_documento" placeholder="C.I." required />
				</div>
				<div class="icon">
					<input class="m-direccion" type="text" name="m_direccion" placeholder="Direccion" required />
				</div>
				<div class="icon">
					<input class="m-telefono" type="number" name="m_telefono" placeholder="Telefono" required />
				</div>
				<div class="icon">
					<input class="m-email" type="email" name="m_email" id="m_email" placeholder="Correo" required />
				</div>
				<div class="icon">
					<input class="m-balance" type="number" name="m_balance" id="m_balance" placeholder="Balance Inicial" required />
				</div>
				<br />
				<input type="submit" name="m_register" value="Registrarse" />
		</form>
	</body>
	<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
	<?php
		if(isset($_POST['m_register']))
		{
			if($_POST['m_balance'] < 100000)
				echo error_with_field("El Balance minimo que debe tener es de 100.000 Gs,", "m_balance");
			else
			{
				$query = $con->prepare("(SELECT username FROM member WHERE username = ?) UNION (SELECT username FROM pending_registrations WHERE username = ?);");
				$query->bind_param("ss", $_POST['m_user'], $_POST['m_user']);
				$query->execute();
				if(mysqli_num_rows($query->get_result()) != 0)
					echo error_with_field("El usuario ingresado ya fue dado de alta", "m_user");
				else
				{
					$query = $con->prepare("(SELECT email FROM member WHERE email = ?) UNION (SELECT email FROM pending_registrations WHERE email = ?);");
					$query->bind_param("ss", $_POST['m_email'], $_POST['m_email']);
					$query->execute();
					if(mysqli_num_rows($query->get_result()) != 0)
						echo error_with_field("Una cuenta ya fue registrada con este correo", "m_email");
					else
					{
						$query = $con->prepare("INSERT INTO pending_registrations(username, password, name, numero_ci, direccion, nro_telefono, email, balance) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
						$query->bind_param("sssssssd", $_POST['m_user'], sha1($_POST['m_pass']), $_POST['m_name'], $_POST['m_documento'], $_POST['m_direccion'], $_POST['m_telefono'], $_POST['m_email'], $_POST['m_balance']);
						if($query->execute())
							echo success("Sus datos seran validados y una vez realizado se lo notificara por correo");
						else
							echo error_without_field("No se puedieron obtener los registros. Por favor intente de nuevo");
					}
				}
			}
		}
		
	?>
	
</html>