@extends('errors::minimal')

@section('title', __('Demasiadas solicitudes'))
@section('code', '429')
@section('message', __('Upss, ha enviado demasiadas peticiones en un corto periodo de tiempo.'))
