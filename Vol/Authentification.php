 <?php
/**
 * Created by PhpStorm.
 * User: traversathomas
 * Date: 14/03/2018
 * Time: 11:31
 */

 require_once '../php-jwt-master/src/JWT.php';
 use Firebase\JWT\JWT;



 class Authentification
{

    /**
     *
     */
    function generateToken($id,$user)
    {
        $Key = uniqid();//mémoriser la clé
        $token = array('ini' => time(),
            'exp' => time() + (60 * 60),
            'id' => $id,
            'user' => $user);
        $jvt = JWT::encode($token, $Key);

        return $jvt;
    }

    /**
     * @param $decode
     */
    function analyseToken($decode,$key){

        $decode=JWT::decode($decode,$key,array('HS256'));
        $this->analyseToken($decode);

        if($decode['expe']<time()){//session encore bonne
            return true;
        }else return false;

    }
}