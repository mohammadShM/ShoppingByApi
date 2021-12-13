<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

/**
 * @method orderBy(string $string, string $string1)
 * @property mixed $id
 * @property mixed $title
 */
class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @throws Exception
     * @noinspection NullPointerExceptionInspection
     */
    public function newBrand(Request $request): Model|Builder
    {
        // $imagePath = Carbon::now()->microsecond . '_' . $request->get('image')->extension();
        $imagePath = "BRAND_" . Carbon::now()->microsecond . '_' . random_int(111111, 999999)
            . "_" . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('images/brands', $imagePath, 'public');
        return self::query()->create([
            'title' => $request->get('title'),
            'image' => $imagePath,
        ]);
    }

    /**
     * @throws Exception
     * @noinspection NullPointerExceptionInspection
     */
    public function updatedBrand(Request $request): void
    {
        if ($request->has('image')) {
            $imagePath = "BRAND_" . Carbon::now()->microsecond . '_' . random_int(111111, 999999)
                . "_" . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('images/brands', $imagePath, 'public');
        }
        $this->update([
            'title' => $request->get('title'),
            'image' => $request->has('image') ? $request->get('image') : $this->image,
        ]);
    }

}
