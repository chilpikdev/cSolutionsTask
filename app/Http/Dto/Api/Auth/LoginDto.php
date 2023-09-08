<?php

namespace App\Http\Dto\Api\Auth;

class LoginDto
{
    /**
     * @var string
     */
    protected string $userName;

    /**
     * @var string
     */
    protected string $password;

    /**
     * Get the value of userName
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * Set the value of userName
     */
    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
