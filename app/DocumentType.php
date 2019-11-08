<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $fillable = ['name'];

    /**
     * Get all the documents that belong to the type.
     */
    public function documents()
    {
        return $this->hasMany('App\Document', 'document_type_id');
    }
}
