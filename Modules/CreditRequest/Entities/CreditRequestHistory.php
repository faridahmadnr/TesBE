<?php

namespace Modules\CreditRequest\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CreditRequestHistory extends BaseModel
{
    protected $fillable = [
        'credit_request_id',
        'status',
        'description',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * Retrieves the related credit history model.
     *
     * @return BelongsTo<CreditRequest, CreditRequestHistory> The related Regency model.
     */
    public function creditRequest(): BelongsTo
    {
        return $this->belongsTo(CreditRequest::class);
    }
}
