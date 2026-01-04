<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

use App\Http\Requests\Auth\LoginRequest;

class CheckoutController extends Controller
{
    public function __construct(
        protected CartService $cart
    ) {
    }

    public function login(LoginRequest $request)
    {
        try {
            $request->authenticate(); // handles email + password
            $request->session()->regenerate();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login successful.',
                    //  'redirect_url' => route('dashboard'),
                ]);
            }

            return redirect()->intended(route('dashboard', absolute: false));

        } catch (ValidationException $e) {

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors(),
                ], 422);
            }

            throw $e;
        }
    }

    public function checkOut(Request $request): JsonResponse|RedirectResponse
    {
        dd($request);
        $this->createUserAddress($request);
    }

    private function createUserAddress(Request $request)
    {
        try {
            //  Validation
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                'phone' => ['required', 'string', 'unique:users,phone'],
                'country_code' => ['nullable', 'string', 'max:5'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            //  Create User
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'phone' => $validated['phone'],
                'country_code' => $validated['country_code'] ?? '91',
                'status' => 1,
            ]);

            //  Events + Login
            event(new Registered($user));
            Auth::login($user);

            //  AJAX Response
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Account created successfully.',
                    'redirect_url' => route('dashboard'),
                ], 200);
            }

            //  Normal Redirect
            return redirect()->route('dashboard');

        } catch (ValidationException $e) {

            //  Validation errors (AJAX)
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors(),
                ], 422);
            }

            throw $e;

        } catch (\Exception $e) {

            //  Any other error
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong. Please try again.',
                ], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
    private function createOrder()
    {

    }
    public function index()
    {
        $cart = $this->cart->getCart();
        $cart->load('items.product');

        return view('frontend.cart', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1|max:100'
        ]);

        $item = $this->cart->add($product, $request->quantity ?? 1);

        return response()->json([
            'success' => true,
            'message' => 'Added to cart',
            'cart_count' => $this->cart->count(),
            'item' => $item
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:100'
        ]);

        $this->cart->update($product, $request->quantity);

        return response()->json([
            'success' => true,
            'cart_count' => $this->cart->count(),
            'product_subtotal' => $this->cart->itemSubtotal($product),
            'cart_total' => $this->cart->total()
        ]);
    }

    public function remove(Product $product)
    {
        $this->cart->remove($product);

        return response()->json([
            'success' => true,
            'cart_total' => $this->cart->total(),
            'cart_count' => $this->cart->count()
        ]);
    }

    public function mini()
    {
        $cart = $this->cart->getCart();
        $cart->load('items.product');

        return response()->json([
            'success' => true,
            'html' => view('components.frontend.mini-cart', compact('cart'))->render(),
            'cart_count' => $this->cart->count()
        ]);
    }

    public function productQty(Product $product)
    {
        return response()->json([
            'qty' => $this->cart->getProductQty($product)
        ]);
    }




}

