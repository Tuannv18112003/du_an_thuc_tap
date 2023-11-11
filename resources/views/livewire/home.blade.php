<div>
    <main class="main">

        @if (session('success'))
            <span>{{session('success')}}</span>
        @endif
        
        <!--End hero slider-->
        
           <livewire:sliders />
           <!--End sliders-->


        <livewire:categories />
        <!--End category slider-->
        
        
        <livewire:banners title="Banner" />
        <!--End banner slider-->
        


        <livewire:product-tabs title="Sản phẩm mới" type="New" lazy />
        <!--Products Tabs-->


        <livewire:product-sales />
        <!--End Best Sales-->


        <livewire:product-tabs title="Một số sản phẩm khác" type="" lazy />
    </main>

</div>
