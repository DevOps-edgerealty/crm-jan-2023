<?php

namespace App\Imports;

use App\Models\Leads;
use App\Models\Models\Website;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class WebsiteImport implements ToModel, WithStartRow
{
    protected $ref_no = null;
    protected $prefix = 'WL-';


    public function startRow(): int
    {
        return 2;

    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $leads = Website::latest()->first();
        if(empty($leads)){
            $leads = new Website();
            $leads->ref_no = 'WL-1000';
        }



        $ref = ($this->ref_no != null) ? $this->ref_no : explode('-', $leads->ref_no)[1];



        $this->ref_no = $ref+1;



        $data = [
            'ref_no'    => $this->prefix.$this->ref_no,
            'inquiry'    => ($row[0]) ? $row[0] : '',
            'source'    => ($row[1]) ? $row[1] : '',
            'name'    => ($row[2]) ? $row[2] : '',
            'email'    => ($row[3]) ? $row[3] : '',
            'phone'    => ($row[4]) ? $row[4] : '',
            'agent_id'    => ($row[5]) ? $row[5] : 0,
            'is_recycle'    => 0,
            'status' => 1
        ];
        // dd($data);
        return new Website($data);
    }
}
