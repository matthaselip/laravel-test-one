<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $primaryKey = 'companies_id';

    protected $fillable = [
        'name',
        'email',
        'logo'
    ];

    /**
     * maps company to many employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Employees()
    {
        return $this->hasMany(Employee::class,'companies_id','companies_id');
    }

}
