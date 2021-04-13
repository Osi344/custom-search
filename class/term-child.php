<?php

class TermChild
{

    // const ID= 0;

    function __construct($tm)
    {
        $this->id = $tm->term_id;
        $this->name = $tm->name;
        $this->slug = $tm->slug;
        $this->childs = [];
    }

    public function addChild($tm)
    {
        $this->childs[$tm->term_id] = new TermChild($tm);
    }

}