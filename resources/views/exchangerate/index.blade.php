@include('layouts.header')
<body class="bg-light">
    <div class="container py-1 mt-4">
        <div class="py-4 text-center">
            <h2>Exchange Rate Web App</h2>
            <p>Discover what was the exchange rate from some currencies on your last birthday.</p>
            @include('layouts.errors')
            @include('layouts.success')
        </div>  
    </div>
    <div class="row align-items-center justify-content-center py-1 mt-1 mb-2">
        <form method="post" action="{{url('/')}}">
            {{csrf_field()}}
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="birthday">Last Birthday</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="DD/MM/YY" name="birthday" id="birthday" required/>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="currency">Currency:</label>
                    <select class="form-control" name="currency" id="currency" required>
                        <option value="GBP" selected>British Pound</option>
                        <option value="USD">US Dollar</option>
                        <option value="BRL">Brazilian Real</option>
                    </select>
                </div>
                <div class="form-group col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row align-items-center justify-content-center py-4">
        <p class="alert alert-info" role="alert">Important: The fixer.io free plan does not accept to change the base currency from EUR to GBP.</p>
    </div>
    <script>
      $(function () {
          $("#birthday").datepicker({
              showOn: "both",
              buttonText: "<i class='far fa-calendar-alt'></i>",
              minDate: "-1Y",
              maxDate: "+0D",
              dateFormat: 'dd/mm/yy'
          });
      });
    </script>
</body>
@include('layouts.footer')