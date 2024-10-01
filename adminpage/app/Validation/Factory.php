<?php
namespace App\Validation;

use \Somnambulist\Components\Validation\Factory as Validation;

class Factory extends Validation {
    public function __construct() {
        parent::__construct();
        global $capsule;

        //Add Equal Rule
        $this->messages()->add('en', ['rule.equal' => ':attribute is incorrect!']);
        $this->addRule('equal', new \App\Validation\Rules\Equal);

        //Change the message of "In" rule.
        $this->messages()->replace('en', 'rule.in', 'You must enter a valid :attribute!');

        //Add Unique Rule
        $this->addRule('unique', new \App\Validation\Rules\Unique($capsule));
        $this->messages()->replace('en', 'rule.unique', ':attribute already exist!!');

        $this->addRule('exists', new \App\Validation\Rules\Exists($capsule));
    }
}
?>