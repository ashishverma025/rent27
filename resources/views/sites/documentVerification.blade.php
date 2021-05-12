@extends('sites.layout.Sites')
@section('content')

<script type="text/javascript" src="https://cdn.trustswiftly.com/account/trust-verify.min.js"></script>

<!--Business covered sec-->
<section id="business-sec">
    <div class="container">
        <div class="all-head">
           <h2> Document <span> Verification </span> </h2>
        </div>
        <button type="button" class="btn btn-primary" id="myButton">Start Verification</button>
    </div>
</section>

<script>
    const handler = TrustVerify.configure({
        onComplete: function(data) {
            console.log('onComplete '+data);
        },
        onExit: function(data) {
            console.log('onExit '+data);

        },
        onDisplay: function(data) {
            console.log('onDisplay'+data)
        },
        onStateChange: function(data) {
            console.log('onStateChange '+data);
            $.ajax({
                url:"{{url('documentVerified')}}",
                data:{'data':data},
                type:'post',
                success:function(res){
                    alert('Verified successfully.')
                }
            });

        },
        onError: function(data) {
            console.log('onError '+data);

        }
    });

    document.getElementById('myButton').addEventListener('click', function(e) {
        handler.open({
            clientToken: "{{$clientToken}}",
            baseUrl: "{{$baseUrl}}",
            modal: true
        });
    });
</script>

@endsection
