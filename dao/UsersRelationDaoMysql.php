<?php

require_once './models/UsersRelation.php';

class UsersRelationDaoMysql implements UsersRelationDAO {

  private $pdo;

  public function __construct(PDO $driver) {
    $this->pdo = $driver;
  }

  public function insert ( UsersRelation $u ) {

  }


  public function getFollowing ( $id ){

    $users = [];

    $sql = $this->pdo->prepare ( "SELECT user_to FROM userrelation 
    WHERE user_from = :user_from" );

    $sql->bindValue ( ':user_from', $id );
    $sql->execute ();

    if ( $sql->rowCount () > 0 ) {

      $data = $sql->fetchAll ();
      
      foreach ( $data as $item ) {

        $users[] = $item[ 'user_to' ];

      }

    }

    return $users;

  }

  public function getFollowers ( $id ){

    $users = [];
    $sql = $this->pdo->prepare ( "SELECT user_from FROM userrelation 
    WHERE user_to = :user_to" );

    $sql->bindValue ( ':user_to', $id );
    $sql->execute ();

    if ( $sql->rowCount () > 0 ) {

      $data = $sql->fetchAll ();
      
      foreach ( $data as $item ) {

        $users[] = $item[ 'user_from' ];

      }

    }

    return $users;

  }

}