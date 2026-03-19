@extends('e-commerce.seller.master')

@section('stock-content')
    <div class="container mt-4">

        <div class="card shadow">

            <h5>Current Stock: <strong>{{ $product->Product_table->product_name }}</strong></h5>

            <form action="{{ route('seller.stock.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="number" name="new_stock" class="form-control mb-3" placeholder="Add Stock" required>

                <button class="btn btn-success">Save Stock</button>
            </form>

            <hr>

            <h4>Stock History (Latest First)</h4>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Added</th>
                        <th>Old</th>
                        <th>New Total</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($product->histories as $history)
                        <tr>
                            <td>{{ $history->created_at->format('d M Y H:i') }}</td>
                            <td class="text-success">+{{ $history->added_stock }}</td>
                            <td>{{ $history->old_stock }}</td>
                            <td><strong>{{ $history->new_total }}</strong></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
