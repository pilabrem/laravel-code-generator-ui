<?php

namespace Pilabrem\CodeGeneratorUI\Models;

use Illuminate\Database\Eloquent\Model;

class GeneratorTableField extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'generator_table_fields';

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
                  'id',
                  'name',
                  'labels',
                  'validation',
                  'html_type',
                  'html_value',
                  'css_class',
                  'options',
                  'data_type',
                  'data_type_params',
                  'data_value',
                  'date_format',
                  'placeholder',
                  'is_inline_options',
                  'is_on_index',
                  'is_on_form',
                  'is_on_show',
                  'is_on_views',
                  'is_header',
                  'is_auto_increment',
                  'is_primary',
                  'is_index',
                  'is_unique',
                  'is_nullable',
                  'is_unsigned',
                  'generator_table_id'
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
     * Get the generatorTable for this model.
     *
     * @return App\Models\GeneratorTable
     */
    public function generatorTable()
    {
        return $this->belongsTo('Pilabrem\CodeGeneratorUI\Models\GeneratorTable','generator_table_id');
    }

}
