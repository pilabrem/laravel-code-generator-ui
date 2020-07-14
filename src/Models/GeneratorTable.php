<?php

namespace Pilabrem\CodeGeneratorUI\Models;

use Illuminate\Database\Eloquent\Model;

class GeneratorTable extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'generator_tables';

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
                  'name',
                  'table_name',
                  'with_migration',
                  'with_form_request',
                  'with_soft_delete',
                  'models_per_page',
                  'translation_for',
                  'primary_key'
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


    /**
     * Get the generatorTableFields for this model.
     */
    public function generatorTableFields()
    {
        return $this->hasMany('Pilabrem\CodeGeneratorUI\Models\GeneratorTableField');
    }

}
