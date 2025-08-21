<?php
namespace App\Repositories\Interfaces;

use App\Models\Property;
use Illuminate\Database\Eloquent\Collection;

interface PropertRepositoryInterface
{
    public function getAll() : Collection;
    public function create(array $data) : Property;
    public function findById(int $id) : ?Property;
    public function update(int $id, array $data) : ?Property;
    public function delete(int $id) : ? bool;
    public function getPropertiesBId(int $id) : ? Property;
}