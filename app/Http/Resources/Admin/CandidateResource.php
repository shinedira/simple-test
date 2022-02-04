<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class CandidateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return array_merge(
            $this->resource->makeHidden('created_at', 'updated_at', 'deleted_at', 'resume', 'birth_date_format', 'file')->toArray(),
            [
                'file' => $this->resume['url']
            ],
            ['skills' => SkillResource::collection($this->skills)]
        );
    }
}
