<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseType extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'percentage',
        'duration',
        'number_of_installments',
        'status',
    ];
    /**
     * Relationship: ExpenseType has many Expenses
     */
    public function expenses()
    {
        return $this->hasMany(Expense::class, 'expense_type_id');
    }
}