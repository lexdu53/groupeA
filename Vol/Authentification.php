 <?php
/**
 * Created by PhpStorm.
 * User: traversathomas
 * Date: 14/03/2018
 * Time: 11:31
 */
session_start();

 require_once (dirname(__FILE__).'/php-jwt-master/src/JWT.php');
 require_once (dirname(__FILE__).'/php-jwt-master/src/ExpiredException.php');
 use Firebase\JWT\JWT;



 class Authentification
{

    /**
     *
     */
    function generateToken($id, $user, $key)
    {
        $token = array('ini' => time(),
            'exp' => time() + (20 * 60), //            'exp' => time() + (60 * 60),
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
            echo "erreur d'URL";
            $bool=false;
        }catch(\Firebase\JWT\ExpiredException $e){
            $bool=false;
        }
        return $bool;

    }
}