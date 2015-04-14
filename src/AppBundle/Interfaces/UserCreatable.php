<?php

namespace AppBundle\Interfaces;

interface UserCreatable
{
    public function markAsMadeByCurrentUser();

    public function isMadeByCurrentUser();

    public function getAuthor();
}
