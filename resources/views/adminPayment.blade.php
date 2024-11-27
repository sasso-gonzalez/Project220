@extends('layouts.app')
@include('layouts.navigation')
<br><br><br><br><b><br><br><br><br>

<br><br><br><br><br>
@section('content')
<div class="container">
<h1>Admin Payment Page</h1>
    <form action="{{ route('admin.payment.submit') }}" method="POST">
        @csrf
        <label for="patientID">Patient ID:</label>
        <input type="text" id="patientID" name="patientID" required><br><br>

        <label for="paymentDue">Payment Due:</label>
        <input type="text" id="paymentDue" name="paymentDue" readonly><br><br>

        <label for="paymentAmount">Payment Amount:</label>
        <input type="number" id="paymentAmount" name="paymentAmount" required><br><br>

        <button type="button" onclick="window.location.href='{{ route('admin.payment.cancel') }}'">Cancel</button>
        <button type="submit">Submit</button>
        <button type="button" onclick="updatePaymentDue()">Update</button>
    </form>

    <script>
        function updatePaymentDue() {
            // Logic to update the payment due amount
            document.getElementById('paymentDue').value = document.getElementById('paymentAmount').value;
        }
    </script>
</div>
@endsection
