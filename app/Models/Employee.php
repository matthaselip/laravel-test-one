<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $primaryKey = 'employees_id';

    protected $fillable = [
            'first_name',
            'last_name',
            'companies_id',
            'email',
            'phone'
    ];

    /**
     * maps employee to a company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Company()
    {
        return $this->hasOne(Company::class,'companies_id','companies_id');
    }

}
