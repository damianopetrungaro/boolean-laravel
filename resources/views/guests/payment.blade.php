@extends('layouts.app')

@section('page-title')
    <title>Deliveroo - Homepage</title>
@endsection

@section('content')
{{-- HEADER --}}
@include('partials.header')

<div class="text-center">
    <div class="container">
        <div class="box">
            <form id="payment-form" action="{{ route('payment') }}" method="post">
                <div class="wrapper">
                    <div class="input-data">
                        <input type="text" required>
                        <div class="underline"></div>
                        <label>Nome utente</label>
                    </div>
                </div>

                <div class="wrapper">
                    <div class="input-data">
                        <input type="text" required>
                        <div class="underline"></div>
                        <label>Cognome utente</label>
                    </div>
                </div>

                <div class="wrapper">
                    <div class="input-data">
                        <input type="text" required>
                        <div class="underline"></div>
                        <label>Indirizzo di consegna</label>
                    </div>
                </div>

                <div class="wrapper">
                    <div id="dropin-container"></div>
                </div>

                <div class="wrapper payment">
                    <span class="btn btn-outline-secondary btn-total" for="amount">Totale: @{{finalPrice}} €</span>
                    <input
                    class="btn btn-primary btn-pay" @click="puliziaCache" type="submit" value="Paga ora"/>
                    <input type="hidden" id="nonce" name="payment_method_nonce"/>
                    <input type="hidden" :value="finalPrice" id="amount" name="amount"/>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- Footer --}}
@include('partials.footer')
@endsection


@section('script')
<script>
  const form = document.getElementById('payment-form');
  const clientToken = '@php echo($clientToken) @endphp';
  braintree.dropin.create({
      authorization: clientToken,
      container: document.getElementById('dropin-container'),
  }, (error, dropinInstance) => {
      if (error) console.error(error);
      form.addEventListener('submit', event => {
          event.preventDefault();
          dropinInstance.requestPaymentMethod((error, payload) => {
          if (error) {
              console.error(error);
          }
          document.getElementById('nonce').value = payload.nonce;
          form.submit();
          });
      });
  });
</script>
@endsection


