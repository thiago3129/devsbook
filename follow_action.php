<?php

require_once 'config.php';
require_once 'models/Auth.php';
require_once 'dao/UsersRelationDaoMysql.php';
require_once 'dao/UserDaoMysql.php';

$auth = new Auth ( $pdo, $base );
$userInfo = $auth->checkToken ();

$id = filter_input ( INPUT_GET, 'id' );

if ( $id ) {

 $userRelationDao = new UsersRelationDaoMysql ( $pdo );
 $userDao = new UserDaoMysql ( $pdo );

    if ( $userDao->findById ( $id ) ) {
      
      $relation = new UsersRelation ();

      $relation->user_from = $userInfo->id;
      $relation->user_to = $id;

      if ( $userRelationDao->isFollowing ( $userInfo->id, $id ) ) {

        //unfollow
        $userRelationDao->delete ( $relation );

      } else {

        //follow
        $userRelationDao->insert ( $relation );

      }

      header ( "Location: perfil.php?id=".$id );
      exit;

    }

}

  header ( "Location: ".$base );
  exit;

