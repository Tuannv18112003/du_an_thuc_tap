<div>
    <div class="comment-list">
        @foreach ($comments as $item)
            <div class="single-comment justify-content-between d-flex mb-30" wire:key="{{ $item->id }}">
                <div class="user justify-content-between d-flex">
                    <div class="thumb text-center">
                        <img src="{{ asset('front-end/assets/imgs/blog/author-2.png') }}" alt="" />
                        <a href="#" class="font-heading text-brand">{{ $item->user->name }}</a>
                    </div>
                    <div class="desc">
                        <div class="d-flex justify-content-between mb-10">
                            <div class="d-flex align-items-center">
                                <span class="font-xs text-muted">{{ $item->created_at }}</span>
                            </div>
                            {{-- <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 100%"></div>
                            </div> --}}
                        </div>
                        <p class="mb-10">{{ $item->comment }} <a href="" class="reply"
                                wire:click.prevent="$set('showInputReComments', true)">Trả lời</a></p>

                        @if ($showInputReComments)
                            <div wire:transition>
                                <form action="" wire:submit="saveReComment({{ $item->id }})">
                                    <div class="form-group">
                                        <input class="form-control" name="recomment" id="name" type="text"
                                            wire:model="recomment" placeholder="Nội dung..." />
                                    </div>
                                </form>
                            </div>
                        @endif


                    </div>
                </div>
            </div>

            @if (!empty($item->recomment))
                @foreach ($item->recomment as $recomment)
                    <div class="single-comment justify-content-between d-flex mb-30 ml-30">
                        <div class="user justify-content-between d-flex">
                            <div class="thumb text-center">
                                <img src="{{asset('front-end/assets/imgs/blog/author-3.png')}}" alt="" />
                                <a href="#" class="font-heading text-brand">{{$recomment->user->name}}</a>
                            </div>
                            <div class="desc">
                                <div class="d-flex justify-content-between mb-10">
                                    <div class="d-flex align-items-center">
                                        <span class="font-xs text-muted">{{$recomment->created_at}} </span>
                                    </div>
                                </div>
                                <p class="mb-10">{{$recomment->comment}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach
    </div>
</div>
