<?php 
namespace Lotto\models;

use Eloquent, Validator;
use Auth;
use Exception;


class Availability extends Eloquent {

    /* Data members
    
            $table->increments('id');
            
            $table->tinyInteger('day_of_week')
            $table->time('start_time', 50);
            $table->time('end_time', 50);
    */


    protected $table = 'schedule_availability';
	public $timestamps = false;
    protected $softDelete = false;

	protected $fillable = array('end_time', 'start_time', 'day_of_week');

    protected $guarded = array('id');
    protected $hidden = array('pivot');



    private static $rules = array(
		//'end_date' => 'required|date_format:m/d/y'
	);

    /*
        uses the above rules to validate $data
    */
    public static function validate($data){
        return Validator::make($data, static::$rules);
    }

    public static function boot(){
        parent::boot();

        Availability::created(function($v){ });

        Availability::creating(function($v){ });

        Availability::updating(function($v){ });


        /*
            Upon deleting an ojbect of this model.
            This function is called before it is actually deleted.
            Detaches its self from any user - for allowing it to be deleted. 
        */
        Availability::deleting(function($v){

        	try{

        		Auth::user()->availability()->detach($v->id);

        	}catch(Exception $e){
      			
        	}
           
        });

    }



	

}

