<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('category', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            return view('details', compact('product'));
        } catch (ModelNotFoundException $e) {
            abort(404); // Можно также вернуть другую страницу ошибки, например, abort(404, 'Product not found');
        }
    }

    public function basket(Request $request)
    {
        try {

            $productId = $request->input('product_id');

            // Перевірка наявності товару
            $product = Product::findOrFail($productId);

            // Додавання товару до кошика
            Basket::create([
                'product_id' => $productId,
                'count' => 1
            ]);

            return response()->json(['message' => 'Product added to cart', 'product_id' => $productId]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Product not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to add product to cart', 'details' => $e->getMessage()], 500);
        }
    }
    public function show_basket()
    {
        try {
            $basketItems = Basket::all();

            // Створюємо порожній масив для зберігання продуктів
            $products = [];

            foreach ($basketItems as $item) {
                // Отримуємо дані про продукт за його id з корзини
                $product = Product::find($item->product_id);

                // Перевіряємо, чи знайдено продукт
                if ($product) {
                    // Додаємо дані про продукт із корзини та дані продукту до масиву
                    $products[] = [
                        'id' => $item->id,
                        'product_id' => $item->product_id,
                        'count' => $item->count,
                        'created_at' => $item->created_at,
                        'updated_at' => $item->updated_at,
                        'product' => [
                            'id' => $product->id,
                            'name' => $product->name,
                            'price' => $product->price,
                            'image' => $product->image,
                            // Додавайте інші поля продукту, які вам потрібні
                        ]
                    ];
                }
            }

            return response()->json(['products' => $products]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch basket data'], 500);
        }
    }
    public function store_order(Request $request)
    {
        //dd($request);
        $validatedData = $request->validate([
            'customer_name' => 'required|string',
            'customer_phone' => 'required|string',
            'customer_email' => 'required|string',
            'cart_items' => 'required|array', // Валідація для товарів у кошику
            'cart_items.*.product_id' => 'required|integer|exists:products,id',
            'cart_items.*.count' => 'required|integer|min:1',
        ]);

        // Створення замовлення
        $order = Order::create([
            'customer_name' => $validatedData['customer_name'],
            'customer_phone' => $validatedData['customer_phone'],
            'customer_email' => $validatedData['customer_email'],
        ]);

        // Додавання товарів до замовлення
        foreach ($validatedData['cart_items'] as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['count'],
            ]);

            // Видалення товару з корзини
            Basket::where('product_id', $item['product_id'])->delete();
        }
        return response()->json(['success' => 'Продукт успішно доданий']);
//        return redirect("welcome")->with('success', 'Продукт успішно доданий');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
