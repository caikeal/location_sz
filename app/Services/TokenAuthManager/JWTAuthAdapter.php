<?php

/**
 * Created by PhpStorm.
 * User: keal
 * Date: 2017/5/2
 * Time: 下午4:04
 */
namespace App\Services\TokenAuthManager;

use Illuminate\Auth\AuthManager;
use Tymon\JWTAuth\Providers\Auth\AuthInterface;

class JWTAuthAdapter implements AuthInterface
{
    /**
     * @var \Illuminate\Auth\AuthManager
     */
    protected $auth;

    /**
     * @param \Illuminate\Auth\AuthManager  $auth
     */
    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Check a user's credentials.
     *
     * @param  array  $credentials
     * @return bool
     */
    public function byCredentials(array $credentials = [])
    {
        return $this->auth->guard('api')->once($credentials);
    }

    /**
     * Authenticate a user via the id.
     *
     * @param  mixed  $id
     * @return bool
     */
    public function byId($id)
    {
        return $this->auth->guard('api')->onceUsingId($id);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->auth->guard('api')->user();
    }
}