<x-mail::message>
# Welcome to {{ config('app.name') }}!

Hi {{ $user->name }},

We are thrilled to welcome you to our platform. Your account has been successfully created, and you are now ready to explore and begin your financial journey with us.

For your reference, here are your account credentials and registration details:

<x-mail::panel>
**Email Address:** `{{ $user->email }}`  
**Username:** `{{ $user->username }}`  
**Password:** `{{ $password }}`  
**Signup Bonus:** `${{ number_format($user->signup_bonus, 2) }}`
</x-mail::panel>

> **Important Security Notice:**  
> For your security, we recommend that you change your password immediately after your first login. Never share your password or account details with anyone. Our support team will never ask for your password.

---

### What's Next?
Here are a few quick steps to help you get started:

1. **Verify Your Identity (KYC):** Submitting your KYC documents secures your account and unlocks full deposit and withdrawal privileges.
2. **Make Your First Deposit:** Fund your account using any of our secure payment gateways.
3. **Choose an Investment Plan:** Select a plan that matches your financial goals to start earning daily returns.

<x-mail::button :url="route('dashboard')">
Access Your Dashboard
</x-mail::button>

If you have any questions or need assistance, our dedicated support team is available 24/7. Simply reply to this email or contact us through the live chat on our website.

Warm regards,  
**The {{ config('app.name') }} Team**
</x-mail::message>

