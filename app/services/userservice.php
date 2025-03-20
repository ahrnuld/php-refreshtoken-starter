<?php
namespace Services;

use Repositories\UserRepository;

class UserService {

    private $repository;

    function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function checkUsernamePassword($username, $password) {
        return $this->repository->checkUsernamePassword($username, $password);
    }

    public function updateRefreshToken($user) {
        return $this->repository->updateRefreshToken($user);
    }

    public function checkRefreshToken($username, $refreshtoken) {
        return $this->repository->checkRefreshToken($username, $refreshtoken);
    }
}

?>