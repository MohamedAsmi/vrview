<?php
namespace App\Repositories\Interfaces;

use App\Models\PropertyImage;
use Illuminate\Database\Eloquent\Collection;

interface PropertImageRepositoryInterface
{
    public function getAll() : Collection;
    public function create(array $data) : PropertyImage;
    public function findById(int $id) : ?PropertyImage;
    public function update(int $id, array $data) : ?PropertyImage;
    public function store(array $data) : ?PropertyImage;
    public function delete(int $id) : ? bool;
    public function getPropertiesBId(int $id) : ? PropertyImage;
    
    
}