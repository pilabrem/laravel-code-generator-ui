<?php

namespace Pilabrem\CodeGeneratorUI\Models;

use Illuminate\Database\Eloquent\Model;

class ImportShemaFromXML extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'import_shema_from_x_m_ls';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fichier'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
}
