<?php

namespace Maestrodimateo\Workflow\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $lockable_type
 * @property mixed $lockable_id
 * @property mixed $locked_by
 * @property mixed $expires_at
 */
class WorkflowLockResource extends JsonResource
{
    #[\Override]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'lockable_type' => $this->lockable_type,
            'lockable_id' => $this->lockable_id,
            'locked_by' => $this->locked_by,
            'expires_at' => $this->expires_at,
            'is_active' => $this->isActive(),
        ];
    }
}