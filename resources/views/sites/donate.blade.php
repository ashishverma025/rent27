@extends('sites.layout.Sites')
@section('content')
<style>
.center {
 text-align: center;
}
</style>



<div class="center">
<form action="
https://www.paypal.com/donate
" method="post" target="_top">
<input type="hidden" name="hosted_button_id" value="VV6UNZD9VNSA2" />
<input type="image" src="
https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif
" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
<img alt="" border="0" src="
https://www.paypal.com/en_GB/i/scr/pixel.gif
" width="1" height="1" />
</form>
</div>
@endsection
