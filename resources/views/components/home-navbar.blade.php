 <header class="flex flex-wrap md:justify-start md:flex-nowrap z-50 w-full bg-white">
     <nav
         class="relative max-w-[66rem] w-full md:flex md:items-center md:justify-between md:gap-3 mx-auto px-4 sm:px-6 lg:px-8 py-2">
         <!-- Logo w/ Collapse Button -->
         <div class="flex items-center justify-between">
             <a class="flex-none font-semibold text-xl text-white focus:outline-none focus:opacity-80"
                 href="{{ url('/') }}" aria-label="Brand">
                 {{-- {{ config('app.name') }} --}}
                 <img src="{{ url('/') . '/storage/logo/logo.svg' }}" alt="" style="height: 30px;">

             </a>

             <!-- Collapse Button -->
             <div class="md:hidden">
                 <button type="button"
                     class="hs-collapse-toggle relative size-9 flex justify-center items-center text-sm font-semibold rounded-lg border border-white/50 text-white hover:bg-white/10 focus:outline-none focus:bg-white/10 disabled:opacity-50 disabled:pointer-events-none"
                     id="hs-base-header-collapse" aria-expanded="false" aria-controls="hs-base-header"
                     aria-label="Toggle navigation" data-hs-collapse="#hs-base-header">
                     <svg class="hs-collapse-open:hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                         <line x1="3" x2="21" y1="6" y2="6" />
                         <line x1="3" x2="21" y1="12" y2="12" />
                         <line x1="3" x2="21" y1="18" y2="18" />
                     </svg>
                     <svg class="hs-collapse-open:block shrink-0 hidden size-4" xmlns="http://www.w3.org/2000/svg"
                         width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                         <path d="M18 6 6 18" />
                         <path d="m6 6 12 12" />
                     </svg>
                     <span class="sr-only">Toggle navigation</span>
                 </button>
             </div>
             <!-- End Collapse Button -->
         </div>
         <!-- End Logo w/ Collapse Button -->

         <!-- Collapse -->
         <div id="hs-base-header"
             class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block"
             aria-labelledby="hs-base-header-collapse">
             <div
                 class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
                 <div class="py-2 md:py-0 flex flex-col md:flex-row md:items-center md:justify-end gap-0.5 md:gap-1">
                     {!! app(App\Services\MenuService::class)->buildMenu() !!}

                     <div class="relative flex flex-wrap items-center gap-x-1.5 md:ps-2.5 mt-1 md:mt-0 md:ms-1.5">
                         <a href="{{ route('cart.index') }}"
                             class="relative p-2 w-full flex items-center text-sm text-orange-500 hover:text-orange-600 focus:outline-none focus:text-orange-600">
                             <svg class="shrink-0 size-5 me-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                 <path stroke-linecap="round" stroke-linejoin="round"
                                     d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                             </svg>
                             Cart
                             <span id="cart-counter"
                                 class="absolute top-0 -right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                 {{ auth()->user()->cart_count }}
                             </span>
                         </a>

                         <!-- Cart Dropdown -->
                         <div
                             class="cart-dropdown hidden absolute right-0 mt-2 w-64 bg-white shadow-lg rounded-lg p-3 z-50">
                             <h3 class="text-lg font-semibold text-gray-800">Cart Items</h3>
                             <div id="cart-items" class="mt-2">
                                 @if (session('cart') && count(session('cart')) > 0)
                                     @foreach (session('cart') as $item)
                                         <div class="flex items-center justify-between py-2 border-b">
                                             <div>
                                                 <p class="text-sm font-medium text-gray-700">{{ $item['name'] }}</p>
                                                 <p class="text-xs text-gray-500">Qty: {{ $item['quantity'] }} -
                                                     ${{ number_format($item['price'], 2) }}</p>
                                             </div>
                                             
                                         </div>
                                     @endforeach
                                 @else
                                     <p class="text-sm text-gray-500">Your cart is empty.</p>
                                 @endif
                             </div>
                             <a href="{{ route('cart.index') }}"
                                 class="block w-full text-center bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 rounded-md mt-2">
                                 View Cart
                             </a>
                         </div>
                     </div>

                 </div>
             </div>
         </div>
     </nav>
 </header>
 <style>
     header ol,
     ul,
     menu {
         color: orange;
     }

     ul li a {
         color: #646363 !important;
     }

     /* Cart Counter */
     #cart-counter {
         position: absolute;
         top: -5px;
         right: -8px;
         /* background-color: red; */
         color: black;
         font-size: 12px;
         font-weight: bold;
         padding: 2px 6px;
         border-radius: 50%;
     }

     /* Cart Dropdown */
     .cart-dropdown {
         display: none;
         position: absolute;
         right: 0;
         top: 100%;
         width: 250px;
         background-color: white;
         box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
         border-radius: 8px;
         padding: 10px;
         z-index: 1000;
     }

     /* Cart Dropdown - Show on Hover */
     .relative:hover .cart-dropdown {
         display: block;
     }
 </style>
