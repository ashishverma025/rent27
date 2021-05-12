@extends('sites.layout.Sites')
@section('content')
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    paypal.Button.render({
        // Configure environment
        env: 'sandbox',
        client: {
            sandbox: 'AbsjBaGuhLBSx37O0pi6LOxJPhlGHmq0rtiTHKa1mWRl39RbfMjYQUf6eGuWFmgHUpF3nQvjBzU7FiB-',
            production: 'AbsjBaGuhLBSx37O0pi6LOxJPhlGHmq0rtiTHKa1mWRl39RbfMjYQUf6eGuWFmgHUpF3nQvjBzU7FiB-'
        },
        // Customize button (optional)
        locale: 'en_US',
        style: {
            size: 'small',
            color: 'gold',
            shape: 'pill',
        },

       // Enable Pay Now checkout flow (optional)
       commit: true,

       // Set up a payment
       payment: function(data, actions) {
          return actions.payment.create({
             transactions: [{
  amount: {
    total: document.getElementById("payment").value,
    currency: 'USD'
  }
}]
           });
         },
         // Execute the payment
         onAuthorize: function(data, actions) {
             return actions.payment.execute().then(function() {
             // Show a confirmation message to the buyer
             window.alert('Thank you for your purchase!');
         });
     }
 }, '#paybutton');
 </script>
    <!-- Include the PayPal JavaScript SDK -->
<script>
    paypal.Button.render({
        // Configure environment
        env: 'sandbox',
        client: {
            sandbox: 'AbsjBaGuhLBSx37O0pi6LOxJPhlGHmq0rtiTHKa1mWRl39RbfMjYQUf6eGuWFmgHUpF3nQvjBzU7FiB-',
            production: 'AbsjBaGuhLBSx37O0pi6LOxJPhlGHmq0rtiTHKa1mWRl39RbfMjYQUf6eGuWFmgHUpF3nQvjBzU7FiB-'
        },
        // Customize button (optional)
        locale: 'en_US',
        style: {
            size: 'small',
            color: 'gold',
            shape: 'pill',
        },

       // Enable Pay Now checkout flow (optional)
       commit: true,

       // Set up a payment
       payment: function(data, actions) {
          return actions.payment.create({
             transactions: [{
  amount: {
    total: document.getElementById("paymentInput").value,
    currency: 'USD'
  }
}]
           });
         },
         // Execute the payment
         onAuthorize: function(data, actions) {
             return actions.payment.execute().then(function() {
             // Show a confirmation message to the buyer
             window.alert('Thank you for your purchase!');
         });
     }
 }, '#paypal-button');
 </script>

 <script>
    paypal.Button.render({
        // Configure environment
        env: 'sandbox',
        client: {
            sandbox: 'AbsjBaGuhLBSx37O0pi6LOxJPhlGHmq0rtiTHKa1mWRl39RbfMjYQUf6eGuWFmgHUpF3nQvjBzU7FiB-',
            production: 'AbsjBaGuhLBSx37O0pi6LOxJPhlGHmq0rtiTHKa1mWRl39RbfMjYQUf6eGuWFmgHUpF3nQvjBzU7FiB-'
        },
        // Customize button (optional)
        locale: 'en_US',
        style: {
            size: 'small',
            color: 'gold',
            shape: 'pill',
        },

       // Enable Pay Now checkout flow (optional)
       commit: true,

       // Set up a payment
       payment: function(data, actions) {
          return actions.payment.create({
             transactions: [{
  amount: {
    total: document.getElementById("payment").value,
    currency: 'USD'
  }
}]
           });
         },
         // Execute the payment
         onAuthorize: function(data, actions) {
             return actions.payment.execute().then(function() {
             // Show a confirmation message to the buyer
             window.alert('Thank you for your purchase!');
         });
     }
 }, '#pay-pal-button');
 </script>
	  
<style>
.package-section{max-width: 800px;margin:0 auto;}
.package-col {background:#fff;border:1px solid #f2f2f2;font-family: 'Raleway', sans-serif;box-shadow: 0px -1px 16px -5px rgba(0, 0, 0, 0.37);
-webkit-box-shadow: 0px -1px 16px -5px rgba(0, 0, 0, 0.37);-moz-box-shadow: 0px -1px 16px -5px rgba(0, 0, 0, 0.37);width:100%;max-width: 43%;margin:3% 3%;display:inline-block;}
.package-col ul {
	margin: 0;
	padding: 0;
}
.package-col ul li {
	list-style: none;
	padding: 10px;
	text-align: center;
	border-bottom: 1px solid #ccc;
}
.package-col.gold-package ul li:first-child {
	background: gold;
	font-size: 36px;
	padding: 10px;
	margin: 0;
	line-height: 36px;
}
.package-col.silver-package ul li:first-child {
	background: #D5D5D5;
	font-size: 36px;
	padding: 10px;
	margin: 0;
	line-height: 36px;
}
.package-col ul li h3{margin:20px 0;}
.package-col ul li.package-buy a {
    background: #c80c0c;
    padding: 10px;
    display: block;
    max-width: 100px;
    margin: 0 auto;
    border-radius: 5px;
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    text-transform: uppercase;
}
.package-col ul li.package-paypal a {
    background: #253B80;
    padding: 10px;
    display: block;
    max-width: 100px;
    margin: 0 auto;
    border-radius: 5px;
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    text-transform: uppercase;
}
.package-col ul li.package-price span {
	position: absolute;
	top: 0;
	font-size: 15px;
	margin: 14px 0 0 -13px;
}
.package-col ul li.package-price {
	font-size: 50px;
	font-weight: bold;
	position: relative;
}
</style>

<section id="business-sec">
    <div class="container">
        <div class="all-head">
            <!-- <h2> You don't have Gold User subscription  <span> </span> </h2> -->
            <h2> Below is the list of subscription packages.  <span> </span> </h2>
        </div>
		<div class="package-section">
<div class="package-col gold-package">
	<ul>
		<li><h3><?php echo $users[0]->name; ?></h3></li>
		<li class="package-price"><span>$</span><?php echo $users[0]->price; ?></li>
		<!-- <li>Description <?php echo $users[0]->description; ?> </li> -->
		<li>PricePer<?php echo $users[0]->price_per; ?></li>
		<li>You Save <?php echo $users[0]->discount; ?></li>
		<!-- <li>engagements <?php echo $users[0]->engagements; ?></li> -->

	
 <div id="paypal-button"></div>
<input id="paymentInput" type="hidden" value="<?php echo $users[0]->price; ?>"/>
	</ul>
</div>

<div class="package-col silver-package">
<ul>
		<li><h3><?php echo $users[1]->name; ?></h1></li>
		<li class="package-price"><span>$</span><?php echo $users[1]->price; ?></li>
		<!-- <li>Description <?php echo $users[1]->description; ?></li> -->
		<li>PricePer<?php echo $users[1]->price_per; ?></li>
		<li>You Save <?php echo $users[1]->discount; ?></li>
		<!-- <li>engagements <?php echo $users[1]->engagements; ?></li> -->
	

  <div id="paybutton"></div>
  <input id="payment" type="hidden" value="<?php echo $users[1]->price; ?>"/>
	</ul>
	
</div>

<div class="package-col gold-package">
<ul>
        <li><h3><?php echo $users[2]->name; ?></h2></li>
        <li class="package-price"><span>$</span><?php echo $users[2]->price; ?></li>
        <!-- <li>Description <?php echo $users[2]->description; ?></li> -->
        <li>PricePer<?php echo $users[2]->price_per; ?></li>
        <li>You Save <?php echo $users[2]->discount; ?></li>
        <!-- <li>engagements <?php echo $users[2]->engagements; ?></li> -->
    

  <div id="pay-pal-button"></div>
  <input id="payment" type="hidden" value="<?php echo $users[2]->price; ?>"/>
   </ul> 
    
</div>

</div>

        <div class="row">
            <div class="col-lg-12 col-md-12"> 
                <div class="business-box">
 
                    <p> <a href="{{url('/')}}" alt="Go Back">Go Back </a> </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
