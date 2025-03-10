@extends('layout.app')

@section('main-content')
<!--  (Konten Tengah) -->
<main class="flex-1 p-4 md:p-6 lg:p-8 space-y-8">

    <!-- Display total volume -->
    <h3>Summary</h3>
    <h5>Total Lots All: {{ number_format($totalVolumeori ?? 0, 2) }}</h5>
    <h5>Total Lots: {{ number_format($totalVolume ?? 0, 2) }}</h5>
    <h5>Last Transaction: {{ $lastCloseDate ?? 'N/A' }}</h5>
@if (isset($data) && count($data) > 0)

    <!-- Display Details -->
    <h3>Details:-</h3>
    <table border="0" width="100%">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Account ID</th>
                <th>Open Date</th>
                <th>Closed Date</th>
                <th>Ticket Type</th>
                <th>Volume</th>
                <th>Currency</th>
                <th>PL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td><strong>{{ $item['userId'] ?? 'N/A' }}</strong></td>
                    <td><strong>{{ $item['login'] ?? 'N/A' }}</strong></td>
                    <td><strong>{{ $item['openDate'] ?? 'N/A' }}</strong></td>
                    <td><strong>{{ $item['closeDate'] ?? 'N/A' }}</strong></td>
                    <td><strong>{{ $item['ticketType'] ?? 'N/A' }}</strong></td>
                    <td><strong>{{ $item['volume'] ?? 'N/A' }}</strong></td>
                    <td><strong>{{ $item['currency'] ?? 'N/A' }}</strong></td>
                    <td><strong>{{ $item['pl'] ?? 'N/A' }}</strong></td>
                    {{-- <td><strong>{{ number_format((float)$item['totalNetDeposits'], 2) ?? 'N/A' }}</strong></td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>


@else
    <p>No user data available.</p>
@endif

</main>
@endsection
