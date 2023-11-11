<?php

namespace App\Filament\Widgets;

use App\Models\Orders;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class PriceChart extends ChartWidget
{
    protected static ?string $heading = 'Doanh thu trong tháng';

    public static function canView(): bool
    {
        return auth()->user()->is_admin;
    }

    // protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = Trend::query(Orders::query()->where('status', 4))
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perDay()
            ->sum('total_price');
            // ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Tổng tiền',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
