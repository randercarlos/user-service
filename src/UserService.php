<?php

namespace UserServicePackage;

class UserService extends ApiService
{
    public function __construct()
    {
        // $this->endpoint = 'http://users-microservice:8000/api';
        $this->endpoint = config('microservices.users-microservice.url') . '/api';
    }

    public function register(array $data)
    {
        return $this->post('register', $data);
    }

    public function login(array $data)
    {
        return $this->post('login', $data);
    }

    public function getLoggedUser()
    {
        return $this->get('logged-user');
    }

    public function logout()
    {
        return $this->post('logout', []);
    }

    public function updateLoggedUserInfo(array $data)
    {
        return $this->put('logged-user/info', $data);
    }

    public function updateLoggedUserPassword(array $data)
    {
        return $this->put('logged-user/password', $data);
    }

    public function getUsers()
    {
        return $this->get('users');
    }

    public function getUser(int $userId)
    {
        return $this->get("users/$userId");
    }

    public function scopeCan(string $permission)
    {
        return $this->get("scope/$permission");
    }
}
