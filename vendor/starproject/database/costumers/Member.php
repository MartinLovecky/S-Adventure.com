<?php

namespace starproject\database\costumers;

use \starproject\database\DB;
use \starproject\tools\Selector;
use starproject\database\costumers\Password;

class Member extends Password{

    private $_db,$_query;
    public $username = 'visitor',$role = 'none',$permit = 'read';
    protected $memberID;

    public function __construct(DB $db,Selector $selector){
        $this->_db = $db->con();    
        $this->_query = $selector->query();
        $this->username = (isset($_SESSION['username'])) ?? null; 
    }
    public function getMemberID($username,$activation){
        // Set activate to random string
        $stmt = $this->_db->prepare("SELECT memberID FROM members WHERE username = :username AND active = :active");
        $stmt->execute([':username'=>$username,'active'=>$activation]);
        $this->memberID = (int)$stmt->fetch();
        return $this->memberID;
        
    }
    public function uniqueUser($username){
       // this is validation 
       $stmt = $this->_db->prepare("SELECT username FROM members WHERE username = :username");
       $stmt->execute([":username"=>$username]);
       $row = $stmt->fetch();
       return $row;
    }
    public function getHash($username){
        $stmt = $this->_db->prepare("SELECT `password`, username, memberID FROM members WHERE username = :username AND active='Yes'");
        $stmt->execute([':username'=>$username]);
        $hash = $stmt->fetch();
        return $hash['password'];
    }
    public function activate(){
        if(!empty($this->_query) && isset($this->_query['x']) && isset($this->_query['y'])){
            $memberID = $this->_query['x'];
            $active = $this->_query['y'];
            $stmt = $this->_db->prepare("UPDATE members SET active = 'Yes' WHERE memberID = :memberID AND active = :active");
            $stmt->execute([':memberID' =>$memberID,':active'=>$active]);
        if($stmt->rowCount() == 1){
            return header('Location: http://staradventure.xf.cz/login?action=active'); exit;}
        }
        return null;
    }
    public function is_logged_in(){
        $member = (isset($_SESSION['username'])) ? htmlspecialchars($_SESSION['username'],ENT_QUOTES) : 'visitor';
		$memberID = (isset($_SESSION['memberID'])) ? $_SESSION['memberID'] : rand(1,9999);
		$logged = (isset($_SESSION['loggedin'])) ? $_SESSION['loggedin'] : false;
		$dataDB = $this->userInfo($member);
		$name = $dataDB['name'];
		$surname = $dataDB['surname'];
		$avatar = $dataDB['avatar'];
		$age = $dataDB['age'];
		$location = $dataDB['location'];
		$avatar = $dataDB['avatar'];
			return array($logged,$member,$memberID,$name,$surname,$avatar,$age,$location);
    }
    public function userInfo($member){
		try {
		$stmt = $this->_db->prepare("SELECT username,`name`,surname,avatar,age,`location` FROM members WHERE username = :username");
        $stmt->execute([':username'=>$member]);
			return $stmt->fetch();
		}catch(PDOException $Exception){
			$err = $Exception->getMessage() . (int)$Exception->getCode();
            return dump($err);
		}
    }
    public function isValidUsername($username){
        if (strlen($username) < 4) return false;
		if (strlen($username) > 25) return false;
		if (!ctype_alnum($username)) return false;
		return true;
    }
    public function login($username,$password){
        if (!$this->isValidUsername($username)) return false;
		if (strlen($password) < 5) return false;

		$row = $this->getHash($username);

		if($this->password_verify($password,$row['password']) == 1){

		    $_SESSION['loggedin'] = true;
		    $_SESSION['username'] = $row['username'];
			$_SESSION['memberID'] = $row['memberID'];
			$_SESSION['email'] = $row['email'];
		    return true;
		}
    }
    public function bookmark(){
        if(isset($this->memberID)){
            try{
            $stmt = $this->_db->prepare("SELECT bookmark FROM members WHERE memberID = :memberID");
            $stmt->execute([':memberID'=>$this->memberID]);
            $result = $stmt->fetch();
            }catch(PDOException $Exception){
                $err = $Exception->getMessage() . (int)$Exception->getCode();
                return dump($err);
            }
            if(empty($result['bookmark'])){
                $bookmark = 'member/'.$_SESSION['username'].'?action=emptyBookmark';
                return $bookmark;
            }else{
                $bookmark = $result['bookmark'];
                return $bookmark;
            }
        }
        return null;
    }
    public function permition(){
        try{
        $stmt = $this->_db->prepare('SELECT permition FROM members WHERE memberID = :memberID');
        $stmt->execute([':memberID'=>$this->memberID]);
        $result = $stmt->fetch();
        $this->permit = $result['permition'];
            return $this->permit;
        }catch(PDOException $Exception){
            $err = $Exception->getMessage() . (int)$Exception->getCode();
            return dump($err);
        }
    }
    
}