<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Course extends Model
{
    //
    /**
    * The attributes that are mass assignable.
    *
    */
    
    protected function createSlug($title, $id = 0) {
        $slug = str_slug($title);
        
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if(!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');

    }
    
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Course::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }

    public function assignments()
    {
        return $this->hasMany('App\Assignment', 'course');
    }
}
