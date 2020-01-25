@extends('layouts.app')
@section('content')
<style type="text/css">
  .mask {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    opacity: 0.5;
    background-color: #3F3F40;
    z-index: 1;
  }
</style>
<div class="container">
  <div class='btn-group btn-group-md'>
    @include('import._import-delivery-Button')
    @include('import._import-config-Button')
  </div>
  @include('bootstraptable._table_toolbar')
</div>
<table id="table" style="width:90% ;margin:20px auto"></table>
@include('bootstraptable._edit-Modal')
<div class="mask" onclick="hideMask()" id='mask'></div>
@endsection
@section('customJS')
<script src="{{ asset('js/table.js') }}"></script>
@endsection