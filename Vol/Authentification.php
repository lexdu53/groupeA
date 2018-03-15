 <?php
/**
 * Created by PhpStorm.
 * User: traversathomas
 * Date: 14/03/2018
 * Time: 11:31
 */

class Authentification
{

    /**
     *
     */
    function generateToken($key,$id,$user)
    {
        $Key = uniqid();//mémoriser la clé
        $token = array('ini' => time(),
            'exp' => time() + (60 * 60),
            'id' => '1',
            'user' => $user);
        $jvt = JWT::encode($token, $Key);

        return $jvt;
    }

    /**
     * @param $token
     */
    function descryptToken($token,$key){

        $decode=JWT::decode($token,$key,array('HS256'));
        return $decode;

    }
}