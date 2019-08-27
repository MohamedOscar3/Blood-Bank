<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DonationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'blood_type' => $this->blood_type->type_name,
            'name'=>$this->name,
            'hospital_name'=>$this->hospital_name,
            'governorate' => $this->governorate->governorate_name,
            'phone_number' =>  $this->phone_number,
            'lat'=>$this->lat,
            'lng'=>$this->lng,
            

        ];
    }
}
