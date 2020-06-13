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
                            <input type="text" name="date" value="10-24-1984"/>
                            <button type="submit" class="btn btn-primary btn-lg btn-block mt-2"> Check rate </button>
                        </form>
                    </div>
                </div>
                @if($single_currency != NULL)
                    <div class="card">
                        <div class="card-header">
                            {{ $single_currency['code'] }}
                        </div>
                        <div class="card-body">
                            {{ $single_currency['mid'] }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function() {
            $('input[name="date"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 2020,
                startDate: "06/13/2020",
                endDate: "06/13/2020",
                opens: "center",
                maxYear: parseInt(moment().format('DD-MM-YYYY'),10),
                locale: {
                    "format": "MM-DD-YYYY",
                    "separator": " - ",
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
            });
        });
    </script>
@endsection
