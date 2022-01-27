<?php

require_once 'config.php';
require_once 'models/Auth.php';
require_once 'dao/UserDaoMysql.php';


$auth = new Auth( $pdo, $base );

$userInfo = $auth->checkToken();

$userDao = new UserDaoMysql ( $pdo );

$name = filter_input ( INPUT_POST, 'name' );
$email = filter_input ( INPUT_POST, 'email', FILTER_VALIDATE_EMAIL );
$birthdate = filter_input ( INPUT_POST, 'birthdate' );
$city = filter_input ( INPUT_POST, 'city' );
$work = filter_input ( INPUT_POST, 'work' );
$password = filter_input ( INPUT_POST, 'password' );
$password_confirmation = filter_input ( INPUT_POST, 'password_confirmation' );

if ( $name && $email ) {

  $userInfo->name = $name;
  $userInfo->city = $city;
  $userInfo->work = $work;

  //email

  if ( $userInfo->email != $email ) {

    if ( $userDao->findByEmail ( $email ) === false ) {

      $userInfo->email = $email;

    } else {

      $_SESSION['flash'] = 'E-mail já exite!';
      header ( "Location: ".$base."/configuracao.php" );
      exit;

    }

  }

  //birthdate

  $birthdate = explode( '/', $birthdate ); 
 
  if ( count($birthdate) != 3 ) {

    $_SESSION['flash'] = 'Data De Nascimento é Inválida!';
    header( "Location: ".$base."/configuracao.php" );
    exit;

  }

  $birthdate = $birthdate[ 2 ].'-'.$birthdate[ 1 ].'-'.$birthdate[ 0 ];

  if ( strtotime( $birthdate ) === false ) {

    $_SESSION['flash'] = 'Campos não Enviados!';
    header( "Location: ".$base."/configuracao.php" );
    exit;

  }

  // password

  if ( !empty ( $password ) ) {

    if ( $password === $password_confirmation ) {

      $hash = password_hash ( $password, PASSWORD_DEFAULT );
      $userInfo->password = $hash;

    } else {

      $_SESSION [ 'flash' ] = 'senhas não batem.';
      header ( "Location: ".$base."/configuracao.php" );
      exit;

    }

  }
  
  
  $userDao->update ( $userInfo );

}

header ( "Location: ".$base."/configuracao.php" );
exit;

