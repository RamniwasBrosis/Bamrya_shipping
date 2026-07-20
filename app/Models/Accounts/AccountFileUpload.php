<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accounts\AccountProformaInvoice;
use App\Models\Accounts\AccountPurchaseInvoice;
use App\Models\Accounts\AccountSaleInvoice;

class AccountFileUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'uuid', 'file_name', 'file_path', 'file_type', 'file_related', 'invoice_no', 
        'proforma_invoice_id', 'purchase_invoice_id', 'sales_invoice_id'
    ];

    public function proformaInvoice()
    {
        return $this->belongsTo(AccountProformaInvoice::class, 'proforma_invoice_id');
    }

    public function purchaseInvoice()
    {
        return $this->belongsTo(AccountPurchaseInvoice::class, 'purchase_invoice_id');
    }

    public function saleInvoice()
    {
        return $this->belongsTo(AccountSaleInvoice::class, 'sales_invoice_id');
    }
}
