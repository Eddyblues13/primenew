<x-mail::message>
# Investment Confirmation

Hi {{ $investment->user->name }},

Your investment of **${{ number_format($investment->amount, 2) }}** in the **{{ $investment->plan->name }}** pool has been successfully processed.

### Investment Details
- **Plan:** {{ $investment->plan->name }} ({{ ucfirst($investment->plan->type) }})
- **Amount Invested:** ${{ number_format($investment->amount, 2) }}
- **Expected ROI:** +{{ $investment->plan->roi_percent }}%
- **Duration:** {{ $investment->plan->duration_days }} Days
- **Maturity Date:** {{ $investment->created_at->addDays($investment->plan->duration_days)->format('M d, Y') }}

You can track the performance of your investment from your dashboard at any time.

<x-mail::button :url="route('investments.history')">
View Investment History
</x-mail::button>

Thank you for investing with us,<br>
{{ config('app.name') }}
</x-mail::message>
