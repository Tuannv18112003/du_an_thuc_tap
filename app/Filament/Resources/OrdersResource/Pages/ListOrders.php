<?php

namespace App\Filament\Resources\OrdersResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OrdersResource;
use App\Models\Books;
use App\Models\Orders;

class ListOrders extends ListRecords
{
    protected static string $resource = OrdersResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make(),
    //     ];
    // }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Tất cả')
                ->badge(Orders::count()),
            'ordered' => Tab::make('Đã đặt hàng')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 1))
                ->badge(Orders::query()->where('status', 1)->count()),
            'confirmed' => Tab::make('Đã xác nhận')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 2))
                ->badge(Orders::query()->where('status', 2)->count()),
            'delivering' => Tab::make('Đang giao hàng')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 3))
                ->badge(Orders::query()->where('status', 3)->count()),
            'Successfull' => Tab::make('Giao hàng thành công')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 4))
                ->badge(Orders::query()->where('status', 4)->count()),
            'Cancelled' => Tab::make('Đã hủy')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 0)),
        ];
    }

    public function getDefaultActiveTab(): string | int | null
    {
        return 'ordered';
    }
}
