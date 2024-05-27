<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <!-- Voeg Tailwind CSS toe -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Product List') }}
            </h2>
        </x-slot>

        @if (session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <div class="container mx-auto px-4">
            <div class="mb-6">
                <input type="text" id="searchInput" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Search by name or description">
            </div>

            <ul id="productList" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($products as $product)
                <li class="product-item bg-white rounded-lg shadow-lg p-6 flex flex-col items-center">
                    <h2 class="text-2xl font-bold mb-2">{{ $product->name }}</h2>
                    <p class="text-gray-700 mb-4">{{ $product->description }}</p>
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded mb-4">
                    <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDelete('{{ $product->id }}')" class="delete-button bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full">Delete</button>
                    </form>
                </li>
                @endforeach
            </ul>
        </div>
    </x-app-layout>

    <script>
        // Function to confirm delete action
        function confirmDelete(productId) {
            if (confirm('Are you sure you want to delete this product?')) {
                document.getElementById('delete-form-' + productId).submit();
            }
        }

        // Function to filter products based on search input
        function filterProducts() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const productItems = document.querySelectorAll('#productList .product-item');

            productItems.forEach(item => {
                const productName = item.querySelector('h2').textContent.toLowerCase();
                const description = item.querySelector('p').textContent.toLowerCase();

                if (productName.includes(searchInput) || description.includes(searchInput)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // Event listener for search input
        document.getElementById('searchInput').addEventListener('input', filterProducts);
    </script>
</body>

</html>