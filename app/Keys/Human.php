<?php

namespace App\Keys;

class Human
{
    public function isReal()
    {
        // Randomly make users re-verify that they are not a robot
        if (mt_rand(0, 200) === 42) {
            $this->unsetCurrentUser();
        }

        return (bool) session()->get('is-human');
    }

    public function verifyCurrentUser()
    {
        session()->put('is-human', true);
    }

    public function unsetCurrentUser()
    {
        session()->remove('is-human');

        session()->remove('human-redirect');
    }

    public function putRedirectUrl($url)
    {
        session()->put('human-redirect', $url);
    }

    public function pullRedirectUrl()
    {
        return session()->pull('human-redirect') ?: route('home');
    }
}
