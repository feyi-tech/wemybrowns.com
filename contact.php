<?php
	require_once('recaptchalib.php');

	$env = parse_ini_file('.env');
	$recaptchaCode = $_POST['g-recaptcha-response'];

	//echo "<p>ENV_TEST: ".$env["ENV_TEST"]."</p><br/>";
	//echo "<p>recaptcha: ".$recaptchaCode."</p><br/>";

	$recaptcha = new ReCaptcha($env["RECAPTCHA_SECRET_KEY"]); 
	$recaptcha = $recaptcha->verifyResponse($_SERVER['REMOTE_ADDR'], $recaptchaCode); 

	//print_r($recaptcha);
	
	if(!$recaptcha->success){ 
		// Failed
		echo "recaptcha failed!";

	} else if (isset($_POST['email'])) {

		// EDIT THE 2 LINES BELOW AS REQUIRED
		$email_to = "hello@wemybrowns.com";
		$email_subject = "My offer for wemybrowns.com";


		$name = $_POST['name']; // required
		$email_from = $_POST['email']; // required
		$telephone = $_POST['phone']; // not required
		$price = $_POST['price']; // not required
		$comments = $_POST['comments']; // required


		$email_message = "Form details below.\n\n";

		function clean_string($string) {
				$bad = array("content-type", "bcc:", "to:", "cc:", "href");
				return str_replace($bad, "", $string);
		}

		$email_message .= "Name: " . clean_string($name) . "\n";
		$email_message .= "Email: " . clean_string($email_from) . "\n";
		$email_message .= "Telephone: " . clean_string($telephone) . "\n";
		$email_message .= "Price($): " . clean_string($price) . "\n";
		$email_message .= "Comments: " . clean_string($comments) . "\n";

		// create email headers
		$headers = 'From: ' . $email_from . "\r\n" .
						'Reply-To: ' . $email_from . "\r\n" .
						'X-Mailer: PHP/' . phpversion();

		@mail($email_to, $email_subject, $email_message, $headers);

?>
<!DOCTYPE html>
<html lang="en">
		<head>
				<meta charset="utf-8">
				<title>Sales Inquery || wemybrowns</title>
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
				<link href="https://fonts.googleapis.com/css?family=Mukta+Mahee:300,700" rel="stylesheet">
				<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
				<link rel="stylesheet" href="css/style.css" />
		</head>
		<body>
			<section class="bg-alt hero p-0">
				<div class="container-fluid">
					<div class="row">
							<div class="bg-faded col-sm-6 text-center col-fixed">
									<div class="vMiddle">
										<h1 class="pt-4 h2">
											<span>Thanks for the offer. I will contact you as soon as possible. Cheers !!!</span>
										</h1>
										<div class="row d-md-flex text-center justify-content-center text-primary action-icons">
											<div class="col-sm-4">
												<p><em class="ion-ios-telephone-outline icon-md"></em></p>
												<p class="lead"><a href="tel:+2348130729216">+234-813-0729-216</a></p>
											</div>
											<div class="col-sm-4">
												<p><em class="ion-ios-chatbubble-outline icon-md"></em></p>
												<p class="lead"><a href="mailto:hello@example.com">hello@wemybrowns.com</a></p>
											</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 offset-sm-6">
									<section class="bg-alt">
											<div class="row height-100">
													<div class="col-sm-8 offset-sm-2 mt-2">
														<h1 class="pt-4 h2"><span class="text-green">Elijah Adegoke</span></h1>
														<span class="text-muted">Lagos, Nigeria</span>
														<p><span>Domain name expert, Software Engineer, DevOps.</span></p>
														<br/>
														<a target="_blank" rel="nofollow" href="https://feyitech.com" class="d-none">feyitech.com</a>
													</div>
											</div>
									</section>
							</div>
					</div>
				</div>
			</section>
		</body>
</html>
<?php } ?>