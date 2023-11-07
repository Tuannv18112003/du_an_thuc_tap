<div>
    {{-- {{ $this->table }} --}}
    <form wire:submit="save">
        <input type="text" wire:model="data.name">
        <div>@error('data.name') {{ $message }} @enderror</div>
    
        {{-- <textarea wire:model="content"></textarea>
        <div>@error('content') {{ $message }} @enderror</div> --}}
    
        <button type="submit">Save</button>
    </form>
</div>
