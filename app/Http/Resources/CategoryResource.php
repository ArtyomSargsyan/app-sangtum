<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' =>  $this->id,
            'name'=> $this->name
        ];
    }

    /**
     *
     * @param $request
     * @return array
     */
    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'post_url' => url('https://postapiurl.com')
        ];
    }
}
