@extends('master')
@section('title')
List Items
@stop
@section('content')

<div class="container">
    <h3 align="center">Listing All Items in the Cart</h3>
   <h4 align="center" style="color:#1A8AC8"> Total Calories for All Food Items is {!! $calorieSum !!} KCal </h4>
    <div class="table-responsive">
       {!! $items->links('pagination') !!}
        <table class="table table-striped">
            <thead>
            <tr class="heading">
                <th>No</th>
                <th>Name</th>
                <th>Group</th>
                <th>Calories (KCal/100 gram serve)</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{!! $item->name,20 !!}</td>
                        <td>{!! $item->group_name !!}</td>
                        <td>{!! $item->calories !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $items->links('pagination') !!}
    </div>
</div>
@stop