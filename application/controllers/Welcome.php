<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application
{

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        //get the newest images of formatted cells for them
        $pix = $this->images->newest();

        //build an array of formatted cells for them
        foreach ($pix as $picture){
            $cells[]= $this->parser->parse('_cell', (array) $picture, true);
        }

        //prime the table class
        $this->load->library('table');
        $prams = array(
            'table_open' => '<table class="gallary">',
            'cell_start' => '<td class="oneimage">',
            'cell_alt_start' => '<td class="oneimage">'
        );

        $this->table->set_template($prams);

        //finally, generate the table
        $rows = $this->table->make_columns($cells, 3);
        $this->data['thetable']=$this->table->generate($rows);

        $this->data['pagebody'] = 'welcome';
        $this->render();
    }

}
