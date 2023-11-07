<div class="search-style-2 position-relative">

    

    <input  wire:model.live.debounce.500ms="search" type="text" placeholder="Search for items..." />
    
    
    {{-- <select class="select-active select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true">
        <option>All Categories</option>
        <option>Milks and Dairies</option>
        <option>Wines & Alcohol</option>
        <option>Clothing & Beauty</option>
        <option>Pet Foods & Toy</option>
        <option>Fast food</option>
        <option>Baking material</option>
        <option>Vegetables</option>
        <option>Fresh Seafood</option>
        <option>Noodles & Rice</option>
        <option>Ice cream</option>
    </select> --}}
    @if (sizeof($books) > 0)
        <div class=" mt-5 position-absolute start-0 " style="background-color: #fff;  right: 0; z-index:999 ">
            <div class="rol" style="height: 200px;overflow: scroll;">
                @foreach ($books as $item)
                    <div class="col-12 row" style="margin-top:20px; border-bottom: 2px solid #ccc">
                        <div class="col-2">
                            <img src="{{ asset('/storage/' . $item->image) }}" alt="">
                        </div>
                        <div class="col-10">
                            <a href="/chi-tiet-san-pham/{{$item->slug}}" class="fs-6 text-center">{{$item->name}}</a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    @endif
</div>
