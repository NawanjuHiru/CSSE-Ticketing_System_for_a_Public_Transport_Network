@extends('layouts.default')

@push('styles')
<!---Internal Fileupload css-->
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" /> --}}

@section('title','Top Up')
@section('sub_title','Payment Gateway')
<center>
@section('content')



  
    
    

    <div class="col-sm-7 card" style="background-color: #F4F7F8; margin-top:40px;margin-left:20px;padding:10px;">

        <div class="row g-2">
            <div class="col">


                <h1 class="text-center"
                    style="font-family:'Trebuchet MS', sans-serif;margin-left:20px; margin-top:20px"> Top Up </h1>
                <br><br>
                <div class="container" style="margin-bottom:20px">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                        <h2 class="panel-title display-td" >Payment Details</h2>
                        <div class="display-td" >                            
                            <img class="img-responsive pull-right" src="https://p.kindpng.com/picc/s/96-966565_payment-method-icons-png-transparent-png.png">
                        </div>
                    </div>                    
                </div>
                <div class="panel-body">
  
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
  
                    <form 
                            role="form" 
                            action="{{ route('stripe.post') }}" 
                            method="post" 
                            class="require-validation"
                            data-cc-on-file="false"
                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="payment-form">
                        @csrf
  
                        
                        <div class='form-row row'>
                            <div class='col-sm-6 form-group required'>
                                <label class='control-label'>Name on Card</label> <input style="background-color: #def7e2;"
                                    class='form-control' size='4' type='text'>
                            </div>
                        </div>
  
                        <div class='form-row row'>
                            <div class='col-sm-6 form-group card required'>
                                <label class='control-label'>Card Number</label> <input style="background-color: #def7e2;"
                                    autocomplete='off' class='form-control card-number' size='20' id="number"
                                    type='text'>
                            </div>
                        </div>
  
                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label> <input autocomplete='off' style="background-color: #def7e2;"
                                    class='form-control card-cvc' placeholder='ex. 311' size='4'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> <input style="background-color: #def7e2;"
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'> 
                                <label class='control-label'>Expiration Year</label> <input style="background-color: #def7e2;"
                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text'>
                            </div>
                        </div>
  
                        {{-- <div class='form-row row'>
                            <div class='col-md-12 error form-group hide'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.</div>
                            </div>
                        </div> --}}
  
                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-success btn-lg btn-block" style="margin-left:180px;" type="submit">Pay Now ($100)</button>
                            </div>
                        </div>
                          
                    </form>
                </div>
            </div>        
        </div>
    </div>
      


@endsection



@push('scripts')
  
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  
<script type="text/javascript">
$(function() {
   
    var $form         = $(".require-validation");
   
    $('form.require-validation').bind('submit', function(e) {
        var $form         = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
        $errorMessage.addClass('hide');
  
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });
   
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }
  
  });
  
  function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
               
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});


// target the input field by ID and assign keyup event
$('#number').on('keyup', function (e) {
            // get value of the input field
            var val = $(this).val();
            var newval = '';
            // write regex to remove any space
            val = val.replace(/\s/g, '');
            // iterate through each numver
            for (var i = 0; i < val.length; i++) {
                // add space if modulus of 4 is 0
                if (i % 4 == 0 && i > 0) newval = newval.concat(' ');
                // concatenate the new value
                newval = newval.concat(val[i]);
            }
            // update the final value in the html input
            $(this).val(newval);
        });
</script>
@endpush