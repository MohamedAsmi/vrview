<x-mail::message>
# Welcome to 360° Virtual Tour Real Estate

Hi {{ $user->name ?? 'there' }},

Thank you for registering with our 360° Virtual Tour Real Estate system!

Click the button below to verify your email and unlock access to:
- Upload panoramic property photos
- Add interactive AI hotspots
- Enjoy immersive virtual tours

<x-mail::button :url="$url">
Verify Email
</x-mail::button>

If you did not create an account, no further action is required.

Thanks,<br>
<strong>360° Virtual Real Estate Team</strong><br>
<small>Visit us at <a href="https://your-domain.com">your-domain.com</a></small>
</x-mail::message>
