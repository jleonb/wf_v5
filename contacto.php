<?php
  $email;$comment;$captcha;
    if(isset($_POST['name'])){
      $nombre=$_POST['name'];
       }if(isset($_POST['telefono'])){
   $telefono=$_POST['telefono'];
 }if(isset($_POST['email'])){
$email=$_POST['email'];
 }if(isset($_POST['comments'])){
   $comments=$_POST['comments'];
 }if(isset($_POST['g-recaptcha-response'])){
   $captcha=$_POST['g-recaptcha-response'];
 }
 if(!$captcha){
   echo 'Errores en el formulario, por favor vuelva e intentelo denuevo.';
   exit;
 }
 $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeilBQUAAAAABh3afkSjsCDJr3otAhm3kgDhfR8&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);

if(isset($_POST['email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "jleon@webframe.cl";
    $email_subject = "CONTACTO - WEBFRAME";

    function died($error) {
        // your error code can go here
        echo "Lo sentimos, hemos encontrado un error. ";
        echo $error."<br /><br />";
        die();
    }



    $nombre = $_POST['name']; // required
    $telefono = $_POST['telefono']; // required
    $email = $_POST['email']; // required
    $comments = $_POST['comments']; // required


    $email_message = "Los datos del interesado son:\n\n";

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    $email_message .= "Nombre: ".clean_string($nombre)."\n";
    $email_message .= "Teléfono: ".clean_string($telefono)."\n";
    $email_message .= "Correo: ".clean_string($email)."\n\n";
    $email_message .= "Comentario: ".clean_string($comments)."\n";

// create email headers
$headers = 'From: '.$email."\r\n".
'Reply-To: '.$email."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
sleep(2);
echo "<meta http-equiv='refresh' content=\"0; url=./index.html\">";
} ?>
