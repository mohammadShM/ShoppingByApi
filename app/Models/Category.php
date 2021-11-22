<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

/**
 * @method orderBy(string $string, string $string1)
 */
class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__,'paren_id');
    }

    public function newCategory(Request $request): void
    {
        $this->query()->create([
            'title' => $request->get('title'),
            'parent_id' => $request->get('parent_id'),
        ]);
    }

}
