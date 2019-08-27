<?php

namespace App\Http\Resources;

use App\Favorite;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class PostResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'tumbnail_link' => $this->thumbnail->image_name,
            
            'is_favorite' => $this->is_the_post_fav() ?? 0,

            
        ];
    }

    private function is_the_post_fav() {
        if (Auth::user()->has('favorite')) {
            $is_fav =  Favorite::Where('client_id','=',Auth::id())->where('post_id','=',$this->id)->first();
       
            if($is_fav) {
                return 1;
            }
        }
 
    }
}
