<p>Hello  {{ $data['name'] }}</p>

<p>You registered an account on EmptyTruck100 ( https://www.emptytruck100.com/ ), before being able to use your account you need to verify that this is your email address by clicking here: <a href="{{ url('verify-email/') }}/{{ $data['email']}}/{{ $data['verify_token']}}"> click here </a></p>

<p>Kind Regards, EmptyTruck100</p>