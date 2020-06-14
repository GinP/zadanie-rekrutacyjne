@extends('..\layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-2">
                    <div class="card-header">{{ __('msg.ycurrency.rates') }}</div>

                    <div class="card-body mb-2">
                        <form method="POST" action="{{ route('currency.update') }}" role="name" aria-label="get your currency rates form">
                            @csrf
                            @method('PATCH')

                            @foreach( $currency_all as $key => $currency )
                                <div class="form-check form-check-inline" style="min-width: 55px; margin: 5px;">
                                    <input class="form-check-input" name="currency[]" type="checkbox" id="inlineCheckbox{{ $key }}" value="{{ $currency['code'] }}" @if(in_array($currency['code'], $user_currency_codes)) checked @endif>
                                    <label class="form-check-label" for="inlineCheckbox{{ $key }}">{{ $currency['code'] }}</label>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary btn-lg btn-block">{{__('msg.ycurrency.save')}}</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">{{ __('msg.ycurrency.your') }}</div>
                    <div class="card-body d-flex justify-content-center flex-wrap">
                        @forelse($user_currency as $key => $currency)
                            <div class="col-lg-2">
                                <div class="card m-1 float-left">
                                    <div class="card-header">
                                        {{__('msg.ycurrency.rate')}} {{ $user_currency[$key]['code'] }}
                                    </div>
                                    <div class="card-body p-1">
                                        <div class="card-text text-center">{{ $user_currency[$key]['mid'] }}</div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>{{__('msg.ycurrency.any')}}</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
