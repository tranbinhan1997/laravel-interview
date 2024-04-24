<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Support\Facades\Auth;
use PDF;

class InvoiceController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $invoices = Invoice::orderBy('created_at', 'desc')->paginate(2);
        return view('pages.invoice.index', compact('products', 'invoices'));
    }

    public function create(Request $request)
    {
        // Validate form data
        $request->validate([
            'customer' => 'required|string|max:50',
            'products.*' => 'required|exists:products,id',
            'quantity.*' => 'required|integer|min:1',
        ]);

        // Create new invoice record
        $invoice = new Invoice();
        $invoice->customer = $request->input('customer');
        $invoice->total = 0;
        $invoice->user_id = Auth::id();
        $invoice->save();

        // Get the ID of the newly created invoice
        $invoiceId = $invoice->id;
        // Process each product in the form
        foreach ($request->input('products') as $key => $productId) {
            $quantity = $request->input('quantity.' . $key);

            // Create new invoice item record
            $invoiceItem = new InvoiceItem();
            $invoiceItem->invoice_id = $invoiceId;
            $invoiceItem->product_id = $productId;
            $invoiceItem->quantity = $quantity;

            $product = Product::find($productId);

            $invoiceItem->category_name = $product->category->category_name;
            $invoiceItem->product_name = $product->product_name;
            $invoiceItem->unit = $product->unit;
            $invoiceItem->price = $product->price;
            $invoiceItem->amount = $product->price * $quantity;
            $invoiceItem->save();
        }

        // Calculate total amount for the invoice
        $total = 0;
        $total = InvoiceItem::where('invoice_id', $invoiceId)->sum('amount');
        // Update total amount in the invoice
        $invoice->total = $total;
        $invoice->save();

        // Optionally, you can redirect back or return a response
        return redirect('invoices/'.$invoice->id)->with('success', 'Invoice created successfully');
    }

    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $products = Product::all();
        return view('pages.invoice.edit', compact('invoice', 'products'));
    }

    public function update(Request $request, $id)
    {
        // Validate form data
        $request->validate([
            'customer' => 'required|string|max:255',
            'products.*' => 'required|exists:products,id',
            'quantity.*' => 'required|integer|min:1',
        ]);

        // Find the invoice
        $invoice = Invoice::findOrFail($id);
        if(!$invoice) {
            return redirect()->route('invoices')->with('error', 'Invoice does not exist!');
        }

        $invoice->customer = $request->input('customer');
        $invoice->user_id = Auth::id();
        $invoice->save();
        foreach ($request->input('products') as $key => $productId) {
            $quantity = $request->input('quantity.' . $key);
    
            $product = Product::find($productId);

            InvoiceItem::updateOrCreate(
                ['invoice_id' => $invoice->id, 'product_id' => $productId],
                [
                    'invoice_id' => $invoice->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'amount' => $product->price * $quantity,
                    'price' => $product->price,
                    'unit' => $product->unit,
                    'product_name' => $product->product_name,
                    'category_name' => $product->category->category_name
                ]
            );
        }

        // Delete invoice items with products not in the updated list
        $productIds = $request->input('products');
        InvoiceItem::where('invoice_id', $invoice->id)->whereNotIn('product_id', $productIds)->delete();

        // Update total amount in the invoice
        $total = 0;
        $total = InvoiceItem::where('invoice_id', $invoice->id)->sum('amount');
        $invoice->total = $total;
        $invoice->save();

        return redirect()->back()->with('success', 'Invoice updated successfully');
    }

    public function exportPDF($id)
    {
        $invoice = Invoice::findOrFail($id);
        $data = ['invoice' => $invoice];

        $pdf = PDF::loadView('pdf.invoice',  $data);
        return $pdf->stream('invoice.pdf');
    }

    public function delete($id)
    {
        $invoice = Invoice::findOrFail($id);
        if($invoice->delete()) {
            return redirect()->route('invoices')->with('success', 'Invoice deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Invoice deleted failed!');
        }
    }
}
