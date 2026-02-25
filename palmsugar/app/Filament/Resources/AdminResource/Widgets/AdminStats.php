<?php

namespace App\Filament\Widgets;

use App\Models\Comment;
use App\Models\Inquiry;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStats extends BaseWidget
{
    protected static ?string $pollingInterval = '30s'; // refresh tiap 30 detik, boleh null kalau mau matiin

    protected function getStats(): array
    {
        return [
            Stat::make('Pending Comments', Comment::where('is_approved', false)->count())
                ->description('Waiting for moderation')
                ->descriptionIcon('heroicon-m-chat-bubble-bottom-center-text')
                ->color('warning'),

            Stat::make('New Inquiries', Inquiry::where('status', 'new')->count())
                ->description('Unread contact messages')
                ->descriptionIcon('heroicon-m-inbox-arrow-down')
                ->color('danger'),

            Stat::make('Total Inquiries', Inquiry::count())
                ->description('All time')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('success'),
        ];
    }
}
