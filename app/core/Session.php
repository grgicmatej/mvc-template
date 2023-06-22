<?php

declare(strict_types=1);

class Session
{
    private static Session $instance;

    public function login($user): void
    {
        //todo: set session when logged In
    }

    public function logout(): void
    {
        //todo: delete session when logged out
    }

    public function isLoggedIn(): bool
    {
        return isset($_SESSION['is_logged_in']);
    }
}