@component('mail::message')
# Withdrawal Request Received

Hi {{ $user->name }},

We have received your withdrawal request. Please note that an administrator must approve this transaction before it is processed. Your requested amount has been temporarily deducted from your available balance.

**Withdrawal Details:**
- **Amount:** ${{ number_format($withdrawal->amount, 2) }}
- **Method:** {{ strtoupper($withdrawal->method) }}
@if(\Illuminate\Support\Str::startsWith($withdrawal->destination, '{') && ($decoded = json_decode($withdrawal->destination, true)))
@if(!empty($decoded['paypal_email']))
- **PayPal Email:** {{ $decoded['paypal_email'] }}
@else
- **Bank Name:** {{ $decoded['bank_name'] ?? '' }}
- **Account Holder:** {{ $decoded['account_name'] ?? '' }}
- **Account Number/IBAN:** {{ $decoded['account_number'] ?? '' }}
@if(!empty($decoded['routing_number']))
- **Routing Number/SWIFT/BIC:** {{ $decoded['routing_number'] }}
@endif
@if(!empty($decoded['bank_address']))
- **Bank Branch Address:** {{ $decoded['bank_address'] }}
@endif
@endif
@else
- **Destination Address/Account:** {{ $withdrawal->destination }}
@endif
- **Status:** Pending Approval
- **Date:** {{ $withdrawal->created_at->format('M d, Y h:i A') }}

If you did not request this withdrawal, please contact our support team immediately.

@component('mail::button', ['url' => route('withdrawals.history')])
View Withdrawal History
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
