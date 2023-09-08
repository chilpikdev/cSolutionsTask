<?php

namespace App\Http\Dto\Auth;

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
     * @var bool|null
     */
    protected ?bool $remember;

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

    /**
     * Get the value of remember
     */
    public function isRemember(): ?bool
    {
        return $this->remember;
    }

    /**
     * Set the value of remember
     */
    public function setRemember(?bool $remember): self
    {
        $this->remember = $remember;

        return $this;
    }
}
