<div>
    <section class="product-tabs section-padding position-relative">
        <div class="container">
            <div class="section-title style-2 wow animate__animated animate__fadeIn">
                <h3> {{ $title }} </h3>
                <ul class="nav nav-tabs links" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one"
                            type="button" role="tab" aria-controls="tab-one"
                            wire:click="filterCategory" aria-selected="true">Tất cả</button>
                    </li>
                    @foreach ($categories as $item)
                        <li class="nav-item" role="presentation" wire:key="{{ $item->id }}"
                            wire:click="filterCategory({{$item->id}})">
                            <button class="nav-link" type="button" aria-selected="false">{{ $item->name }}</button>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!--End nav-tabs-->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                    @if (empty($books))
                        <div class="col-12  text-center fs-4">Hiện không còn thể loại này</div>
                    @else
                        <div class="row product-grid-4">
                            @foreach ($books as $item)
                                <livewire:view-book-tabs wire:key="{{$item->id}}" :$item :$type lazy />
                            @endforeach
                        </div>
                    @endif


                    <!--End product-grid-4-->
                </div>
            </div>
            <!--End tab-content-->
        </div>
    </section>
</div>
