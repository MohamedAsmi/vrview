<?php
namespace App\Repositories;

use App\Models\Property;
use App\Models\User;
use App\Repositories\Interfaces\PropertRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PropertyRepository implements PropertRepositoryInterface
{
    /**
     * Get all users.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Property::where('user_id',auth()->user()->id)->get();
    }

    public function create(array $data): Property
    {
        return Property::create($data);
    }

    public function findById(int $id): ?Property
    {
        return Property::find($id);
    }

    public function update(int $id, array $data): ?Property
    {
        $property = $this->findById($id);
        if ($property) {
            $property->update($data);
            return $property->fresh();
        }
        return null;
    }

    public function delete(int $id): bool
    {
        $property = $this->findById($id);
        if ($property) {
            return $property->delete();
        }
        return false;
    }

    public function getPropertiesBId(int $Id): Property
    {
        return Property::where('id', $Id)->get();
    }
}