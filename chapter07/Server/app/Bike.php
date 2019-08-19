<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 * definition="Bike",
 * required={"make", "model", "year", "mods"},
 * @SWG\Property(
 * property="make",
 * type="string",
 * description="Company name",
 * example="Harley Davidson, Honda, Yamaha"
 * ),
 * @SWG\Property(
 * property="model",
 * type="string",
 * description="Motorcycle model",
 * example="Xl1200, Shadow ACE, V-Star"
 * ),
 * @SWG\Property(
 * property="year",
 * type="string",
 * description="Fabrication year",
 * example="2009, 2008, 2007"
 * ),
 * @SWG\Property(
 * property="mods",
 * type="string",
 * description="Motorcycle description of modifications",
 * example="New exhaust system"
 * ),
 * @SWG\Property(
 * property="picture",
 * type="string",
 * description="Bike image url",
 * example="http://www.sample.com/my.bike.jpg"
 * )
 * )
 */

class Bike extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'bikes';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'user_id', 'make', 'model', 'year', 'mods', 'picture', 'builder_id'
    ];

    /**
     * Relationship.
     * 
     * @var array
     */
    public function builder() {
        return $this->belongsTo('App\Builder');
    }
    public function items() {
        return $this->hasMany('App\Item');
    }
    public function garages() {
        return $this->belongsTo('App\Garage');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }
    public function ratings() {
        return $this->hasMany('App\Rating');
    }
}
