<?php

require_once 'models/Post.php';
require_once 'dao/UsersRelationDaoMysql.php';
require_once 'dao/UserDaoMysql.php';
require_once 'dao/PostLikeDaoMysql.php';


class PostDaoMysql implements PostDao {

  private $pdo;

  public function __construct ( PDO $driver ) {

    $this->pdo = $driver;

  }

  public function insert ( Post $p ) {

    $sql = $this->pdo->prepare ( 'INSERT INTO posts (

      id_user, type, created_at, body

    ) VALUES (

      :id_user, :type, :created_at, :body

    )' );
    $sql->bindValue ( ':id_user', $p->id_user );
    $sql->bindValue ( ':type', $p->type );
    $sql->bindValue ( ':created_at', $p->created_at );
    $sql->bindValue ( ':body', $p->body );
    $sql->execute ();

  }

  public function getUserFeed ( $id_user ) {

    $array = [];

    
    $sql = $this->pdo->prepare ( "SELECT * FROM posts
    WHERE id_user = :id_user
    ORDER BY created_at DESC" );
    $sql->bindValue ( ":id_user", $id_user );
    $sql->execute ();

    if ( $sql->rowCount () > 0 ) {
      $data = $sql->fetchAll ( PDO::FETCH_ASSOC );
      
      $array = $this->_postListToObject ( $data, $id_user );
    } 

      return $array;

 

  }

  public function getPhotosFrom ( $id_user ) {

    $array = [];

    $sql = $this->pdo->prepare ( "SELECT * FROM posts
    WHERE id_user = :id_user AND type 'photo'
    ORDER BY create_at DESC" );

    $sql->bindValue ( ':id_user', $id_user );
    $sql->execute ();

    if ( $sql->rowCount () > 0 ) {

      $data = $sql->fetchAll ( PDO::FETCH_ASSOC );
      $array = $this->_postListToObject ( $data, $id_user );

    }

    return $array;

  }


  public function getHomeFeed ( $id_user ) {

    $array = [];

    //1 - Lista dos usuários que eu sigo.
    $urDao = new UsersRelationDaoMysql ( $this->pdo );
    $userList = $urDao->getFollowing ( $id_user );
    $userList[] = $id_user;


    //2 - Pegar os Posts ordenados pela data.
    $sql = $this->pdo->query ( "SELECT * FROM posts
    WHERE id_user IN ( ".implode ( ',', $userList )." ) 
    ORDER BY created_at DESC" );

    if ( $sql->rowCount () > 0 ) {
      $data = $sql->fetchAll ( PDO::FETCH_ASSOC );
      //3 - Transformar o resultado em objetos.
      $array = $this->_postListToObject ( $data, $id_user );
    } 

      return $array;

 

  }

  private function _postListToObject ( $post_list, $id_user ) {

    $posts = [];
    $userDao = new UserDaoMysql ( $this->pdo );
    $postLikeDao = new PostLikeDaoMysql ( $this->pdo );

    foreach ( $post_list as $post_item ) {

      $newPost = new Post ();
      
      $newPost->id = $post_item[ 'id' ];
      $newPost->type = $post_item[ 'type' ];
      $newPost->created_at = $post_item[ 'created_at' ];
      $newPost->body = $post_item[ 'body' ];
      $newPost->mine = false;

      if ( $post_item[ 'id_user' ] == $id_user ) {

        $newPost->mine = true;

      }

      //pegar informações do usuário
      $newPost->user = $userDao->findById ( $post_item[ 'id_user' ] );

      //informações sobre LIKE
      $newPost->likeCount = $postLikeDao->getLikeCount ( $newPost->id );
      $newPost->liked = $postLikeDao->isLiked ( $newPost->id, $id_user );


      //informações sobre COMMENTS
      $newPost->comments = [];

      $posts[] = $newPost;

    }


    return $posts;

  }
}

