<?php


namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Models\Book;
use App\Services\Library\LibraryStockService;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function __construct(private LibraryStockService $service) {}

    public function index()
    {
        $library = auth()->user()->library;

        $stocks = Stock::with('book')
            ->where('library_id', $library->id)
            ->get();

        $books = Book::where('library_id', $library->id)->get();

        return view('library.stock.index', compact('stocks','books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $this->service->add(auth()->user(), $request->all());

        return back()->with('success', 'Stock added');
    }

    public function update(Request $request, Stock $stock)
    {
        $this->authorizeOwner($stock);

        $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        $this->service->update($stock, $request->quantity);

        return back()->with('success', 'Stock updated');
    }

    public function destroy(Stock $stock)
    {
        $this->authorizeOwner($stock);

        $this->service->delete($stock);

        return back()->with('success', 'Stock deleted');
    }

    private function authorizeOwner(Stock $stock)
    {
        if ($stock->library_id !== auth()->user()->library->id) {
            abort(403);
        }
    }
}