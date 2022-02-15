<?php

namespace App\View\Components\Results\Race;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DriverResClass extends Component{

    /**
     * The result.
     *
     * @var string
     */
    public $result;


    /**
     * The result color.
     *
     * @var string
     */
    public $color;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($result){
        $this->result = $result;


        if($result->penalty_name){
            $this->color = 'gray-200';
        } elseif ($result->class_points > 0){
            $this->color = 'green-500';
        } else {
            $this->color = 'blue-500';
        }

        switch($result->res_class_position){
            case 1: $this->color = 'amber-500'; break;
            case 2: $this->color = 'zinc-400'; break;
            case 3: $this->color = 'orange-500'; break;
        }

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|\Closure|string
     */
    public function render(){
        return view( 'components.results.race.driver-res-class');
    }
}
