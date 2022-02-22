<?php

class Post {
  
  public $id;
  public $id_user;
  public $type; //text / photos
  public $created_at;
  public $body;
  

}

interface PostDao {

  public function insert( Post $p );
  public function delete($id, $id_user);
  public function getUserFeed ( $id_user );
  public function getHomeFeed ( $id_user );
  public function getPhotosFrom ( $id_user );

}