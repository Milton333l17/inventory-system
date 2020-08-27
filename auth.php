<?php 
include_once('controller/load.php');
$req_fields = array('documento', 'password' );
validate_fields($req_fields);
$username = remove_specials($_POST['documento']);
$password = remove_specials($_POST['password']);

if(empty($errors)){
  $user_id = authenticate($username, $password);
  if($user_id){
        //Crea la sesión con el id
        $session->login($user_id);
            
        $session->msg("s", "Bienvenido!");
        redirect('form.php',false);
  }else{
    $session->msg("d", "Documento y/o contraseña incorrecto.".$user_id);
    redirect('login.php', false);
  }
}else{
   $session->msg("d", $errors);
   redirect('login.php', false);
}