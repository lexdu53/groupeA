 <?php
/**
 * Created by PhpStorm.
 * User: traversathomas
 * Date: 14/03/2018
 * Time: 11:31
 */
session_start();

 require_once (dirname(__FILE__).'/php-jwt-master/src/JWT.php');
 use Firebase\JWT\JWT;



 class Authentification
{

    /**
     *
     */
    function generateToken($id, $user, $key)
    {
        $token = array('ini' => time(),
            'exp' => time() + (10), //            'exp' => time() + (60 * 60),
            'id' => $id,
            'user' => $user);
        $jvt = JWT::encode($token, $key);

        return $jvt;
    }

    /**
     * @param $decode
     */
    function analyseToken($decode,$key){

        try{
            $decode=JWT::decode($decode,$key,array('HS256'));
            $bool=true;

        }catch(\Firebase\JWT\SignatureInvalidException $e){
            $bool=false;
        }
        return $bool;
        //$pro= get_object_vars($decode);
       /* if($pro['exp']>time()){//session encore bonne
            return true;
        }else return false;*/

    }
}