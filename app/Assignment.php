<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = str_slug($title);

        $allSlugs = $this->getRelatedSlugs($slug, $id);

        // If we haven't used it before then we are all good.
        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
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
        return Assignment::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }

    public function course_detail()
    {
        return $this->belongsTo('App\Course', 'course');
    }
    
    public function submission()
    {
        return $this->hasMany('App\Submission');
    }
}
