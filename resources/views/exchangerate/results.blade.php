@include('layouts.header')

<body>
    <div class="container">
        <div class="py-4 text-center">
            @include('layouts.errors')
            @include('layouts.success')
        </div>
        @if(Session::get('birthday'))
        <div class="jumbotron align-items-center justify-content-center text-center py-4">
            <h1 class="display-3">Exchange Rate Result </h1>
            <p class="lead">The exchange rate in your last birthday (@longdate(Session::get('birthday'))) was <span class="font-weight-bold">{{Session::get('currency')}}@currencyformat(Session::get('rate'))</span></p>
            <p><a class="btn btn-lg btn-success" href="/" role="button">Try Again</a></p>
        </div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Birthday</th>
                    <th>Currency</th>
                    <th>Rate</th>
                    <th>Last Check</th>
                    <th>Number of Checks</th>
                </tr>
            </thead>
            <tbody>
                @foreach($exchangerates as $exchangerate)
                <tr>
                    <td>{{$exchangerate['id']}}</td>
                    <td>@longdate($exchangerate['birthday'])</td>
                    <td>{{$exchangerate['currency']}}</td>
                    <td>{{$exchangerate['rate']}}</td>
                    <td>@longdate($exchangerate['created_at'])</td>
                    <td>{{$exchangerate['timeschecked']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
@include('layouts.footer')