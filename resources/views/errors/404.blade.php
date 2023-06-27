@extends('errors::minimal')

@php
  $message = $exception->getMessage();
@endphp

@section('title', $message ? $message : __('Not Found'))
@section('code', '404')
@section('message', $message ? $message : __('Not Found'))
