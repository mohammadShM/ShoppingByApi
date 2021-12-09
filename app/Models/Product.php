<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

/**
 * @method static paginate(int $int)
 * @method orderBy(string $string, string $string1)
 * @property mixed name
 * @property mixed id
 */
class Product extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $guarded = ['id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @throws Exception
     */
    public function newProduct(Request $request)
    {
        $imagePath = "PRODUCT_" . Carbon::now()->microsecond . '_' . random_int(111111, 999999)
            . "_" . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('images/products', $imagePath, 'public');
        $this->query()->create([
            'category_id' => $request->get('category_id'),
            'brand_id' => $request->get('brand_id'),
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'price' => $request->get('price'),
            'image' => $imagePath,
            'description' => $request->get('description'),
            'quantity' => $request->get('quantity'),
        ]);
    }

    /**
     * @throws Exception
     */
    public function updateProduct(Request $request)
    {
        if ($request->has('image')) {
            $imagePath = "PRODUCT_" . Carbon::now()->microsecond . '_' . random_int(111111, 999999)
                . "_" . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('images/products', $imagePath, 'public');
        }
        $this->update([
            'category_id' => $request->get('category_id'),
            'brand_id' => $request->get('brand_id'),
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'price' => $request->get('price'),
            'image' => $request->has('image') ? $request->get('image') : $this->image,
            'description' => $request->get('description'),
            'quantity' => $request->get('quantity'),
        ]);
    }

}
