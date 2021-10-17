<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "SalesLT.Customer";

    protected $fillable = [
        'CustomerID',
        'NameStyle',
        'Title',
        'FirstName',
        'MiddleName',
        'LastName',
        'Suffix',
        'CompanyName',
        'SalesPerson',
        'EmailAddress',
        'Phone',
        'rowguid',
        'ModifiedDate',
    ];
}
