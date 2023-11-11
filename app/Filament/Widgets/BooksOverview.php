<?php

namespace App\Filament\Widgets;

use App\Models\Books;
use App\Models\Orders;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BooksOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        return [
            Stat::make('Đơn hàng', Orders::query()->where('status', 4)->count())
            ->descriptionIcon('heroicon-m-arrow-trending-up'),

            Stat::make('Doanh thu', Orders::query()->where('status', 4)->sum('total_price')),
            Stat::make('Sản phẩm', Books::query()->count()),
        ];
    }
}

