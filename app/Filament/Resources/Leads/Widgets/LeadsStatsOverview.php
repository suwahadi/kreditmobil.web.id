<?php

namespace App\Filament\Resources\Leads\Widgets;

use App\Models\Lead;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LeadsStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Stat::make('Total Leads', Lead::query()->count()),
            Stat::make('Today\'s Leads', Lead::query()->whereDate('submitted_at', Carbon::today())->count()),
            Stat::make('New', Lead::query()->where('status', Lead::STATUS_NEW)->count()),
            Stat::make('Assigned', Lead::query()->where('status', Lead::STATUS_ASSIGNED)->count()),
            Stat::make('Follow Up', Lead::query()->where('status', Lead::STATUS_FOLLOW_UP)->count()),
            Stat::make('Negotiation', Lead::query()->where('status', Lead::STATUS_NEGOTIATION)->count()),
            Stat::make('Won', Lead::query()->where('status', Lead::STATUS_WON)->count()),
            Stat::make('Lost', Lead::query()->where('status', Lead::STATUS_LOST)->count()),
        ];
    }
}
