@extends('errors::minimal')

@section('title', __('Página caducada'))
@section('code', '419')
@section('message', __('Página caducada, tu sesión ha expirado y estás intentando enviar un formulario con un token no válido'))
