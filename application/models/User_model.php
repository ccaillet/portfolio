<?php

class User_model extends CI_Model
{
    const TABLE = 'users';
    const TOKEN_VALIDITY_DURATION = 60 * 5; // 5 minutes

    public function __construct()
    {
        parent::__construct();
    }

    public function findAll()
    {
        return $this->db->get(self::TABLE)->result_object();
    }

    public function getAnonymous()
    {
        $user = new stdClass();
        $user->id = 0;
        $user->name = trans('pf_anonymous');
        $user->email = 'nomail@nomail';
        return $user;
    }

    public function generateToken($length = 20)
    {
        $allowedCharacters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_';

        $token = '';
        for ($i = 0; $i < $length; $i++) {
            $token .= $allowedCharacters[rand(0, strlen($allowedCharacters) - 1)];
        }
        return $token;
    }

    public function setToken()
    {
        $token = $this->generateToken();
        $user = get_user();
        $user->token = $token;
        $user->tokenValidity = time() + self::TOKEN_VALIDITY_DURATION;
    }

    public function isTokenValid($token)
    {
        $users = $this->db->get_where(self::TABLE, ['token' => $token])->result_object();
        if (sizeof($users) == 0) return false;

        $user = $users[0];
        if ($user->tokenValidity >= time())
        {
            $this->invalidateToken($user);
            return true;
        }
        return false;
    }

    private function invalidateToken($user)
    {
        $user->tokenValidity = 0;
        $this->db->where(['id' => $user->id]);
        $this->db->update(self::TABLE, $user);
    }
}

?>
