<p>Hi,Your Email {{ $data['name'] }}</p>
<p>Hi,Your Password{{ $data['message'] }}.</p>
<p>It would be appriciative, Please click on link below to verify.</p>

<!--<a href= "{{url('/')}}/email-verify/{{$data['id']}}">emailverify</a>;-->
<a href= "{{url('/')}}/reset-password/{{$data['token']}}">emailverify</a>

<p>Hello  {{ $data['name'] }}</p>

<p>You registered an account on EmptyTruck100 ( https://www.emptytruck100.com/ ), before being able to use your account you need to verify that this is your email address by clicking here: {{ url("verify-email/".$data['email']."/".$data['verify_token']") }}</p>

<p>Kind Regards, [company]</p>
