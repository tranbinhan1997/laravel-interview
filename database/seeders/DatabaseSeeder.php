<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\InvoiceItem;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $currentDate = Carbon::now();

        // User
        User::updateOrCreate([
            'email' => 'staff@gmail.com',
        ],[
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('password'),
            'created_at' => $currentDate,
            'updated_at' => $currentDate
        ]);

        // Category
        Category::updateOrCreate([
            'category_name' => 'apple'
        ],[
            'category_name' => 'apple',
            'created_at' => $currentDate,
            'updated_at' => $currentDate
        ]);
        Category::updateOrCreate([
            'category_name' => 'orange'
        ],[
            'category_name' => 'orange',
            'created_at' => $currentDate,
            'updated_at' => $currentDate
        ]);
        Category::updateOrCreate([
            'category_name' => 'pear',
        ],[
            'category_name' => 'pear',
            'created_at' => $currentDate,
            'updated_at' => $currentDate
        ]);

        // Product
        Product::updateOrCreate([
            'product_name' => 'vietnam small apple',
        ],[
            'product_name' => 'vietnam small apple',
            'unit' => 'pcs',
            'price' => 2,
            'category_id' => '1',
            'created_at' => $currentDate,
            'updated_at' => $currentDate
        ]);

        Product::updateOrCreate([
            'product_name' => 'china big apple',
        ],[
            'product_name' => 'china big apple',
            'unit' => 'pack',
            'price' => 8,
            'category_id' => '1',
            'created_at' => $currentDate,
            'updated_at' => $currentDate
        ]);

        Product::updateOrCreate([
            'product_name' => 'vietnam big orange',
        ],[
            'product_name' => 'vietnam big orange',
            'unit' => 'kg',
            'price' => 5,
            'category_id' => '2',
            'created_at' => $currentDate,
            'updated_at' => $currentDate
        ]);

        // Invoice
        Invoice::updateOrCreate([
            'customer' => 'Brad Pit',
        ],[
            'customer' => 'Brad Pit',
            'user_id' => '1',
            'total' => 51,
            'created_at' => $currentDate,
            'updated_at' => $currentDate
        ]);
        // Invoice items
        InvoiceItem::updateOrCreate([
            'invoice_id' => '1',
            'product_id' => '1',
        ],[
            'category_name' => 'apple',
            'product_name' => 'vietnam small apple',
            'unit' => 'pcs',
            'price' => 2,
            'quantity' => 10,
            'amount' => 20,
            'invoice_id' => '1',
            'product_id' => '1',
            'created_at' => $currentDate,
            'updated_at' => $currentDate
        ]);
        InvoiceItem::updateOrCreate([
            'invoice_id' => '1',
            'product_id' => '2',
        ],[
            'category_name' => 'apple',
            'product_name' => 'china big apple',
            'unit' => 'pack',
            'price' => 8,
            'quantity' => 2,
            'amount' => 16,
            'invoice_id' => '1',
            'product_id' => '2',
            'created_at' => $currentDate,
            'updated_at' => $currentDate
        ]);
        InvoiceItem::updateOrCreate([
            'invoice_id' => '1',
            'product_id' => '3',
        ],[
            'category_name' => 'orange',
            'product_name' => 'Vietnam big orange',
            'unit' => 'kg',
            'price' => 5,
            'quantity' => 3,
            'amount' => 15,
            'invoice_id' => '1',
            'product_id' => '3',
            'created_at' => $currentDate,
            'updated_at' => $currentDate
        ]);

    }
}
