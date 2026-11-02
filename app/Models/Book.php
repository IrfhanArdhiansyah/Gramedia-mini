<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['cover', 'title', 'price', 'description', 'language', 'publisher', 'writer', 'release_date', 'page_of_book', 'book_category_id'])]

class Book extends Model
{

    public function bookCategory(): BelongsTo
    {
        return $this->belongsTo(BookCategory::class);
    }

    public function checkoutBooks(): HasMany
    {
        return $this->hisMany(CheckoutBook::class);
    }

    public function subscriptionPackageBooks(): HasMany
    {
        return $this->hasMany(SubscriptionPackageBook::class);
    }

}
