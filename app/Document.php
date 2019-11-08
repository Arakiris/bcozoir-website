<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['name', 'file_type', 'file_path'];

    /**
     * Get the type of this doc.
     */
    public function type()
    {
        return $this->belongsTo('App\DocumentType', 'document_type_id', 'id');
    }
}
