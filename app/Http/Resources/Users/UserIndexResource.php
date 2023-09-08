<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'fullname' => $this->fullname,
            'username' => $this->username,
            'roles' => implode(', ', $this->roles->map(function ($item) {
                return $item->name;
            })->toArray()),
            'permissions' => implode(', ', $this->getAllPermissions()->map(function ($item) {
                return $item->name;
            })->toArray()),
            'action' => null,
        ];
    }
}
