<?php
# @Author: John Carlo M. Ramos
# @Date:   2019-10-01T14:31:36+01:00
# @Email:  !!!!!---CTRL + ALT + C = Colour Picker---!!!!!
# @Last modified by:   John Carlo M. Ramos
# @Last modified time: 2019-10-15T16:45:17+01:00




namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    public function user() {
      return $this->belongsTo('App\User');
    }
}
