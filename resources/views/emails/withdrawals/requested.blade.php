@component('mail::message')
# Withdrawal Request Received

Hi {{ $user->name }},

We have received your withdrawal request. Please note that an administrator must approve this transaction before it is processed. Your requested amount has been temporarily deducted from your available balance.

**Withdrawal Details:**
- **Amount:** ${{ number_format($withdrawal->amount, 2) }}
- **Method:** {{ strtoupper($withdrawal->method) }}
- **Destination Address/Account:** {{ $withdrawal->destination }}
- **Status:** Pending Approval
- **Date:** {{ $withdrawal->created_at->format('M d, Y h:i A') }}

If you did not request this withdrawal, please contact our support team immediately.

@component('mail::button', ['url' => route('withdrawals.history')])
View Withdrawal History
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
