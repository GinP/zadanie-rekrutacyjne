@extends('..\layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{__('msg.scurrency.custom')}}
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('currency.showOne') }}" role="name" aria-label="check custom currency form">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">{{__('msg.scurrency.currency')}}</label>
                            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="code">
                                @foreach($codes as $code)
                                    @if($loop->first)
                                        <option value="{{ $code }}" selected>{{ $code }}</option>
                                    @endif
                                    <option value="{{ $code }}">{{ $code }}</option>
                                @endforeach
                            </select>
                            <input class="m-4" type="text" name="date" value=""/>
                            <button type="submit" class="btn btn-primary btn-lg btn-block mt-2"> {{__('msg.scurrency.chrate')}} </button>
                        </form>
                    </div>
                </div>

                    <div class="card mt-2">
                        @if($single_currency != NULL)
                            <div class="card-header d-flex justify-content-center">
                                {{ $single_currency['code'] }}
                            </div>
                            <div class="card-body">
                                {{__('msg.scurrency.rate')}}: {{ $single_currency['mid'] }}
                                @if($single_currency['effectiveDate'] !== 'Date')
                                <span class="float-right"> {{ $single_currency['effectiveDate'] }} </span>
                                @endif
                            </div>
                        @else
                            <div class="card-header d-flex justify-content-center">
                                {{__('msg.scurrency.chrate')}}
                            </div>
                            <div class="card-body">
                                {{__('msg.scurrency.choose')}}
                            </div>
                        @endif
                    </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function() {
            $('input[name="date"]').daterangepicker({
                "singleDatePicker": true,
                "autoApply": true,
                "locale": {
                    "format": "YYYY-MM-DD",
                    "separator": "-",
                    "applyLabel": "Apply",
                    "cancelLabel": "Cancel",
                    "fromLabel": "From",
                    "toLabel": "To",
                    "customRangeLabel": "Custom",
                    "weekLabel": "W",
                    "daysOfWeek": [
                        "Su",
                        "Mo",
                        "Tu",
                        "We",
                        "Th",
                        "Fr",
                        "Sa"
                    ],
                    "monthNames": [
                        "January",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December"
                    ],
                    "firstDay": 1
                },
                "startDate": "2020-06-13",
                "endDate": "2020-06-13",
                "opens": "center"
            }, function(start, end, label) {
                console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
            });
        });
    </script>
@endsection
