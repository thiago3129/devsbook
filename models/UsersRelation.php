<?php

class UsersRelation {
  
  public $id;
  public $user_from;
  public $user_to;
 

}

interface UsersRelationDAO {

  public function insert ( UsersRelation $u );
  public function getRelationsFrom ( $id );


}