<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class RubrikResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
				return [
					'name_ru'          => $this->name_ru,
					'id'            => 'sdfsdf', //(string)$this->id,
					'attributes'    => [
						'title' => 'sdfsdf'//$this->title,
					],
				];
    }
}
