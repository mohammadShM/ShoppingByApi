<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

/**
 * @method orderBy(string $string, string $string1)
 * @method static paginate(int $int)
 * @property mixed title
 * @property mixed id
 */
class Category extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = ['id'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__,'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(__CLASS__,'parent_id');
    }

    public function newCategory(Request $request): void
    {
        $this->query()->create([
            'title' => $request->get('title'),
            'parent_id' => $request->get('parent_id'),
        ]);
    }

    public function updatedCategory(Request $request)
    {
        $this->update([
            'title' => $request->get('title'),
            'parent_id' => $request->get('parent_id'),
        ]);
    }

}
