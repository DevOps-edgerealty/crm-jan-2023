<?php

namespace App\Imports;


use App\Models\Models\Leads;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class LeadImport implements ToModel, WithStartRow
{

    protected $ref_no = null;
    protected $prefix = 'CL-';

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */



    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        $leads = Leads::latest()->first();
        if(empty($leads)){
            $leads = new Leads();
            $leads->ref_no = 'CL-1000';
        }



        $ref = ($this->ref_no != null) ? $this->ref_no : explode('-', $leads->ref_no)[1];



        $this->ref_no = $ref+1;


        $data = [
            'ref_no'    => $this->prefix.$this->ref_no,
            'inquiry'    => ($row[0]) ? $row[0] : '',
            'source'    => ($row[1]) ? $row[1] : '',
            'full_name'    => ($row[2]) ? $row[2] : '',
            'email'    => ($row[3]) ? $row[3] : '',
            'phone'    => ($row[4]) ? $row[4] : '',
            'qualified_question'    => ($row[5]) ? $row[5] : "",
            'qualified_status'    => ($row[6]) ? $row[6] : null,
            'agent_id'    => ($row[7]) ? $row[7] : 0,
            'campaign_id' => ($row[8]) ? $row[8] : null,
            'lead_status'    => 1,
            'lead_type'    => 1,
            'is_recycle'    => 0,
            'status' => 1
        ];
        return new Leads($data);
    }
}
