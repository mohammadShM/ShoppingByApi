<?php

namespace App\Models;

use App\Http\Requests\Admin\GalleryCreateRequest;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * @method static paginate(int $int)
 * @method orderBy(string $string, string $string1)
 * @property mixed name
 * @property mixed id
 * @property mixed galleries
 */
class Product extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $guarded = ['id'];

    // relationShips: =====================================================================
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }
    // end relationShips: =====================================================================

    /**
     * @throws Exception
     */
    public function newProduct(Request $request): void
    {
        if ($request->file('image')) {
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
    }

    /**
     * @throws Exception
     */
    public function updateProduct(Request $request): void
    {
        $imagePath = "";
        if ($request->file('image')) {
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
            //'image' => $request->has('image') ? $request->get('image') : $this->image,
            'image' => $request->has('image') ? $imagePath : $this->image,
            'description' => $request->get('description'),
            'quantity' => $request->get('quantity'),
        ]);
    }

    /**
     * @throws Exception
     */
    public function newGallery(GalleryCreateRequest $request): void
    {
        if ($request->has('path') && $request->file('path')) {
            foreach ($request->file('path') as $images) {
                $imageGalleryPath = "GALLERY_" . Carbon::now()->microsecond . '_' . random_int(111111, 999999)
                    . "_" . $images->getClientOriginalName();
                $images->storeAs('images/galleries', $imageGalleryPath, 'public');
                $this->galleries()->create([
                    'product_id' => $this->id,
                    'path' => $imageGalleryPath,
                    'mime' => $images->getClientMimeType(),
                ]);
            }
        }
    }

    public function deleteGallery(Gallery $gallery): void
    {
        Storage::delete('public/images/galleries/' . $gallery->path);
        // unlink(public_path('storage/images/galleries/' . $gallery->path));
        $gallery->delete();
    }

}
