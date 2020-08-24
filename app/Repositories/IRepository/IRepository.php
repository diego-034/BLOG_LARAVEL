<?php

namespace App\Repositories\IRepository;

interface IRepository
{
    public function List($data = null);

    public function Insert($data);

    public function Update($data);

    public function Delete($data);

    public function Find($data);
}
