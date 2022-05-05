<?php 

	use PHPMailer\PHPMailer\PHPMailer;
				
	require_once '../PHPMailer/src/PHPMailer.php';
	require_once '../PHPMailer/src/SMTP.php';
	require_once '../PHPMailer/src/Exception.php';


	if(isset($_POST["correoSolicitante"])) {

		$nombreSolicitante = '';
		$edadSolicitante = '';
		$ocupacionSolicitante = '';
        $telefonoSolicitante = '';
		$correoSolicitante = '';
		$metodoSolicitante = '';
		$asuntoSolicitante = '';

		$nombreSolicitante_error = '';
		$edadSolicitante_error = '';
		$ocupacionSolicitante_error = '';
        $telefonoSolicitante_error = '';
		$correoSolicitante_error = '';
		$metodoSolicitante_error = '';
        $asuntoSolicitante_error = '';
		$captcha_error = '';

		if(empty($_POST["nombreSolicitante"])) {
			$nombreSolicitante_error = 'El nombre es requerido';
		}
		else {
			$nombreSolicitante = $_POST["nombreSolicitante"];
		}

		if(empty($_POST["edadSolicitante"])) {
			$edadSolicitante_error = 'La edad es requerida';
		}
		else {
			$edadSolicitante = $_POST["edadSolicitante"];
		}

		if(empty($_POST["ocupacionSolicitante"])) {
			$ocupacionSolicitante_error = 'La ocupación es requerida';
		}
		else {
			$ocupacionSolicitante = $_POST["ocupacionSolicitante"];
		}

        if(empty($_POST["telefonoSolicitante"])) {
			$telefonoSolicitante_error = 'El telefono es requerido';
		}
		else {
			$telefonoSolicitante = $_POST["telefonoSolicitante"];
		}

		if(empty($_POST["correoSolicitante"])) {
			$correoSolicitante_error = 'El email es requerido';
		}
		else {
			if(!filter_var($_POST["correoSolicitante"], FILTER_VALIDATE_EMAIL)) {
				$correoSolicitante_error = 'Email invalido, intenta de nuevo';
			}
			else {
				$correoSolicitante = $_POST["correoSolicitante"];
			}
		}
		
		if(empty($_POST["metodoSolicitante"])) {
			$metodoSolicitante_error = 'Debes seleccionar ';
		}
		else {
			$metodoSolicitante = $_POST["metodoSolicitante"];
		}

		if(empty($_POST["asuntoSolicitante"])) {
			$asuntoSolicitante_error = 'El asunto es requerido';
		}
		else {
			$asuntoSolicitante = $_POST["asuntoSolicitante"];
		}

		if(empty($_POST['g-recaptcha-response'])) {
			$captcha_error = 'Debes completar el Captcha';
		}
		else {
			$captcha = $_POST['g-recaptcha-response'];
			$secret_key = '6Lc-N4ofAAAAAJmjq5Jy43NE94H8EPHQd1CZvKGr';
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$captcha");
			$response_data = json_decode($response, TRUE);
			$error = json_encode($response_data);

			if(!$response_data['success']) {
				$captcha_error = $error;
			}
		}
		
		if($nombreSolicitante_error == '' && $edadSolicitante_error == '' && $ocupacionSolicitante_error == '' && $telefonoSolicitante_error == '' && $correoSolicitante_error == '' && $metodoSolicitante_error == '' && $asuntoSolicitante_error == '' && $captcha_error == '') {
			// var_dump('4');
			$nombreSoli = $_POST['nombreSolicitante'];
			$edadSoli = $_POST['edadSolicitante'];
			$ocupacionSoli = $_POST['ocupacionSolicitante'];
            $telefonoSoli = $_POST['telefonoSolicitante']; 
			$correoSoli = $_POST['correoSolicitante'];
			$metodoSoli = $_POST['metodoSolicitante'];
            $asuntoSoli = $_POST['asuntoSolicitante'];

			// refacciones@grupovanguardia.com
			$correo = 'imojica@galletamkt.com';
			$arrayAddresses = ''.$correo.','.'patricianl58@hotmail.com';
			
			date_default_timezone_set("America/Mexico_City");
			$fecha = date('d/m/Y');
			$hora = date('H:i');

			$mail = new PHPMailer(true);		
			$mail->isSMTP();
			//$mail->isMail();
			$mail->SMTPDebug = 0;		
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Host = 'smtp.ionos.mx';
			$mail->Port = '587';
			
			$mail->Username = 'egutierrez@galletamkt.com';
			$mail->Password = 'GalletaMKT77%';

			$mail->setFrom('Landing@patricianavarro.com','Nuevo prospecto de registro');

			// $mail->AddAddress('egutierrez@galletamkt.com');
			// $mail->AddCC('erick.e.gutierrez.mendoza20@gmail.com');
			$addresses = explode(',', $arrayAddresses);
			foreach ($addresses as $address) {
				$mail->AddAddress($address);
			}
			//$mail->WordWrap = 50;
	
			$mail->IsHTML(true);
			$mail->CharSet = 'UTF-8';
			$mail->Subject = 'Solicitud de '.$nombreSoli.'';
			$mail->Body = '
			<h3 align="center">Detalles del prospecto</h3>
			<p>Fecha y hora de contacto: '.$fecha.' '.$hora.'</p>
			<table border="1" width="100%" cellpadding="5" cellspacing="5">
				<tr>
					<td width="30%">Nombre</td>
					<td width="70%">'.$nombreSoli.'</td>
				</tr>
				<tr>
					<td width="30%">Edad</td>
					<td width="70%">'.$edadSoli.'</td>
				</tr>
				<tr>
					<td width="30%">Ocupacion</td>
					<td width="70%">'.$ocupacionSoli.'</td>
				</tr>
                <tr>
					<td width="30%">Teléfono</td>
					<td width="70%">'.$telefonoSoli.'</td>
				</tr>
				<tr>
					<td width="30%">Correo</td>
					<td width="70%">'.$correoSoli.'</td>
				</tr>
				<tr>
					<td width="30%">Medio para comunicarse</td>
					<td width="70%">'.$metodoSoli.'</td>
				</tr>
				<tr>
					<td width="30%">¿Qué quieres conseguir con este trabajo?</td>
					<td width="70%">'.$asuntoSoli.'</td>
				</tr>
			</table>
			';

			if($mail->send()) {
				$data = array(
					'success' => true
				);
			}
			else {
				$data = array(
					'success' => false
				);
			}
		}
		else {
			$data = array(
				'nombreSolicitante_error' => $nombreSolicitante_error,
				'edadSolicitante_error' => $edadSolicitante_error,
				'ocupacionSolicitante_error' => $ocupacionSolicitante_error,
                'telefonoSolicitante_error'  => $telefonoSolicitante_error,
				'correoSolicitante_error' => $correoSolicitante_error,
				'metodoSolicitante_error' => $metodoSolicitante_error,
                'asuntoSolicitante_error' => $asuntoSolicitante_error,
				'captcha_error'  => $captcha_error
			);
		}
		echo json_encode($data);
	}

?>