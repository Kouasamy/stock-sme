<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\StockMovement;
use App\Models\User;
use App\Services\StockTips;
use App\Mail\StockAdviceEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = [
            'total_products' => $user->products()->count(),
            'low_stock_count' => $user->products()->whereRaw('stock_quantity <= low_stock_threshold')->count(),
            'total_categories' => $user->categories()->count(),
            'recent_movements' => StockMovement::whereIn('product_id', $user->products()->pluck('id'))
                ->with(['product', 'user'])
                ->latest()
                ->take(5)
                ->get(),
            'suggested_products' => [
                ['name' => 'Ordinateur Portable HP', 'sku' => 'HP-LAP-001', 'cat' => 'Informatique'],
                ['name' => 'Casque Sans Fil Sony', 'sku' => 'SONY-WH-1000', 'cat' => 'Audio'],
                ['name' => 'Chaise Ergonomique Office', 'sku' => 'OFF-CHAIR-X', 'cat' => 'Mobilier'],
            ],
        ];

        return view('dashboard', compact('stats'));
    }

    public function sendAdvice(Request $request)
    {
        $user = Auth::user();
        $product = $user->products()->inRandomOrder()->first();

        if (!$product) {
            return back()->with('error', 'Ajoutez d\'abord des produits pour recevoir des conseils !');
        }

        $tips = new StockTips();
        $tip = $tips->getPersonalizedTip($product);

        try {
            Mail::to($user->email)->send(new StockAdviceEmail($user, $tip));
            return back()->with('success', 'Conseil envoyé sur votre boite mail !');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de l\'envoi : Request to the Resend API failed. Reason' . $e->getMessage());
        }
    }

    public function clearInventory()
    {
        $user = Auth::user();
        
        DB::transaction(function () use ($user) {
            $productIds = $user->products()->pluck('id');
            StockMovement::whereIn('product_id', $productIds)->delete();
            $user->products()->delete();
            $user->categories()->delete();
            $user->suppliers()->delete();
        });

        return back()->with('success', 'Toutes les données d\'inventaire ont été supprimées.');
    }

    public function deleteAccount()
    {
        $user = Auth::user();
        
        DB::transaction(function () use ($user) {
            $productIds = $user->products()->pluck('id');
            StockMovement::whereIn('product_id', $productIds)->delete();
            $user->products()->delete();
            $user->categories()->delete();
            $user->suppliers()->delete();
            $user->delete();
        });

        Auth::logout();
        return redirect('/')->with('success', 'Votre compte et toutes vos données ont été définitivement supprimés.');
    }
}
