<?php

namespace App\Repositories\Interfaces;

interface ColorRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function create($data);
    public function delete($id);
    public function update($id, $data);
}
