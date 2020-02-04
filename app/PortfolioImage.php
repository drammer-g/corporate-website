<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Portfolio;

class PortfolioImage extends Model
{
    public $fillable = ['portfolio_id', 'file', 'title', 'description', 'active', 'is_main'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
