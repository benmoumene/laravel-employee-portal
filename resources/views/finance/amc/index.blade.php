@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    @include('finance.menu', ['active' => 'amc'])
    <br><br>
    <div class="row">
        <div class="col-md-6"><h1>AMC</h1></div>
        <div class="col-md-6"><a href="{{ route('amc.create') }}" class="btn btn-success float-right">Setup New AMC</a></div>
    </div>
    <form action="/finance/amc" method="GET" class="form-inline mt-4 mb-4 d-flex justify-content-end">
        <div class="form-group">
            <input type="date" name="start" id="start" placeholder="dd/mm/yyyy" class="form-control form-control-sm" value="{{ $startDate ?? '' }}">
        </div>
        <div class="form-group ml-2">
            <input type="date" name="end" id="end" placeholder="dd/mm/yyyy" class="form-control form-control-sm" value="{{ $endDate ?? '' }}">
        </div>
        <div class="form-group ml-2">
            <button type="submit" class="btn btn-secondary btn-sm">Filter</button>
        </div>
    </form>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Project</th>
            <th>Cycly</th>
            <th>Payment Type</th>
            <th>Max alloted hours</th>
        </tr>
        @foreach ($invoices ?? [] as $invoice)
        <tr>
            <td><a href="{{ route('invoices.edit', $invoice) }}">
                @foreach ($invoice->projectStageBillings as $billing)
                    {{ $loop->first ? '' : '|' }}
                    {{ $billing->projectStage->project->name }}
                @endforeach
            </a></td>
            <td>
                @switch ($invoice->status)
                    @case('paid')
                        <span class="badge badge-pill badge-success">
                        @break
                    @case('unpaid')
                        <span class="badge badge-pill badge-danger">
                        @break
                @endswitch
                {{ $invoice->status }}</span>
            </td>
            <td>
                {{ date(config('constants.display_date_format'), strtotime($invoice->sent_on)) }}
            </td>
            <td>
            @if ($invoice->file_path)
                <a target="_blank" href="/finance/invoices/download/{{ $invoice->file_path }}"><i class="fa fa-file fa-2x text-primary btn-file"></i></a>
            @else
                <span>-</span>
            @endif
            </td>
        </tr>
        @endforeach
    </table>

</div>
@endsection
