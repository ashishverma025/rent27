<p>Hi,Your Email {{ $data['name'] }}</p>
<p>Hi,Your Password{{ $data['message'] }}.</p>
<p>It would be appriciative, Please click on link below two verify.</p>

<!--<a href= "{{url('/')}}/email-verify/{{$data['id']}}">emailverify</a>;-->
<a href= "{{url('/')}}/reset-password/{{$data['token']}}">emailverify</a>
