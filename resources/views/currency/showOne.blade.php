@extends('..\layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Check custom currency
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('currency.showOne') }}">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Currency</label>
                            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="code">
                                @foreach($codes as $code)
                                    @if($loop->first)
                                        <option value="{{ $code }}" selected>{{ $code }}</option>
                                    @endif
                                    <option value="{{ $code }}">{{ $code }}</option>
                                @endforeach
                            </select>
                            <input class="m-4" type="text" name="date" value=""/>
                            <button type="submit" class="btn btn-primary btn-lg btn-block mt-2"> Check rate </button>
                        </form>
                    </div>
                </div>

                    <div class="card mt-2">
                        @if($single_currency != NULL)
                            <div class="card-header d-flex justify-content-center">
                                {{ $single_currency['code'] }}
                            </div>
                            <div class="card-body">
                                Rate: {{ $single_currency['mid'] }}
                                <span class="float-right"> {{ $single_currency['effectiveDate'] }} </span>
                            </div>
                        @else
                            <div class="card-header d-flex justify-content-center">
                                Check rate
                            </div>
                            <div class="card-body">
                                Choose currency and date
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
