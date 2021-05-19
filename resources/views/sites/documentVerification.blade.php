@extends('sites.layout.Sites')
@section('content')

<script type="text/javascript" src="https://cdn.trustswiftly.com/account/trust-verify.min.js"></script>

<!--Business covered sec-->
<section id="business-sec">
    <div class="container">
        <div class="all-head">
           <h2> Please verify your <span> account    </span> </h2>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4" style="margin-left: 45px;">
                <button type="button" class="btn btn-success" style="text-align:center;width:60%;font-weight: 800;font-size:26px; height:154%" id="myButton">Start Verification</button>
            </div>
            <div class="col-md-4"></div>
        </div>
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
            console.log('onDisplay')
        },
        onStateChange: function(data) {
            console.log('onStateChange '+data);
            // $.ajax({
            //     url:"{{url('documentVerified')}}",
            //     data:{'data':data},
            //     type:'post',
            //     success:function(res){
            //         alert('Verified successfully.')
            //     }
            // });

        },
        onError: function(data) {
            console.log('onError '+data);

        }
    });

    $("#verifyClick").on('click',function(){
        var email = '{{$userDetails->email}}';
        setTimeout(function(){ 
            alert("Hello"); 
            console.log(email)
            $("#payemail").val(email);
        }, 3000);


    });

    document.getElementById('myButton').addEventListener('click', function(e) {
        handler.open({
            clientToken: "{{$clientToken}}",
            baseUrl: "{{$baseUrl}}",
            modal: true
        });
    });
</script>
<!-- {{$userDetails->email}} -->
@endsection
