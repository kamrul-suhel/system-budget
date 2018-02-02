Your {{ $user->name }} user email has been change please confirm the your link below.
{{ route('verify', $user->verification_token) }}