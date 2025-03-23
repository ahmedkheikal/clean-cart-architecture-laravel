@extends('layouts.app')

@section('content')
<div class="max-w-screen-xl mx-auto px-4 py-8 lg:px-6">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar Filters -->
        <div class="w-full md:w-64 bg-white p-4 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">Filters</h2>
            
            <!-- Categories -->
            <div class="mb-6">
                <h3 class="font-medium text-gray-700 mb-2">Categories</h3>
                <div class="space-y-2">
                    <div class="flex items-center">
                        <input id="category-1" type="checkbox" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                        <label for="category-1" class="ml-2 text-sm text-gray-600">Electronics</label>
                    </div>
                    <div class="flex items-center">
                        <input id="category-2" type="checkbox" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                        <label for="category-2" class="ml-2 text-sm text-gray-600">Clothing</label>
                    </div>
                    <div class="flex items-center">
                        <input id="category-3" type="checkbox" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                        <label for="category-3" class="ml-2 text-sm text-gray-600">Home & Kitchen</label>
                    </div>
                    <div class="flex items-center">
                        <input id="category-4" type="checkbox" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                        <label for="category-4" class="ml-2 text-sm text-gray-600">Books</label>
                    </div>
                </div>
            </div>
            
            <!-- Price Range -->
            <div class="mb-6">
                <h3 class="font-medium text-gray-700 mb-2">Price Range</h3>
                <div class="space-y-2">
                    <div class="flex items-center">
                        <input id="price-1" type="checkbox" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                        <label for="price-1" class="ml-2 text-sm text-gray-600">Under $25</label>
                    </div>
                    <div class="flex items-center">
                        <input id="price-2" type="checkbox" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                        <label for="price-2" class="ml-2 text-sm text-gray-600">$25 to $50</label>
                    </div>
                    <div class="flex items-center">
                        <input id="price-3" type="checkbox" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                        <label for="price-3" class="ml-2 text-sm text-gray-600">$50 to $100</label>
                    </div>
                    <div class="flex items-center">
                        <input id="price-4" type="checkbox" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                        <label for="price-4" class="ml-2 text-sm text-gray-600">$100 & Above</label>
                    </div>
                </div>
            </div>
            
            <!-- Ratings -->
            <div class="mb-6">
                <h3 class="font-medium text-gray-700 mb-2">Customer Rating</h3>
                <div class="space-y-2">
                    <div class="flex items-center">
                        <input id="rating-4" type="checkbox" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                        <label for="rating-4" class="ml-2 text-sm text-gray-600 flex items-center">
                            <span class="flex text-yellow-400">
                                @for ($i = 0; $i < 4; $i++)
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path>
                                    </svg>
                                @endfor
                                <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 24 24">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path>
                                </svg>
                            </span>
                            <span class="ml-1">& Up</span>
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input id="rating-3" type="checkbox" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                        <label for="rating-3" class="ml-2 text-sm text-gray-600 flex items-center">
                            <span class="flex text-yellow-400">
                                @for ($i = 0; $i < 3; $i++)
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path>
                                    </svg>
                                @endfor
                                @for ($i = 0; $i < 2; $i++)
                                    <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 24 24">
                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path>
                                    </svg>
                                @endfor
                            </span>
                            <span class="ml-1">& Up</span>
                        </label>
                    </div>
                </div>
            </div>
            
            <button class="w-full bg-primary-600 text-white py-2 px-4 rounded-md hover:bg-primary-700 transition duration-300">
                Apply Filters
            </button>
        </div>
        
        <!-- Products Grid -->
        <div class="flex-1">
            <!-- Top Bar with Sorting and View Options -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 bg-white p-4 rounded-lg shadow">
                <div>
                    <h1 class="text-2xl font-bold">Products</h1>
                    <p class="text-gray-600">Showing 12 of 100 products</p>
                </div>
                <div class="mt-4 sm:mt-0 flex items-center">
                    <label for="sort" class="mr-2 text-sm text-gray-600">Sort by:</label>
                    <select id="sort" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 p-2">
                        <option value="popularity">Popularity</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                        <option value="newest">Newest First</option>
                    </select>
                </div>
            </div>
            
            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @for ($i = 1; $i <= 12; $i++)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <div class="h-48 bg-gray-200 flex items-center justify-center">
                                <img src="https://via.placeholder.com/300x200?text=Product+{{ $i }}" alt="Product {{ $i }}" class="h-full w-full object-cover">
                            </div>
                            @if ($i % 4 == 0)
                                <span class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">SALE</span>
                            @endif
                            <button class="absolute bottom-2 right-2 bg-white p-2 rounded-full shadow hover:bg-gray-100 z-10">
                                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="p-4 pt-6">
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400">
                                    @for ($j = 0; $j < min(5, ($i % 5) + 1); $j++)
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path>
                                        </svg>
                                    @endfor
                                    @for ($j = 0; $j < 5 - min(5, ($i % 5) + 1); $j++)
                                        <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 24 24">
                                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-gray-500 text-sm ml-1">({{ rand(10, 500) }})</span>
                            </div>
                            <h2 class="text-lg font-semibold mb-1">Product {{ $i }}</h2>
                            <p class="text-gray-600 text-sm mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <div class="flex items-center justify-between">
                                @if ($i % 4 == 0)
                                    <div>
                                        <span class="text-gray-500 line-through text-sm">${{ rand(50, 200) }}.99</span>
                                        <span class="text-gray-800 font-bold ml-1">${{ rand(20, 100) }}.99</span>
                                    </div>
                                @else
                                    <span class="text-gray-800 font-bold">${{ rand(20, 150) }}.99</span>
                                @endif
                                <button class="bg-primary-600 hover:bg-primary-700 text-white px-3 py-1.5 rounded-md text-sm transition duration-300">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            
            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                <nav class="flex items-center">
                    <a href="#" class="px-3 py-1 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 mr-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <a href="#" class="px-3 py-1 rounded-md bg-primary-600 text-white mr-1">1</a>
                    <a href="#" class="px-3 py-1 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 mr-1">2</a>
                    <a href="#" class="px-3 py-1 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 mr-1">3</a>
                    <span class="px-3 py-1 text-gray-600">...</span>
                    <a href="#" class="px-3 py-1 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 mr-1">8</a>
                    <a href="#" class="px-3 py-1 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection 