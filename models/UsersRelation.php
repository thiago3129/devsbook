<?php

class UsersRelation {
  
  public $id;
  public $user_from;
  public $user_to;
 

}

interface UsersRelationDAO {

  public function insert ( UsersRelation $u );
  public function delete ( UsersRelation $u );
  public function getFollowing ( $id );
  public function getFollowers ( $id );
  public function isFollowing ( $id1, $id2 );


}