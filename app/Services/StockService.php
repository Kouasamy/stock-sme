<?php

namespace App\Services;

use App\Models\Product;
use App\Models\StockMovement;
use App\Mail\LowStockNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class StockService
{
    /**
     * Record a stock movement and update product quantity.
     */
    public function recordMovement(Product $product, int $quantity, string $type, string $reason = null)
    {
        // Calculate new quantity
        $newQuantity = $product->stock_quantity;
        if ($type === 'in') {
            $newQuantity += $quantity;
        } elseif ($type === 'out') {
            $newQuantity -= $quantity;
        } elseif ($type === 'adjustment') {
            $newQuantity = $quantity;
        }

        // Update product
        $product->update(['stock_quantity' => $newQuantity]);

        // Record movement
        StockMovement::create([
            'product_id' => $product->id,
            'quantity' => $quantity,
            'type' => $type,
            'reason' => $reason,
            'user_id' => Auth::id(),
        ]);

        // Check for low stock
        if ($product->stock_quantity <= $product->low_stock_threshold) {
             $this->notifyLowStock($product);
        }

        return $product;
    }

    /**
     * Send notification via Resend.
     */
    protected function notifyLowStock(Product $product)
    {
        // We'll send to a configured admin email or the current user
        $adminEmail = config('mail.from.address'); 
        
        try {
            Mail::to($adminEmail)->send(new LowStockNotification($product));
        } catch (\Exception $e) {
            \Log::error("Failed to send low stock notification for {$product->name}: " . $e->getMessage());
        }
    }
}
