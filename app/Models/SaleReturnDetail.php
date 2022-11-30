<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleReturnDetail extends Model
{
    use HasAdvancedFilter;

    public $orderable = [
        'id',
        'sale_return_id',
        'product_id',
        'quantity',
        'price',
        'total',
        'created_at',
        'updated_at',
    ];

    public $filterable = [
        'id',
        'sale_return_id',
        'product_id',
        'quantity',
        'price',
        'total',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [];

    protected $with = ['product'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function saleReturn(): BelongsTo
    {
        return $this->belongsTo(SaleReturnPayment::class, 'sale_return_id', 'id');
    }

    public function getPriceAttribute($value)
    {
        return $value / 100;
    }

    public function getUnitPriceAttribute($value)
    {
        return $value / 100;
    }

    public function getSubTotalAttribute($value)
    {
        return $value / 100;
    }

    public function getProductDiscountAmountAttribute($value)
    {
        return $value / 100;
    }

    public function getProductTaxAmountAttribute($value)
    {
        return $value / 100;
    }
}
