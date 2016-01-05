<?php
$resultsTemplate = 'userresults';
?>

@extends('gridlayout')

@section('title', 'View Users')

@section('datasource',URL::to('/home/grid'))

@section('grid-headers')
	<thead>
	<tr>
		<th class="sortable" data-sort="email">Email</th>
		<th class="sortable" data-sort="first_name">First Name</th>
		<th class="sortable" data-sort="last_name">Last Name</th>
		<th class="sortable" data-sort="address">Address</th>
		<th class="sortable" data-sort="city">City</th>
		<th class="sortable" data-sort="postcode">Postcode</th>
		<th class="sortable" data-sort="company">Company</th>
		<th class="sortable" data-sort="phone">Phone</th>
	</tr>
	</thead>
@stop
