<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        /*
         * categories permissions =====================================================
         */
        Permission::query()->insert([
            [
                'title' => 'create-category',
                'label' => 'ایجاد دسته بندی',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'read-category',
                'label' => 'مشاهده دسته بندی',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'update-category',
                'label' => 'ویرایش دسته بندی',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'delete-category',
                'label' => 'حذف دسته بندی',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
        ]);
        /*
         * brands permissions =====================================================
         */
        Permission::query()->insert([
            [
                'title' => 'create-brand',
                'label' => 'ایجاد برند',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'read-brand',
                'label' => 'مشاهده برند',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'update-brand',
                'label' => 'ویرایش برند',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'delete-brand',
                'label' => 'حذف برند',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
        ]);
        /*
        * products permissions =====================================================
        */
        Permission::query()->insert([
            [
                'title' => 'create-product',
                'label' => 'ایجاد محصول',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'read-product',
                'label' => 'مشاهده محصول',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'update-product',
                'label' => 'ویرایش محصول',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'delete-product',
                'label' => 'حذف محصول',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
        ]);
        /*
        * discount(number%) permissions =====================================================
        */
        Permission::query()->insert([
            [
                'title' => 'create-discount',
                'label' => 'ایجاد تخفیف',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'read-discount',
                'label' => 'مشاهده تخفیف',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'update-discount',
                'label' => 'ویرایش تخفیف',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'delete-discount',
                'label' => 'حذف تخفیف',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
        ]);
        /*
        * offers(discountCode) permissions =====================================================
        */
        Permission::query()->insert([
            [
                'title' => 'create-offers',
                'label' => 'ایجاد کد تخفیف',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'read-offers',
                'label' => 'مشاهده کد تخفیف',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'update-offers',
                'label' => 'ویرایش کد تخفیف',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'delete-offers',
                'label' => 'حذف کد تخفیف',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
        ]);
        /*
        * pictures(gallery) permissions =====================================================
        */
        Permission::query()->insert([
            [
                'title' => 'create-gallery',
                'label' => 'ایجاد گالری',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'read-gallery',
                'label' => 'مشاهده گالری',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'update-gallery',
                'label' => 'ویرایش گالری',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'delete-gallery',
                'label' => 'حذف گالری',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
        ]);
        /*
        * roles permissions =====================================================
        */
        Permission::query()->insert([
            [
                'title' => 'create-role',
                'label' => 'ایجاد نقش',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'read-role',
                'label' => 'مشاهده نقش',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'update-role',
                'label' => 'ویرایش نقش',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'delete-role',
                'label' => 'حذف نقش',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
        ]);
        /*
        * dashboard permissions =====================================================
        */
        Permission::query()->create([
            'title' => 'view-dashboard',
            'label' => 'مشاهده داشبورد',
        ]);
    }
}
