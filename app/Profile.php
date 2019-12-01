<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profile extends Model
{
   protected  $guarded = [];

   public function profileImage()
   {
      $imagePath = ($this->image) ? $this->image: 'profile/MB5xHtlW5Pv8Gy6ZzJGV54tsuzTYoSKqLGsb2rbe.png';
      return '/storage/'. $imagePath;
   }

   public function user()
   {
        return $this->belongsTo(User::class);
   }

   public function followers()
   {
        return $this->belongsToMany(User::class);
   }
}
