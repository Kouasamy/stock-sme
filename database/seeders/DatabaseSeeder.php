<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        $admin = User::create([
            'name' => 'Admin SME',
            'email' => 'admin@sme-stock.com',
            'password' => Hash::make('password'),
        ]);

        // Categories
        $electronics = Category::create(['name' => 'Électronique', 'slug' => 'electronique']);
        $furniture = Category::create(['name' => 'Mobilier', 'slug' => 'mobilier']);

        // Suppliers
        $supplierA = Supplier::create([
            'name' => 'Fournisseur Global S.A.',
            'email' => 'contact@global-sa.com',
            'phone' => '+225 0102030405',
            'address' => 'Abidjan, Côte d\'Ivoire'
        ]);

        // Products
        $laptop = Product::create([
            'name' => 'MacBook Pro M3',
            'sku' => 'LAP-MBP-001',
            'description' => 'Ordinateur portable haute performance',
            'price' => 1500000,
            'stock_quantity' => 5,
            'low_stock_threshold' => 10, // Should trigger alert
            'category_id' => $electronics->id,
            'supplier_id' => $supplierA->id,
        ]);

        $desk = Product::create([
            'name' => 'Bureau Ergonomique',
            'sku' => 'FUR-DSK-001',
            'description' => 'Bureau en bois massif',
            'price' => 125000,
            'stock_quantity' => 20,
            'low_stock_threshold' => 5,
            'category_id' => $furniture->id,
            'supplier_id' => $supplierA->id,
        ]);

        // Stock Movements
        StockMovement::create([
            'product_id' => $laptop->id,
            'quantity' => 10,
            'type' => 'in',
            'reason' => 'Stock initial',
            'user_id' => $admin->id,
        ]);

        StockMovement::create([
            'product_id' => $laptop->id,
            'quantity' => 5,
            'type' => 'out',
            'reason' => 'Vente client #102',
            'user_id' => $admin->id,
        ]);
    }
}
