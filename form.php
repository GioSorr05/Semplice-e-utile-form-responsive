<?php

@extract($_POST);
$sub = "Messaggio di: ". stripslashes($nome)." ". stripslashes($cognome);
$nome= stripslashes($nome);
$cognome= stripslashes($cognome);
$fromail= stripslashes($email);
$tel= stripslashes($tel);
$messaggio= stripslashes($messaggio);
$headers = "From: ".$fromail;
$message="Nome e Cognome: ".$nome." ". $cognome."\n"."Telefono: ".$tel."\n"."Messaggio: ".$messaggio."\n";
//Codici per il Recaptcha
$response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=&response='.$_POST['g-recaptcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR']);
$responseDecoded  = json_decode($response);



if(!is_numeric($tel)){
    echo "<script> alert('Inserisci un numero di telefono valido!')</script>";
}



if ( $responseDecoded->success == false ) {
  echo "Compila il reCAPTCHA!";
  exit();
}
else{
mail('tuaemail@dominio.com', $sub, $message, $headers);
echo  "<script> alert('Grazie per averci contattato!')</script>";
}


?>
