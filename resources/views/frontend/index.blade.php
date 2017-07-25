@extends('layouts.front')
@section('header_links')
    <!-- Include js plugin -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
@endsection

@section('header_scripts')
<script>
$(document).ready(function() {



});
</script>
@endsection

@section('main')

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center" style="padding-top: 25px;">
            <a href="/product/list">Products List</a>
        </div>
    </div>
</div>

@endsection